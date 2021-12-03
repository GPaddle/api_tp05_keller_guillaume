<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {

    $app->group('/api', function (Group $group) {
        $group->options('/{routes:.*}', function (Request $request, Response $response) {
            // CORS Pre-Flight OPTIONS Request Handler
            return $response;
        });

        $group->get('/home', function (Request $request, Response $response) {

            $issuedAt = time();
            $expirationTime = $issuedAt + 600;
            $payload = array(
                'userid' => $userid ?? null,
                'email' => $email ?? null,
                'pseudo' => $pseudo ?? null,
                'iat' => $issuedAt,
                'exp' => $expirationTime
            );

            $token_jwt = JWT::encode($payload, getenv('JWT_SECRET'), "HS256");

            $response->getBody()->write('Hello world!');
            $response = $response->withHeader("Authorization", "Bearer {$token_jwt}");
            return $response;
        });

        $group->group('/users', function (Group $groupUsers) {
            $groupUsers->get('', ListUsersAction::class);
            $groupUsers->get('/{id}', ViewUserAction::class);
        });
    });
};
