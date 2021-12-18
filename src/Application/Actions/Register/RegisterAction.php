<?php

declare(strict_types=1);

namespace App\Application\Actions\Register;

use App\Application\Actions\Action;
use App\Domain\Account\Account;
use App\Domain\Address\Address;
use App\Domain\Category\CategoryRepository;
use App\Domain\Contact\Contact;
use App\Domain\User\User;
use Doctrine\ORM\EntityManager;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

require_once __DIR__ . '/../../../../bootstrap.php';

class RegisterAction extends Action
{
    /**
     * @param LoggerInterface $logger
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        LoggerInterface $logger,
        CategoryRepository $categoryRepository
    ) {
        parent::__construct($logger);
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();

        $login = $data['account']['login'] ?? "";

        if (!preg_match("/[A-Za-z0-9_]{2}(?:[A-Za-z0-9_]{2,})?/", $login)) {
            return $this->sendError('A problem occured during the registration verification, please modify your Login');
        }

        if (Account::where(['login_' => $login])->count() > 0) {
            return $this->sendError('Login already exists, please find a new one');
        }

        $pass = $data['account']['password'] ?? "";
        if (!preg_match("/[a-zA-Z0-9]{1,20}/", $pass)) {
            return $this->sendError('A problem occured during the authentication verification, please modify your Password');
        }

        if (!preg_match("/[a-zA-Z]{1,20}/", $data['firstName'])) {
            return $this->sendError('FirstName looks problematic');
        }
        if (!preg_match("/[a-zA-Z]{1,20}/", $data['lastName'])) {
            return $this->sendError('LastName looks problematic');
        }
        if (!in_array($data['civility'], ['Monsieur', 'Madame', 'Autre'])) {
            return $this->sendError('Civility looks weird');
        }

        if (!preg_match("/.*@.*\..*/", $data['contact']['email'])) {
            return $this->sendError('Email error');
        }

        if (!preg_match("/[0-9]{10}/", $data['contact']['phoneNumber'])) {
            return $this->sendError('Phone number error');
        }

        $user = User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'civility' => $data['civility']
        ]);


        Contact::create([
            'email' => $data['contact']['email'],
            'phone_number' => $data['contact']['phoneNumber'],
            'user_id' => $user->id
        ]);

        foreach ($data['addresses'] as $address) {

            if (!preg_match("/[0-9]{5}/", $address['postal_code'])) {
                return $this->sendError('Postal code error');
            }
            if (!preg_match("/[A-Z][a-z]+/", $address['city'])) {
                return $this->sendError('City error');
            }
            if (!preg_match("/[A-Z][a-z]+/", $address['country'])) {
                return $this->sendError('Country error');
            }

            Address::create([
                'street' => $address['street'],
                'postal_code' => $address['postal_code'],
                'city' => $address['city'],
                'country' => $address['country'],
                'user_id' => $user->id
            ]);
        }


        $account = Account::create([
            'login_' => $login,
            'user_id' => $user->id
        ]);

        $account->setHashedPasswordAttribute($pass);
        $account->save();

        $issuedAt = time();
        $expirationTime = $issuedAt + 600;

        $payload = [
            'pseudo' => $login,
            'iat' => $issuedAt,
            'exp' => $expirationTime
        ];

        $token_jwt = JWT::encode($payload, getenv('JWT_SECRET'), "HS256");

        $this->logger->info("New JWT Token created $token_jwt");

//TODO : get the total user

        $data = [
            "object" => User::find($user->id),
            "message" => "Account successfuly created with login $login"
        ];

        return $this->respondWithDataAndHeaders($data, [["Authorization", "Bearer {$token_jwt}"]]);
    }

    protected function sendError(String $message)
    {
        $data = [
            'message' => ucfirst($message)
        ];

        return $this->respondWithData($data, 422);
    }
}
