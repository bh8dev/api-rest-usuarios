<?php

namespace Classes\Utils;

use JsonException;
use InvalidArgumentException;

class JsonUtil
{
    public static function manageJsonRequestBody():array
    {
        try
        {
            $postJson = json_decode(file_get_contents('php://input'), true);
        }
        catch (JsonException $jsonException)
        {
            throw new InvalidArgumentException(GenericConstantsUtil::EMPTY_BODY);
        }

        if (is_array($postJson) && count($postJson) > 0)
        {
            return $postJson;
        }
    }

    public function proccessArrayToReturn(array $responseArray)
    {
        $data = [];
        $data[GenericConstantsUtil::TYPE] = GenericConstantsUtil::ERROR_TYPE;

        if(is_array($responseArray) && count($responseArray) > 0 || strlen($responseArray) > 10)
        {
            $data[GenericConstantsUtil::TYPE] = GenericConstantsUtil::SUCCESS_TYPE;
            $data[GenericConstantsUtil::RESPONSE] = $responseArray;
        }
        else
        {
            throw new InvalidArgumentException("Array vazio ou nulo {$responseArray}");
        }

        $this->returnJson($data);

    }

    private function returnJson(array $array)
    {
        header('Content-Type: application/json');
        header('Cache-Control: no-cache, no-tore, must-revalidate');
        echo json_encode($array);
    }
}