<?php

/**
 * 
 * @param className $class
 * 
 **/
function autoload ($class)
{
    $baseDir = BASE_DIR . DS;
    $class   = $baseDir . 'Classes' . DS . str_replace('\\', DS, $class) . '.php';

    if (file_exists($class) && is_file($class))
    {
        require $class;
    }
}

spl_autoload_register("autoload");