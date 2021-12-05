<?php

declare(strict_types=1);

namespace App\Domain\Address;

interface AddressRepository
{
    /**
     * @return Address[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Address
     * @throws AddressNotFoundException
     */
    public function findAddressOfId(int $id): Address;
}
