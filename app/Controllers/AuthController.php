<?php


namespace App\Controllers;


use App\Repositories\Contracts\UserRepositoryInterface;
use Psr\Log\LoggerInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

class AuthController extends BaseController
{
    private $userRepository;

    public function __construct(LoggerInterface $logger, UserRepositoryInterface $userRepository)
    {
        parent::__construct($logger);
        $this->userRepository = $userRepository;
    }

    public function login(ServerRequest $request, Response $response)
    {
        dd($this->userRepository->find(1));
        return $response->withJson('OK');
    }

    public function logout(ServerRequest $request, Response $response)
    {
        return $response->withJson('OK');
    }
}