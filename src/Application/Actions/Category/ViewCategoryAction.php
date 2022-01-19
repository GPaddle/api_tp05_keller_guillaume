<?php

declare(strict_types=1);

namespace App\Application\Actions\Category;

//use App\Domain\Category\Category;

use App\Application\Actions\Action;
use App\Domain\Categories;
use Psr\Http\Message\ResponseInterface as Response;

class ViewCategoryAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $categoryId = (int) $this->resolveArg('id');

        if ($categoryId < 0) {
            return $this->respondWithData("Id $categoryId is not possible", 422);
        }

        // $category = $this->categoryRepository->findCategoryOfId($categoryId);
        // $category = Category::find($categoryId);
        $category = self::$entityManager->getRepository(Categories::class)->findOneBy(['id' => $categoryId]);


        $this->logger->info("Category of id `${categoryId}` was viewed.");

        return $this->respondWithData($category->getAsArray());
    }
}
