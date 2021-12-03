<?php

declare(strict_types=1);

use App\Application\Middleware\SessionMiddleware;
use Slim\App;
use Slim\Exception\HttpException;
use Tuupola\Middleware\JwtAuthentication;

return function (App $app) {
    $app->add(SessionMiddleware::class);

    $app->add(
        new JwtAuthentication(
            [
                "path" => ["/api"],
                "ignore" => ["/api/login"],
                "attribute" => "token",
                "secure" => false,
                "header" => "Authorization",
                "algorithm" => ["HS256"],
                'secret' => getenv('JWT_SECRET'),

                "error" => function ($response, $arguments) {
                    $data["status"] = "error";
                    $data["message"] = $arguments["message"];
                    return $response
                        ->withHeader("Content-Type", "application/json")
                        ->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
                }
            ]
        )
    );
};
