<?php

declare(strict_types=1);

namespace App\Domain\Address;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

	protected $table = 'addresses';
	public $timestamps = false;

	protected $fillable = [
		'id',
		'street',
		'postal_code',
		'city',
		'country',
		'user_id',
	];

	/**
	 * @var int
	 */
	private $id;
	private $street;
	private $postal_code;
	private $city;
	private $country;
	private $user_id;

	public function getUser(){
		return $this->belongsTo(User::class);
	}

	public function setCityAttribute(String $city): void
    {
        $this->attributes['city'] = ucfirst($city);
    }

	public function setCountryAttribute(String $country): void
    {
        $this->attributes['country'] = ucfirst($country);
    }

}
