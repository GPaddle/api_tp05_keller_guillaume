<?php
declare(strict_types=1);

namespace App\Application\Actions\MetaData;

use App\Application\Actions\Action;
use App\Domain\Metadata;
use Psr\Http\Message\ResponseInterface as Response;

class ViewMetaDataAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $metaDataId = (int) $this->resolveArg('id');
        // $metaData = $this->metaDataRepository->findMetaDataOfId($metaDataId);
        // $metaData = MetaData::find($metaDataId);
        $metaData = self::$entityManager->getRepository(Metadata::class)->findOneBy(['id' => $metaDataId]);


        $this->logger->info("MetaData of id `${metaDataId}` was viewed.");

        return $this->respondWithData($metaData->getAsArray());
    }
}
