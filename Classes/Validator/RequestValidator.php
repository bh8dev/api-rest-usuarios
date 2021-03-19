<?php

namespace Classes\Validator;

use Classes\Repository\RepositoryTokensAutorizados;
use Classes\Utils\GenericConstantsUtil;
use Classes\Utils\JsonUtil;
use Classes\Service\UsuarioService;
use Exception;
use InvalidArgumentException;

class RequestValidator
{
    private array $request;
    private array $dataFromRequest;
    private object $repositoryAuthorizedTokens;
    private array $availableEndpoints = [
        'usuarios' => 'usuarios'
    ];

    const METHODS = [
        'GET' => 'GET',
        'POST' => 'POST',
        'PUT' => 'PUT',
        'DELETE' => 'DELETE'
    ];

    public function __construct(array $request)
    {
        $this->request = $request;
        $this->repositoryAuthorizedTokens = new RepositoryTokensAutorizados();
    }

    public function processRequest()
    {
        $response = json_encode(GenericConstantsUtil::INVALID_ROUTE_TYPE, JSON_UNESCAPED_UNICODE);

        if (in_array($this->request['method'], GenericConstantsUtil::REQUEST_TYPE, true))
        {
            $response = $this->redirectRequest();
        }
        else
        {
            throw new InvalidArgumentException(GenericConstantsUtil::METHOD_NOT_ALLOWED);
        }

        return $response;
        
    }

    private function redirectRequest()
    {
        if ($this->request['method'] !== self::METHODS['GET'] && $this->request['method'] !== self::METHODS['DELETE'])
        {
            $this->dataFromRequest = JsonUtil::manageJsonRequestBody();
        }
        else
        {
            $this->repositoryAuthorizedTokens->validateToken(getallheaders()['Authorization']);
            $method = $this->request['method'];
            return call_user_func(array($this, $method));
        }
    }

    private function get()
    {
        $response = json_encode(GenericConstantsUtil::INVALID_ROUTE_TYPE);

        if (in_array($this->request['endpoint'], GenericConstantsUtil::AVAILABLE_ENDPOINTS_TYPE['GET'], true))
        {
            switch ($this->request['endpoint'])
            {
                case $this->availableEndpoints['usuarios']:
                    $serviceUser = new UsuarioService($this->request);
                    $response = $serviceUser->validateGet();
                    break;
                default:
                    throw new InvalidArgumentException(GenericConstantsUtil::INVALID_RESOURCE);
            }
            return $response;
        }
        else
        {
            throw new Exception(GenericConstantsUtil::ERROR_TYPE);
        }
    }
}