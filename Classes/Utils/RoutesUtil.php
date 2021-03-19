<?php

namespace Classes\Utils;

class RoutesUtil
{

    public static function getRoutes():array
    {
        $urls = self::getUrls();

        $request = [
            'endpoint' => filter_var($urls[0], FILTER_SANITIZE_STRING),
            'resource' => filter_var($urls[1], FILTER_SANITIZE_STRING) ?? null,
            'id' => filter_var($urls[2], FILTER_VALIDATE_INT) ?? null,
            'method' => filter_var($_SERVER['REQUEST_METHOD'], FILTER_SANITIZE_STRING)
        ];
        
        return $request;
    }

    public static function getUrls()
    {
        $uri = str_replace('/' . PROJECT_DIR, '', $_SERVER['REQUEST_URI']);
        return explode('/', trim($uri, '/'));
    }
}