<?php

declare(strict_types=1);

namespace App\Application\Actions\Address;

use App\Application\Actions\Action;
use App\Domain\Address\Address;
use Psr\Http\Message\ResponseInterface as Response;

class AddAddressAction extends Action
{
	/**
	 * {@inheritdoc}
	 */
	protected function action(): Response
	{
		// $metadata = $this->metadataRepository->findAll();

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

		$city = $data['address']['city'];
		$country = $data['address']['country'];
		$postalCode = $data['address']['postal_code'];
		$street = $data['address']['street'];

		$address = Address::create([
			'street'=>$street,
			'postal_code'=>$postalCode,
			'city'=>$city,
			'country'=>$country,
			'user_id'=>$data['user_id'],
		]);

		return $this->respondWithData($address);
	}

	protected function sendError(String $message)
	{
		$data = [
			'message' => ucfirst($message)
		];

		return $this->respondWithData($data, 422);
	}
}
