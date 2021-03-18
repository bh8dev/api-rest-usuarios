<?php

namespace Classes\Validator;

use Classes\Repository\RepositoryTokensAutorizados;
use Classes\Utils\UtilGenericConstants;
use Classes\Utils\UtilJson;
use Classes\Service\UsuarioService;

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

    public function processRequest ()
    {
        $response = json_encode(UtilGenericConstants::INVALID_ROUTE_TYPE, JSON_UNESCAPED_UNICODE);
        if (in_array($this->request['method'], UtilGenericConstants::REQUEST_TYPE, true))
        {
            $response = $this->redirectRequest();
        }
        else
        {
            return $response;
        }
    }

    private function redirectRequest ()
    {
        if ($this->request['method'] !== self::METHODS['GET'] && $this->request['method'] !== self::METHODS['DELETE'])
        {
            $this->dataFromRequest = UtilJson::manageJsonRequestBody();
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
        $response = json_encode(UtilGenericConstants::INVALID_ROUTE_TYPE);

        if (in_array($this->request['endpoint'], UtilGenericConstants::AVAILABLE_ENDPOINTS_TYPE['GET'], true))
        {
            switch ($this->request['endpoint'])
            {
                case $this->availableEndpoints['usuarios']:
                    $serviceUser = new UsuarioService($this->request);
                    $response = $serviceUser->validateGet();
                    break;
                default:
                    var_dump($this->availableEndpoints['usuarios']);
                    break;
            }
        }
        else
        {
            
        }
    }
}