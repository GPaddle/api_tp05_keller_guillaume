<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\Account\InMemoryAccountRepository;
use App\Infrastructure\Persistence\Address\InMemoryAddressRepository;
use App\Infrastructure\Persistence\Contact\InMemoryContactRepository;

class InMemoryUserRepository implements UserRepository
{
    /**
     * @var User[]
     */
    private $users;

    /**
     * InMemoryUserRepository constructor.
     *
     * @param array|null $users
     */
    public function __construct(array $users = null)
    {
        $addresses = (new InMemoryAddressRepository())->findAll();
        $contacts = (new InMemoryContactRepository())->findAll();
        $accounts = (new InMemoryAccountRepository())->findAll();

        $this->users = $users ?? [
            1 => new User(1, 'Bill', 'Gates', 'Mr', [$addresses[1]], $contacts[1], $accounts[1]),
            2 => new User(2, 'Steve', 'Jobs', 'Mr', [$addresses[2]], $contacts[2], $accounts[2]),
            3 => new User(3, 'Mark', 'Zuckerberg', 'Mr', [$addresses[3]], $contacts[3], $accounts[3]),
            4 => new User(4, 'Evan', 'Spiegel', 'Mr', [$addresses[4]], $contacts[4], $accounts[4]),
            5 => new User(5, 'Jack', 'Dorsey', 'Mr', [$addresses[5]], $contacts[5], $accounts[5]),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return array_values($this->users);
    }

    /**
     * {@inheritdoc}
     */
    public function findUserOfId(int $id): User
    {
        if (!isset($this->users[$id])) {
            throw new UserNotFoundException();
        }

        return $this->users[$id];
    }

    /**
     * {@inheritdoc}
     */
    public function findUserByUsername(string $username): User
    {
        foreach ($this->users as $user) {
            if ($user->getAccount()->getLogin() === $username) {
                return $user;
            }
        }
        throw new UserNotFoundException();
    }
}
