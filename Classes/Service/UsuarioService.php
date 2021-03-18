<?php

namespace Classes\Service;

use Classes\Repository\RepositoryUsuarios;
use InvalidArgumentException;
use Classes\Utils\UtilGenericConstants;

class UsuarioService
{
    public const TABLE = 'usuarios';
    private array $getResources = [
        'listar' => 'listar'
    ];
    private array $dataFromRequest;
    private object $repositoryUsers;

    public function __construct(array $dataFromRequest = [])
    {
        $this->dataFromRequest = $dataFromRequest;
        $this->repositoryUsers = new RepositoryUsuarios();
    }

    public function validateGet()
    {
        $response = null;
        $resource = $this->dataFromRequest['resource'];

        if (in_array($resource, $this->getResources, true))
        {
            $response = ($this->dataFromRequest['id'] > 0 ? $this->getUserById() : call_user_func(
                array($this, $resource))
            );
        }
        else
        {
            throw new InvalidArgumentException(UtilGenericConstants::INVALID_RESOURCE);
        }     
    }

    private function getUserById ()
    {
        
    }

    private function listar()
    {
        return $this->repositoryUsers->getMysqlConnection()->getAll(self::TABLE);
    }
}