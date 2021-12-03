<?php

declare(strict_types=1);

use App\Application\Middleware\SessionMiddleware;
use Slim\App;
use Tuupola\Middleware\JwtAuthentication;

return function (App $app) {
    $app->add(SessionMiddleware::class);

    $app->add(
        new JwtAuthentication(
            [
                "path" => ["/api/users"],
                "ignore" => ["/api/home"],
                "attribute" => "token",
                "secure" => false,
                "header" => "Authorization",
                "algorithm" => ["HS256"],
                'secret' => getenv('JWT_SECRET'),
                "error" => function ($response, $arguments) {
                    $data = array('ERREUR' => 'Connexion', 'ERREUR' => 'JWT Non valide');
                    $response = $response->withStatus(401);
                    return $response->withHeader("Content-Type", "application/json")->getBody()->write(json_encode($data));
                }
            ]
        )
    );
};
