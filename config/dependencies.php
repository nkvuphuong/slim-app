<?php
declare(strict_types=1);

use App\Models\AccessToken;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Http\Response;
use Tuupola\Middleware\JwtAuthentication;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get('settings');

            $loggerSettings = $settings['logger'];
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        'jwt_auth' => function () {
            return new JwtAuthentication([
                'secret' => getenv('JWT_SECRET'),
                'secure' => false,
                "error" => function (ResponseInterface $response, $arguments) {
                    $errors[] = [
                        'code' => 'auth_failed',
                        'msg' => $arguments['message'],
                        'clientMsg' => $arguments['message']
                    ];
                    $response->getBody()->write(json_encode($errors, JSON_UNESCAPED_UNICODE));
                    return $response
                        ->withHeader("Content-Type", "application/json");
                },
                'after' => function (Response $response, $arguments) {
                    //Check token in database
                    $token = $arguments['token'];
                    $tokenData = AccessToken::find($token);

                    if (!$tokenData) {

                        $errors[] = [
                            'code' => 'auth_failed',
                            'msg' => 'Access token does not exist',
                            'clientMsg' => 'Invalid access token'
                        ];

                        return $response->withJson($errors, 401);
                    }

                    return $response;
                }
            ]);
        },
    ]);
};
