<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Contact;

use App\Domain\Contact\Contact;
use App\Domain\Contact\ContactNotFoundException;
use App\Domain\Contact\ContactRepository;

class InMemoryContactRepository implements ContactRepository
{
	/**
	 * @var Contact[]
	 */
	private $contacts;

	/**
	 * InMemoryContactRepository constructor.
	 *
	 * @param array|null $contacts
	 */
	public function __construct(array $contacts = null)
	{
		$this->contacts = $contacts ?? [
			1 => new Contact(1, 'bill.gates', 'azerty'),
			2 => new Contact(2, 'steve.jobs', 'azerty'),
			3 => new Contact(3, 'mark.zuckerberg', 'azerty'),
			4 => new Contact(4, 'evan.spiegel', 'azerty'),
			5 => new Contact(5, 'jack.dorsey', 'azerty'),
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function findAll(): array
	{
		return $this->contacts;
	}

	/**
	 * {@inheritdoc}
	 */
	public function findContactOfId(int $id): Contact
	{
		if (!isset($this->contacts[$id])) {
			throw new ContactNotFoundException();
		}

		return $this->users[$id];
	}
}
