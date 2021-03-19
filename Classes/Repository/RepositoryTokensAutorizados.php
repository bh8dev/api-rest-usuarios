<?php

namespace Classes\Repository;

use Classes\Database\MySql;
use InvalidArgumentException;
use Classes\Utils\GenericConstantsUtil;

class RepositoryTokensAutorizados
{
    private object $mySql;
    public const TABLE = 'tokens_autorizados';

    public function __construct()
    {
        $this->mySql = new MySql();
    }
    
    public function validateToken (string $token)
    {
        $token = str_replace(['Bearer', ' '], '', $token);

        if ($token)
        {
            $this->verifyIfTokenExists($token);
        }
        else
        {
            throw new InvalidArgumentException(GenericConstantsUtil::EMPTY_TOKEN);
        }
    }

    public function getMysqlConnection()
    {
        return $this->mySql;
    }

    private function verifyIfTokenExists (string $token)
    {
        $query = 'SELECT id FROM ' . self::TABLE . ' WHERE token = :token AND status = :status';

        $stmt = $this->getMysqlConnection()->getConnection()->prepare($query);
        $stmt->bindValue(':token', $token, \PDO::PARAM_STR);
        $stmt->bindValue(':status', GenericConstantsUtil::ACTIVE, \PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() !== 1)
        {
            header('HTTP/1.1 401 Unauthorized');
            throw new InvalidArgumentException(GenericConstantsUtil::UNAUTHORIZED_TOKEN);
            exit();
        }
    }
}