<?php

declare(strict_types=1);

namespace App\Application\Actions\Login;

use Exception;
use App\Application\Actions\Action;
use App\Domain\Accounts;
use App\Domain\Users;
use Doctrine\ORM\EntityNotFoundException;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface as Response;

require_once __DIR__ . '/../../../../bootstrap.php';

class LoginAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();

        $pseudo = $data['login'];

        try {
            $accountRepository = self::$entityManager->getRepository(Accounts::class);
    
            $userAccount = $accountRepository->findOneBy(array('login' => $pseudo));


            // $user = $this->userRepository->findUserByUsername($pseudo);
            // $userAccount = Account::where(['login_' => $pseudo])->first();
            // } catch (UserNotFoundException $th) {
        } catch (EntityNotFoundException $th) {

            $this->logger->warning("User tried to connect with unknown pseudo : $pseudo");

            $data = [
                'message' => 'unknown pseudo : ' . $pseudo
            ];

            return $this->respondWithData($data, 401);
        }

        $password = $data['password'];
        $userHash = $userAccount->getHashedpassword();

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

        // $data = User::find($userAccount->user_id);
        $data = $userAccount->getUser()->getAsArray();

        return $this->respondWithDataAndHeaders($data, [["Authorization", "Bearer {$token_jwt}"]]);
    }
}
