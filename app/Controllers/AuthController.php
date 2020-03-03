<?php


namespace App\Controllers;


use Slim\Http\Response;
use Slim\Http\ServerRequest;

class AuthController extends BaseController
{
    public function login(ServerRequest $request, Response $response)
    {
        return $response->withJson('OK');
    }

    public function logout(ServerRequest $request, Response $response)
    {
        return $response->withJson('OK');
    }
}