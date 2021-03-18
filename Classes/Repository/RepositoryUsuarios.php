<?php

namespace Classes\Repository;

use Classes\Database\MySql;

class RepositoryUsuarios
{
    private object $mySql;
    public const TABLE = 'usuarios';

    public function __construct()
    {
       $this->mySql = new MySql();
    }

    public function getMysqlConnection()
    {
        return $this->mySql;
    }
}