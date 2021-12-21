<?php

declare(strict_types=1);

namespace App\Application\Actions\Address;

use App\Application\Actions\Action;
use App\Domain\Addresses;
use App\Domain\Users;
//use App\Domain\Address\Address;
use Psr\Http\Message\ResponseInterface as Response;

class AddAddressAction extends Action
{
	/**
	 * {@inheritdoc}
	 */
	protected function action(): Response
	{
		$data = $this->request->getParsedBody();

		$address = $data['address'];

		if (!$address['postal_code'] || !preg_match("/[0-9]{5}/", $address['postal_code'])) {
			return $this->sendError('Postal code error');
		}
		if (!$address['city'] || !preg_match("/[A-Z][a-z]+/", $address['city'])) {
			return $this->sendError('City error');
		}
		if (!$address['country'] || !preg_match("/[A-Z][a-z]+/", $address['country'])) {
			return $this->sendError('Country error');
		}

		$addressObject = new Addresses();

		$user = self::$entityManager->getRepository(Users::class)->findOneBy(['id' => $data['user_id']]);

		$addressObject->setStreet($address['street']);
		$addressObject->setPostalCode($address['postal_code']);
		$addressObject->setCity($address['city']);
		$addressObject->setCountry($address['country']);
		$addressObject->setUser($user);

		self::$entityManager->persist($addressObject);
		self::$entityManager->flush();

		return $this->respondWithData($addressObject->getAsArray());
	}
}
