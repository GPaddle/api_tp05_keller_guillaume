<?php

declare(strict_types=1);

namespace App\Application\Actions\Category;

use App\Application\Actions\Action;
use App\Domain\Categories;
//use App\Domain\Category\Category;
use Psr\Http\Message\ResponseInterface as Response;

class ListCategoriesAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        // $categories = Category::all();
        $categories = self::$entityManager->getRepository(Categories::class)->findAll();
        $categories = array_map([$this, 'describe'], $categories);


        $this->logger->info("Categories list was viewed.");

        return $this->respondWithData($categories);
    }
}
