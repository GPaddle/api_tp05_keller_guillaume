<?php
declare(strict_types=1);

namespace App\Application\Actions\Product;

use App\Domain\Product\Product;
use Psr\Http\Message\ResponseInterface as Response;

class ViewProductAction extends ProductAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $productId = (int) $this->resolveArg('id');
        // $product = $this->productRepository->findProductOfId($productId);
        $product = Product::find($productId);

        $this->logger->info("Product of id `${productId}` was viewed.");

        return $this->respondWithData($product);
    }
}
