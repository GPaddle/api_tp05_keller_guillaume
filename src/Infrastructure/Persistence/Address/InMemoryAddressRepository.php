<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Address;

use App\Domain\Address\Address;
use App\Domain\Address\AddressNotFoundException;
use App\Domain\Address\AddressRepository;

class InMemoryAddressRepository implements AddressRepository
{
	/**
	 * @var Address[]
	 */
	private $addresses;

	/**
	 * InMemoryAddressRepository constructor.
	 *
	 * @param array|null $addresses
	 */
	public function __construct(array $addresses = null)
	{
		$this->addresses = $addresses ?? [
			1 => new Address(1, "Microsoft street", "00000", "Test", "USA"),
			2 => new Address(2, "Apple street", "00000", "Test", "USA"),
			3 => new Address(3, "Facebook street", "00000", "Test", "USA"),
			4 => new Address(4, "Snapchat street", "00000", "Test", "USA"),
			5 => new Address(5, "Twitter street", "00000", "Test", "USA"),
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function findAll(): array
	{
		return $this->addresses;
	}

	/**
	 * {@inheritdoc}
	 */
	public function findAddressOfId(int $id): Address
	{
		if (!isset($this->addresses[$id])) {
            throw new AddressNotFoundException();
        }

        return $this->users[$id];
	}
}
