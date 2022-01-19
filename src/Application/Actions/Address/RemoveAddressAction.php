<?php

declare(strict_types=1);

namespace App\Application\Actions\Address;

use App\Application\Actions\Action;
use App\Domain\Addresses;
//use App\Domain\Address\Address;
use Psr\Http\Message\ResponseInterface as Response;

class RemoveAddressAction extends Action
{
	/**
	 * {@inheritdoc}
	 */
	protected function action(): Response
	{
		$addressId = (int) $this->resolveArg('id');

		if ($addressId < 0) {
			return $this->respondWithData("Id $addressId is not possible", 422);
		}

		// $address = Address::find($addressId);
		$address = self::$entityManager->getRepository(Addresses::class)->findOneBy(['id' => $addressId]);

		if (is_null($address)) {
			return $this->respondWithData("Researched address is not found", 422);
		}

		self::$entityManager->remove($address);
		self::$entityManager->flush();

		// $address->delete();

		return $this->respondWithData("Resource with id $addressId deleted");
	}
}
