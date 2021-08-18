<?php

require_once(__DIR__ . '/../bootstrap.php');
session_start();

$app = Slim\Factory\AppFactory::create();
$app->addErrorMiddleware($displayErrorDetails=true, $logErrors=true, $logErrorDetails=true);

AuthController::registerRoutes($app);
HomeController::registerRoutes($app);

$app->run();