<?php
declare(strict_types=1);

namespace App\Domain\MetaData;

interface MetaDataRepository
{
    /**
     * @return MetaData[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return MetaData
     * @throws MetaDataNotFoundException
     */
    public function findMetaDataOfId(int $id): MetaData;
}
