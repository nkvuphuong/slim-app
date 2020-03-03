<?php
declare(strict_types=1);

use DI\Bridge\Slim\Bridge;
use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\ServerRequestCreatorFactory;

require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createImmutable(__DIR__ . '/../')->safeLoad();

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

if (false) { // Should be set to true in production
	$containerBuilder->enableCompilation(__DIR__ . '/../var/cache');
}

// Set up settings
$settings = require __DIR__ . '/../config/settings.php';
$settings($containerBuilder);

// Set up dependencies
$dependencies = require __DIR__ . '/../config/dependencies.php';
$dependencies($containerBuilder);

// Set up repositories
$repositories = require __DIR__ . '/../config/repositories.php';
$repositories($containerBuilder);

// Build PHP-DI Container instance
try {
    $container = $containerBuilder->build();
} catch (Exception $e) {
    die($e->getMessage());
}

// Instantiate the app
$app = Bridge::create($container);
$callableResolver = $app->getCallableResolver();

//Database
$database = require __DIR__ . '/../config/database.php';
$database($container);

// Register middleware
$middleware = require __DIR__ . '/../config/middleware.php';
$middleware($app);

// Register routes
$routes = require __DIR__ . '/../config/routes.php';
$routes($app);


// Create Request object from globals
$serverRequestCreator = ServerRequestCreatorFactory::create();
$request = $serverRequestCreator->createServerRequestFromGlobals();

// Add Routing Middleware
$app->addRoutingMiddleware();

/** @var bool $displayErrorDetails */
try {
    $displayErrorDetails = (boolean)$container->get('settings')['displayErrorDetails'];
    $logErrors = (boolean)$container->get('settings')['logErrors'];
    $logErrorDetails = (boolean)$container->get('settings')['logErrorDetails'];
} catch (DependencyException $e) {
    die($e->getMessage());
} catch (NotFoundException $e) {
    die($e->getMessage());
}

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, $logErrors, $logErrorDetails);

// Get the default error handler and register my custom error renderer.
$errorHandler = $errorMiddleware->getDefaultErrorHandler();
$errorHandler->forceContentType('application/json');

$app->run();