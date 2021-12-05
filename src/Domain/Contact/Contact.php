<?php

declare(strict_types=1);

namespace App\Domain\Contact;

use JsonSerializable;

class Contact implements JsonSerializable
{
	/**
	 * @var int|null
	 */
	private $id;
	private $email;
	private $phoneNumber;

	/**
	 * @param int|null  $id
	 * @param string    $email
	 * @param string    $phoneNumber
	 */
	public function __construct(?int $id, string $email, string $phoneNumber)
	{
		$this->id = $id;
		$this->email = $email;
		$this->phoneNumber = $phoneNumber;
	}

	/**
	 * @return int|null
	 */
	public function getId(): ?int
	{
		return $this->id;
	}
	
	public function getEmail(): string
	{
		return $this->email;
	}
	
	public function getPhoneNumber(): string
	{
		return $this->phoneNumber;
	}
	
	/**
	 * @return array
	 */
	public function jsonSerialize()
	{
		return [
			'id' => $this->id,
			'email' => $this->email,
			'phoneNumber' => $this->phoneNumber,
		];
	}
}
