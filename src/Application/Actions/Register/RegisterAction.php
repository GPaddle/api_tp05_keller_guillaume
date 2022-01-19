<?php

declare(strict_types=1);

namespace App\Application\Actions\Register;

use App\Application\Actions\Action;
use App\Domain\Accounts;
use App\Domain\Addresses;
use App\Domain\Contacts;
use App\Domain\Users;
//use App\Domain\Account\Account;
//use App\Domain\Address\Address;
//use App\Domain\Category\CategoryRepository;
//use App\Domain\Contact\Contact;
//use App\Domain\User\User;
use Doctrine\ORM\EntityManager;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

require_once __DIR__ . '/../../../../bootstrap.php';

class RegisterAction extends Action
{

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

        $accountRepository = self::$entityManager->getRepository(Accounts::class);

        if (! is_null($accountRepository->findOneBy(['login' => $login]))) {
            return $this->sendError('Login already exists, please find a new one');
        }

        $pass = $data['account']['password'] ?? "";
        if (!preg_match("/.{5}.*/", $pass)) {
            return $this->sendError('A problem occured during the authentication verification, please modify your Password');
        }

        if (!preg_match("/[a-zA-Z]{1,20}/", $data['firstName'])) {
            return $this->sendError('FirstName looks problematic');
        }
        if (!preg_match("/[a-zA-Z]{1,20}/", $data['lastName'])) {
            return $this->sendError('LastName looks problematic');
        }
        if (!in_array($data['civility'], ['Monsieur', 'Madame', 'Nothing'])) {
            return $this->sendError('Civility looks weird');
        }

        if (!preg_match("/.*@.*\..*/", $data['contact']['email'])) {
            return $this->sendError('Email error');
        }

        if (!preg_match("/[0-9]{10}|\\+33[0-9]{9}/", $data['contact']['phoneNumber'])) {
            return $this->sendError('Phone number error');
        }

        $user = new Users();

        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);
        $user->setCivility($data['civility']);


        $contact = new Contacts();

        $contact->setEmail($data['contact']['email']);
        $contact->setPhoneNumber($data['contact']['phoneNumber']);
        $contact->setUser($user);

        self::$entityManager->persist($user);
        self::$entityManager->persist($contact);

        foreach ($data['addresses'] as $address) {

            if (!preg_match("/[0-9]{5}/", $address['postal_code'])) {
                return $this->sendError('Postal code error');
            }
            if (!preg_match("/([a-zA-Z\\u0080-\\u024F]+(?:. |-| |'))*[a-zA-Z\\u0080-\\u024F]*/", $address['city'])) {
                return $this->sendError('City error');
            }
            if (!preg_match("/[A-Z][a-z]+/", $address['country'])) {
                return $this->sendError('Country error');
            }

            $addressDB = new Addresses();

            $addressDB->setStreet($address['street']);
            $addressDB->setPostalCode($address['postal_code']);
            $addressDB->setCity($address['city']);
            $addressDB->setCountry($address['country']);
            $addressDB->setUser($user);

            self::$entityManager->persist($addressDB);
        }


        $account = new Accounts();
        $account->setLogin($login);
        $account->setUser($user);

        $account->setHashedpassword($pass);

        self::$entityManager->persist($account);
        self::$entityManager->flush();
        
        $issuedAt = time();
        $expirationTime = $issuedAt + 600;

        $payload = [
            'pseudo' => $login,
            'iat' => $issuedAt,
            'exp' => $expirationTime
        ];

        $token_jwt = JWT::encode($payload, getenv('JWT_SECRET'), "HS256");

        $this->logger->info("New JWT Token created $token_jwt");

        $data = [
            "object" => $user->getAsArray(),
            "message" => "Account successfuly created with login $login"
        ];

        return $this->respondWithDataAndHeaders($data, [["Authorization", "Bearer {$token_jwt}"]]);
    }
}
