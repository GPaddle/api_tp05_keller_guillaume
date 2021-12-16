<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Account\Account;
use App\Domain\Contact\Contact;
use JsonSerializable;

class User implements JsonSerializable
{
    /**
     * @var int|null
     */
    private $id;
    /**
     * @var string
     */
    private  $firstName;

    /**
     * @var string
     */
    private  $lastName;

    /**
     * @var string
     */
    private  $civility;

    /**
     * @var array
     */
    private  $addresses;

    /**
     * @var Contact
     */
    private  $contact;

    /**
     * @var Account
     */
    private  $account;

    /**
     * @param int|null  $id
     * @param string    $firstName
     * @param string    $lastName
     * @param string    $civility
     * @param array     $addresses
     * @param Contact   $contact
     * @param Account   $account
     */
    public function __construct(
        ?int $id,
        string    $firstName,
        string    $lastName,
        string    $civility,
        array     $addresses,
        Contact   $contact,
        Account   $account
    ) {
        $this->id = $id;
        $this->firstName = ucfirst($firstName);
        $this->lastName = ucfirst($lastName);
        $this->civility = ucfirst($civility);
        $this->addresses = $addresses;
        $this->contact = $contact;
        $this->account = $account;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getCivility(): string
    {
        return $this->civility;
    }

    public function getAddresses(): array
    {
        return $this->addresses;
    }

    public function getContact(): Contact
    {
        return $this->contact;
    }

    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'civility' => $this->civility,
            'addresses' => $this->addresses,
            'contact' => $this->contact,
            'account' => $this->account,
        ];
    }
}
