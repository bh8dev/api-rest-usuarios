<?php

require 'bootstrap.php';

use Classes\Validator\RequestValidator;
use Classes\Utils\RoutesUtil;
use Classes\Utils\GenericConstantsUtil;
use Classes\Utils\JsonUtil;

try
{
    $requestValidator = new RequestValidator(RoutesUtil::getRoutes());
    $response = $requestValidator->processRequest();

    $jsonUtil = new JsonUtil();
    $jsonUtil->proccessArrayToReturn($response);
}
catch (Exception $exception)
{
    echo json_encode([
        GenericConstantsUtil::TYPE => GenericConstantsUtil::ERROR_TYPE,
        GenericConstantsUtil::RESPONSE => $exception->getMessage()
    ]);
}