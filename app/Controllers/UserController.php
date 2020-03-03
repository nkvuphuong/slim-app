<?php


namespace App\Controllers;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController
{
    public function __construct()
    {
    }

    public function index(Request $request, Response $response)
    {
        $response->getBody()->write('OK');
        return $response;
    }

    public function find($id, Response $response)
    {
        $response->getBody()->write($id);
        return $response;
    }
}