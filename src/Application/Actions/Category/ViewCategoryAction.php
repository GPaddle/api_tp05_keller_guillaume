<?php

declare(strict_types=1);

namespace App\Application\Actions\Category;

use App\Domain\Category\Category;
use Psr\Http\Message\ResponseInterface as Response;

class ViewCategoryAction extends CategoryAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $categoryId = (int) $this->resolveArg('id');
        // $category = $this->categoryRepository->findCategoryOfId($categoryId);
        $category = Category::find($categoryId);

        $this->logger->info("Category of id `${categoryId}` was viewed.");

        return $this->respondWithData($category);
    }
}
