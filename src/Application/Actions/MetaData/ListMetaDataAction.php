<?php
declare(strict_types=1);

namespace App\Application\Actions\MetaData;

use App\Domain\MetaData\MetaData;
use Psr\Http\Message\ResponseInterface as Response;

class ListMetaDataAction extends MetaDataAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        // $metadata = $this->metadataRepository->findAll();
        $metadata = MetaData::all();

        $this->logger->info("MetaData list was viewed.");

        return $this->respondWithData($metadata);
    }
}
