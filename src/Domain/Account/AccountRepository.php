<?php

declare(strict_types=1);

namespace App\Domain\Account;

interface AccountRepository
{
    /**
     * @return Account[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Account
     * @throws AccountNotFoundException
     */
    public function findAccountOfId(int $id): Account;
}
