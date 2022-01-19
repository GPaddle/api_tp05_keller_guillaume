<?php

declare(strict_types=1);

namespace App\Application\Actions\Product;

//use App\Domain\Product\Product;

use App\Application\Actions\Action;
use App\Domain\Products;
use Psr\Http\Message\ResponseInterface as Response;

class ViewProductAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $productId = (int) $this->resolveArg('id');

        if ($productId < 0) {
            return $this->respondWithData("Id $productId is not possible", 422);
        }

        // $product = $this->productRepository->findProductOfId($productId);
        $product = self::$entityManager->getRepository(Products::class)->findOneBy(['id' => $productId]);

        // $product = Product::find($productId);

        $this->logger->info("Product of id `${productId}` was viewed.");

        return $this->respondWithData($product->getAsArray());
    }
}
