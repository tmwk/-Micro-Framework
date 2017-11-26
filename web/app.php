<?php

use Symfony\Component\HttpFoundation\Request;

$loader = require __DIR__.'/../app/autoload.php';
require_once __DIR__.'/../app/MicroKernel.php';
require_once __DIR__.'/../app/AppCache.php';

$app = new MicroKernel('prod', false);
$app->loadClassCache();
$app = new AppCache($app);

$request = Request::createFromGlobals();
$response = $app->handle($request);
$response->send();

$app->terminate($request, $response);
