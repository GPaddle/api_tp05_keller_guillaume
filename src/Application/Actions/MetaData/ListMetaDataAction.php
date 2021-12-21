<?php
declare(strict_types=1);

namespace App\Application\Actions\MetaData;

//use App\Domain\MetaData\MetaData;

use App\Application\Actions\Action;
use App\Domain\Metadata;
use Psr\Http\Message\ResponseInterface as Response;

class ListMetaDataAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        // $metadata = MetaData::all();
        $metadata = self::$entityManager->getRepository(Metadata::class)->findAll();
        $metadata = array_map([$this, 'describe'], $metadata);

        $this->logger->info("MetaData list was viewed.");

        return $this->respondWithData($metadata);
    }
}
