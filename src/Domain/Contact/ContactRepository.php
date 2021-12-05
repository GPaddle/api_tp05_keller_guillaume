<?php

declare(strict_types=1);

namespace App\Domain\Contact;

interface ContactRepository
{
    /**
     * @return Contact[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Contact
     * @throws ContactNotFoundException
     */
    public function findContactOfId(int $id): Contact;
}
