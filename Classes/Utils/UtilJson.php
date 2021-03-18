<?php

namespace Classes\Utils;

use JsonException;
use InvalidArgumentException;

class UtilJson
{
    public static function manageJsonRequestBody ():array
    {
        try
        {
            $postJson = json_decode(file_get_contents('php://input'), true);
        }
        catch (JsonException $jsonException)
        {
            throw new InvalidArgumentException(UtilGenericConstants::EMPTY_BODY);
        }

        if (is_array($postJson) && count($postJson) > 0)
        {
            return $postJson;
        }
    }
}