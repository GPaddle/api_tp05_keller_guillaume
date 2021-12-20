<?php

declare(strict_types=1);

namespace App\Domain\Contact;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = 'contacts';
	public $timestamps = false;

	protected $fillable = [
		'id',
		'email',
		'phone_number',
		'user_id',
	];

	public function getUser()
	{
		return $this->belongsTo(User::class);
	}
}
