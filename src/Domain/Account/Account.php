<?php

declare(strict_types=1);

namespace App\Domain\Account;

use App\Domain\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PhpParser\Node\Expr\Cast\String_;

class Account extends Model
{
	protected $table = 'accounts';
	public $timestamps = false;

	protected $fillable = [
		'id',
		'login_',
		'hashedpassword',
		'user_id',
	];

	public function setHashedPasswordAttribute(String $password): void
	{
		$this->attributes['hashedpassword'] = password_hash($password, PASSWORD_DEFAULT);
	}

	public function getUser() : BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
