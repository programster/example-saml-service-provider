<?php

require_once(__DIR__ . '/vendor/autoload.php');

require_once(__DIR__ . '/defines.php');

$autoloader = new \iRAP\Autoloader\Autoloader([
    __DIR__,
    __DIR__ . '/controllers',
    __DIR__ . '/libs',
    __DIR__ . '/models',
    __DIR__ . '/views',
]);

