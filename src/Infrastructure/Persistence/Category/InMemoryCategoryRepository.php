<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Category;

use App\Domain\Category\Category;
use App\Domain\Category\CategoryNotFoundException;
use App\Domain\Category\CategoryRepository;

class InMemoryCategoryRepository implements CategoryRepository
{
	/**
	 * @var Category[]
	 */
	private $categories;

	/**
	 * InMemoryCategoryRepository constructor.
	 *
	 * @param array|null $categories
	 */
	public function __construct(array $categories = null)
	{
		$this->categories = $categories ?? [
			"Fruit" => new Category([0, 'Fruit']),
			"Agrume" => new Category([1, 'Agrume']),
			"Local" => new Category([2, 'Local']),
			"Tropical" => new Category([3, 'Tropical']),
			"Estival" => new Category([4, 'Estival']),
			"Exotique" => new Category([5, 'Exotique']),
			"Locaux" => new Category([6, 'Locaux']),
			"Légume" => new Category([7, 'Légume']),
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function findAll(): array
	{
		return $this->categories;
	}

	/**
	 * {@inheritdoc}
	 */
	public function findCategoryOfId(int $id): Category
	{
		foreach ($this->categories as $name => $category) {
			if ($category->getId() === $id) {
				return $category;
			}
		}
		throw new CategoryNotFoundException();
	}

	/**
	 * {@inheritdoc}
	 */
	public function findCategoryByNAme(string $name): Category
	{
		if (!isset($this->categories[$name])) {
			throw new CategoryNotFoundException();
		}

		return $this->categories[$name];
	}
}
