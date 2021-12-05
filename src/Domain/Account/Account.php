<?php

declare(strict_types=1);

namespace App\Domain\Account;

use JsonSerializable;

class Account implements JsonSerializable
{
	/**
	 * @var int|null
	 */
	private $id;
	private $login;
	private $hashedPassword;

	/**
	 * @param int|null  $id
	 * @param string    $login
	 * @param string    $hashedPassword
	 */
	public function __construct(?int $id, string $login, string $password)
	{
		$this->id = $id;
		$this->login = $login;
		$this->hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	}

	/**
	 * @return int|null
	 */
	public function getId(): ?int
	{
		return $this->id;
	}
	
	public function getLogin(): string
	{
		return $this->login;
	}
	
	public function getHashedPassword(): string
	{
		return $this->hashedPassword;
	}
	
	/**
	 * @return array
	 */
	public function jsonSerialize()
	{
		return [
			'id' => $this->id,
			'login' => $this->login,
			'hashedPassword' => $this->hashedPassword,
		];
	}
}
