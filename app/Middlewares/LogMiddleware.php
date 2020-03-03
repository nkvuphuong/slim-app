<?php


namespace App\Middlewares;


use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Log\LoggerInterface;

class LogMiddleware
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var mixed|LoggerInterface
     */
    private $logger;

    /**
     * LogMiddleware constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->logger = $container->get(LoggerInterface::class);
    }

    /**
     * @param Request $request
     * @param RequestHandler $handler
     * @return ResponseInterface
     */
    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface
    {
        $response = $handler->handle($request);

        $method = $request->getMethod();
        $headers = $request->getHeaders();

        $requestData = [];

        switch ($method) {
            case 'PUT':
            case 'POST':
                $requestData = $request->getParsedBody();
                break;
            case 'GET':
                $requestData = $request->getQueryParams();
                break;
            default:
                break;
        }

        $data = [
            'request_header' => $headers,
            'request' => $requestData,
            'response_header' => $response->getHeaders(),
            'response_status_code' => $response->getStatusCode(),
            'response' =>  $response->getBody()->getContents(),
            'ip' => $_SERVER['REMOTE_ADDR']
        ];

        $this->logger->info("$method {$request->getServerParam('REDIRECT_URL')}", $data);

        return $response;
    }
}