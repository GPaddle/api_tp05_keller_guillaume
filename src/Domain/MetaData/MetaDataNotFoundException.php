<?php
declare(strict_types=1);

namespace App\Domain\MetaData;

use App\Domain\DomainException\DomainRecordNotFoundException;

class MetaDataNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The metaData you requested does not exist.';
}
