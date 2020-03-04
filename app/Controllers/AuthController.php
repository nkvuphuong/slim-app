<?php


namespace App\Controllers;


use App\Repositories\Contracts\AuthInterface;
use App\Repositories\Contracts\UserInterface;
use Psr\Log\LoggerInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

class AuthController extends BaseController
{
    private $userRepository;
    private $authRepository;

    public function __construct(LoggerInterface $logger, UserInterface $userRepository, AuthInterface $authRepository)
    {
        parent::__construct($logger);
        $this->userRepository = $userRepository;
        $this->authRepository = $authRepository;
    }

    public function login(ServerRequest $request, Response $response)
    {
//        dd($this->userRepository->find(1));
        return $response->withJson('OK');
    }

    public function logout(ServerRequest $request, Response $response)
    {
        return $response->withJson('OK');
    }
}