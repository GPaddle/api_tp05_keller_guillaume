<?php

declare(strict_types=1);

namespace App\Application\Actions\Category;

use App\Application\Actions\Action;
use App\Domain\Category\Category;
use Psr\Http\Message\ResponseInterface as Response;

class ListCategoriesAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        // $categories = $this->categoryRepository->findAll();
        $categories = Category::all();

        $this->logger->info("Categories list was viewed.");

        return $this->respondWithData($categories);
    }
}
