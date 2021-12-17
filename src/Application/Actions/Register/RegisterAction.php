<?php

declare(strict_types=1);

namespace App\Application\Actions\Register;

use App\Application\Actions\Action;
use Doctrine\ORM\EntityManager;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface as Response;

require_once __DIR__ . '/../../../../bootstrap.php';

class RegisterAction extends Action
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();

        $login = $data['login'] ?? "";
        $pass = $data['password'] ?? "";

        if (!preg_match("/[A-Za-z0-9_]{2}(?:[A-Za-z0-9_]{2,})?/", $login)) {
            $data = [
                'message' => 'A problem occured during the authentication verification, please modify your Login'
            ];

            return $this->respondWithData($data, 401);
        }
        if (!preg_match("/[a-zA-Z0-9]{1,20}/", $pass)) {
            $data = [
                'message' => 'A problem occured during the authentication verification, please modify your Password'
            ];

            return $this->respondWithData($data, 401);
        }

        $utilisateurRepository = $this->em->getRepository('App\Domain\User');

        $utilisateur = $utilisateurRepository->findOneBy(array('login' => $login, 'password' => $pass));

        $issuedAt = time();
        $expirationTime = $issuedAt + 600;

        $payload = [
            // 'hashedPassword' => $hashedPassword,
            // 'pseudo' => $pseudo,
            'iat' => $issuedAt,
            'exp' => $expirationTime
        ];

        $token_jwt = JWT::encode($payload, getenv('JWT_SECRET'), "HS256");

        $this->logger->info("New JWT Token created $token_jwt");

        return $this->respondWithDataAndHeaders($data, [["Authorization", "Bearer {$token_jwt}"]]);
    }
}
