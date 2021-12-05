<?php

declare(strict_types=1);

namespace App\Application\Actions\Register;

use App\Application\Actions\Action;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface as Response;

class RegisterAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();

        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

        $pseudo = $data['login'];

        $issuedAt = time();
        $expirationTime = $issuedAt + 600;

        $payload = [
            'hashedPassword' => $hashedPassword,
            'pseudo' => $pseudo,
            'iat' => $issuedAt,
            'exp' => $expirationTime
        ];

        $token_jwt = JWT::encode($payload, getenv('JWT_SECRET'), "HS256");

        $this->logger->info("New JWT Token created $token_jwt");

        return $this->respondWithDataAndHeaders($data, [["Authorization", "Bearer {$token_jwt}"]]);
    }
}
