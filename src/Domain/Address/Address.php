<?php

declare(strict_types=1);

namespace App\Domain\Address;

use JsonSerializable;

class Address implements JsonSerializable
{
	/**
	 * @var int|null
	 */
	private $id;
	private $street;
	private $postalCode;
	private $city;
	private $country;

	/**
	 * @param int|null  $id
	 * @param string    $street
	 * @param string    $postalCode
	 * @param string    $city
	 * @param string    $country
	 */
	public function __construct(?int $id, string $street, string $postalCode, string $city, string $country)
	{
		$this->id = $id;
		$this->street = $street;
		$this->postalCode = $postalCode;
		$this->city = ucfirst($city);
		$this->country = ucfirst($country);
	}

	/**
	 * @return int|null
	 */
	public function getId(): ?int
	{
		return $this->id;
	}
	
	public function getStreet(): string
	{
		return $this->street;
	}
	
	public function getPostalCode(): string
	{
		return $this->postalCode;
	}
	
	public function getCity(): string
	{
		return $this->city;
	}
	
	public function getCountry(): string
	{
		return $this->country;
	}

	/**
	 * @return array
	 */
	public function jsonSerialize()
	{
		return [
			'id' => $this->id,
			'street' => $this->street,
			'postalCode' => $this->postalCode,
			'city' => $this->city,
			'country' => $this->country,
		];
	}
}
