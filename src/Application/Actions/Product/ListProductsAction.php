<?php
declare(strict_types=1);

namespace App\Application\Actions\Product;

use App\Domain\Category_Product\Category_Product;
use App\Domain\Product\Product;
use Psr\Http\Message\ResponseInterface as Response;

class ListProductsAction extends ProductAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        // $products = $this->productRepository->findAll();
        $products = Product::all();

        $this->logger->info("Products list was viewed.");

        return $this->respondWithData($products);
    }
}
