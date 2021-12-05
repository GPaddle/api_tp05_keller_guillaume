<?php

declare(strict_types=1);

namespace App\Application\Actions\Login;

use App\Application\Actions\Action;
use App\Application\Actions\User\UserAction;
use App\Domain\User\UserNotFoundException;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface as Response;

class LoginAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();

        $pseudo = $data['login'];

        try {
            $user = $this->userRepository->findUserByUsername($pseudo);
        } catch (UserNotFoundException $th) {

            $this->logger->warning("User tried to connect with unknown pseudo : $pseudo");

            $data = [
                'message' => 'unknown pseudo : ' . $pseudo
            ];

            return $this->respondWithData($data, 401);
        }

        $password = $data['password'];
        $userHash = $user->getAccount()->getHashedPassword();

        if (!password_verify($password, $userHash)) {

            $this->logger->warning("User tried to connect with false password for pseudo : $pseudo");

            $data = [
                'message' => "Unknown password for pseudo : $pseudo"
            ];

            return $this->respondWithData($data, 401);
        }

        $issuedAt = time();
        $expirationTime = $issuedAt + 600;

        $payload = [
            'hashedPassword' => $userHash,
            'pseudo' => $pseudo,
            'iat' => $issuedAt,
            'exp' => $expirationTime
        ];

        $token_jwt = JWT::encode($payload, getenv('JWT_SECRET'), "HS256");

        $this->logger->info("New JWT Token created $token_jwt");

        return $this->respondWithDataAndHeaders($data, [["Authorization", "Bearer {$token_jwt}"]]);
    }
}
