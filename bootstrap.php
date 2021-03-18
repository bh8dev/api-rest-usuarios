<?php

require 'config.php';

if (file_exists('autoload.php') && is_file('autoload.php'))
{
    require 'autoload.php';
}
else
{
    echo "Error while including the file";
    exit();
}