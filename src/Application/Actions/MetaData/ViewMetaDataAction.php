<?php
declare(strict_types=1);

namespace App\Application\Actions\MetaData;

use Psr\Http\Message\ResponseInterface as Response;

class ViewMetaDataAction extends MetaDataAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $metaDataId = (int) $this->resolveArg('id');
        $metaData = $this->metaDataRepository->findMetaDataOfId($metaDataId);

        $this->logger->info("MetaData of id `${metaDataId}` was viewed.");

        return $this->respondWithData($metaData);
    }
}
