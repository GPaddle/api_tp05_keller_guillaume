<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Account;

use App\Domain\Account\Account;
use App\Domain\Account\AccountNotFoundException;
use App\Domain\Account\AccountRepository;

class InMemoryAccountRepository implements AccountRepository
{
	/**
	 * @var Account[]
	 */
	private $account;

	/**
	 * InMemoryAccountRepository constructor.
	 *
	 * @param array|null $account
	 */
	public function __construct(array $account = null)
	{
		$this->account = $account ?? [
			1 => new Account([1, 'bill.gates', 'azerty']),
			2 => new Account([2, 'steve.jobs', 'azerty']),
			3 => new Account([3, 'mark.zuckerberg', 'azerty']),
			4 => new Account([4, 'evan.spiegel', 'azerty']),
			5 => new Account([5, 'jack.dorsey', 'azerty']),
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function findAll(): array
	{
		return $this->account;
	}

	/**
	 * {@inheritdoc}
	 */
	public function findAccountOfId(int $id): Account
	{
		if (!isset($this->account[$id])) {
            throw new AccountNotFoundException();
        }

        return $this->users[$id];
	}
}
