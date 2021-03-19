<?php

namespace Classes\Database;

use PDO;
use PDOException;
use Classes\Utils\GenericConstantsUtil;
use InvalidArgumentException;

class MySql
{
    private object $databaseObject;

    public function __construct()
    {
        $this->databaseObject = $this->setConnection();
    }

    public function getConnection()
    {
        return $this->databaseObject;
    }
    public function setConnection()
    {
        try
        {
            return new PDO('mysql:host=' . HOST . ';' . 'dbname=' . DB_NAME, DB_USER, DB_PASSWD, DB_OPTIONS);
        }
        catch (PDOException $exception)
        {
            throw new PDOException($exception->getMessage());
        }
    }

    public function delete (string $table, int $id)
    {
        $queryToDelete = "DELETE FROM {$table} WHERE id = :id";

        if ($table && $id)
        {
            $this->databaseObject->beginTransaction();

            $stmt = $this->databaseObject->prepare($queryToDelete);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0)
            {
                $this->databaseObject->commit();
                return GenericConstantsUtil::DELETED_SUCCESSFULLY;
            }
            else
            {
                $this->databaseObject->rollBack();
                throw new InvalidArgumentException(GenericConstantsUtil::NO_DATA_RETURNED);
            }
        }
        else
        {
            throw new InvalidArgumentException(GenericConstantsUtil::GENERIC_ERROR);
        }
    }

    public function getAll (string $table)
    {
        if ($table)
        {
            $query = "SELECT * FROM {$table}";
            $stmt = $this->databaseObject->query($query);

            $returnedRecords = $stmt->fetchAll($this->databaseObject::FETCH_ASSOC);

            if (is_array($returnedRecords) && count($returnedRecords) > 0)
            {
                return $returnedRecords;
            }
            else
            {
                throw new InvalidArgumentException(GenericConstantsUtil::NO_DATA_RETURNED);
            }
        }
    }

    public function getById (string $table, int $id)
    {
        if ($table && $id)
        {
            $query = "SELECT * FROM {$table} WHERE id = :id";

            $stmt = $this->databaseObject->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $returnedRecord = $stmt->rowCount();
            if ($returnedRecord === 1)
            {
                return $stmt->fetch($this->databaseObject::FETCH_ASSOC);
            }
            else
            {
                throw new InvalidArgumentException(GenericConstantsUtil::NO_DATA_RETURNED);
            }
        }
        else
        {
            throw new InvalidArgumentException(GenericConstantsUtil::ID_REQUIRED);
        }
    }
}