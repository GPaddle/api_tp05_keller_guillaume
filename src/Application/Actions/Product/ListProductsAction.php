<?php
declare(strict_types=1);

namespace App\Application\Actions\Product;

//use App\Domain\Category_Product\Category_Product;
//use App\Domain\Product\Product;

use App\Application\Actions\Action;
use App\Domain\Products;
use Psr\Http\Message\ResponseInterface as Response;

class ListProductsAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        // $products = Product::all();
        $products = self::$entityManager->getRepository(Products::class)->findAll();
        $products = array_map([$this, 'describe'], $products);

        $this->logger->info("Products list was viewed.");

        return $this->respondWithData($products);
    }
}
