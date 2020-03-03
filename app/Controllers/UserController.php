<?php


namespace App\Controllers;


use Slim\Http\Response as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;

class UserController
{
    public function __construct(LoggerInterface $logger)
    {
    }

    public function index(Request $request, Response $response)
    {
        return $response->withJson(['x' => '2'], 500);
    }

    public function find($id, Response $response)
    {
        return $response->withJson($id, 200);
    }
}