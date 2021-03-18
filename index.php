<?php

require 'bootstrap.php';

use Classes\Validator\RequestValidator;
use Classes\Utils\UtilRoutes;
use Classes\Utils\UtilGenericConstants;

try
{
    $requestValidator = new RequestValidator(UtilRoutes::getRoutes());
    $response = $requestValidator->processRequest();
}
catch (Exception $exception)
{
    echo json_encode(
        [
           UtilGenericConstants::TYPE => UtilGenericConstants::ERROR_TYPE,
           UtilGenericConstants::RESPONSE => $exception->getMessage()
        ]
    );
    exit();
}