<?php
declare(strict_types=1);

namespace App\Application\Actions\MetaData;

use App\Application\Actions\Action;
use App\Domain\MetaData\MetaDataRepository;
use Psr\Log\LoggerInterface;

abstract class MetaDataAction extends Action
{
    /**
     * @var MetaDataRepository
     */
    protected $metaDataRepository;

    /**
     * @param LoggerInterface $logger
     * @param MetaDataRepository $metaDataRepository
     */
    public function __construct(LoggerInterface $logger,
                                MetaDataRepository $metaDataRepository
    ) {
        parent::__construct($logger);
        $this->metaDataRepository = $metaDataRepository;
    }
}
