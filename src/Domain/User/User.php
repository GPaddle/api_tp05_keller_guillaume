<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Account\Account;
use App\Domain\Address\Address;
use App\Domain\Contact\Contact;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'users';
    protected $fillable = [
        'id',
        'firstName',
        'lastName',
        'civility',
        'addresses',
        'contact',
        'account',
    ];

    protected $with = [
        'addresses',
        'contact',
        'account',
    ];

    public $timestamps = false;

    /**
     * @var int
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
     * @var Address[]
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function setFirstNameAttribute(String $firstName): void
    {
        $this->attributes['firstname'] = ucfirst($firstName);
    }

    public function getFirstName(): string
    {
        return $this->attributes['firstname'];
    }

    public function setLastNameAttribute(String $lastName): void
    {
        $this->attributes['lastname'] = ucfirst($lastName);
    }

    public function getLastName(): string
    {
        return $this->attributes['lastname'];
    }

    public function setCivilityAttribute(String $civility): void
    {
        $this->attributes['civility'] = ucfirst($civility);
    }

    public function getCivility(): string
    {
        return $this->attributes['civility'];
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function contact()
    {
        return $this->hasOne(Contact::class);
    }

    public function account()
    {
        return $this->hasOne(Account::class);
    }
}
