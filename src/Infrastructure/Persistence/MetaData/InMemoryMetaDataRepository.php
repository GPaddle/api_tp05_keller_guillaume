<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\MetaData;

use App\Domain\MetaData\MetaData;
use App\Domain\MetaData\MetaDataNotFoundException;
use App\Domain\MetaData\MetaDataRepository;

class InMemoryMetaDataRepository implements MetaDataRepository
{
	/**
	 * @var MetaData[]
	 */
	private $categories;

	/**
	 * InMemoryMetaDataRepository constructor.
	 *
	 * @param array|null $categories
	 */
	public function __construct(array $categories = null)
	{
		$this->categories = $categories ?? [

			0 => new MetaData(0, "Acidité", "+"),
			1 => new MetaData(1, "Sucre", "++"),
			2 => new MetaData(2, "Tarte", "++"),
			3 => new MetaData(3, "Energie", "++"),
			4 => new MetaData(4, "Eau", "++"),
			5 => new MetaData(5, "Sucre", "+"),
			6 => new MetaData(6, "Sucre", "++"),
			7 => new MetaData(7, "Acidité", "+"),
			8 => new MetaData(8, "Sucre", "++"),
			9 => new MetaData(9, "Acidité", "++"),
			10 => new MetaData(0, "Acidité", "+"),
			11 => new MetaData(1, "Acidité", "+"),
			12 => new MetaData(2, "Précaution d'emplois", "Ne pas manger l'écorce"),
			13 => new MetaData(3, "Fun fact", "Ne vous aidera pas à échapper au tribunal"),
			14 => new MetaData(4, "Fun fact", "Les enfants n'aiment pas ça"),
			15 => new MetaData(5, "Fun fact", "N'est pas un film"),
			16 => new MetaData(6, "Fun fact", "Peut se transformer en popcorn magique"),
			17 => new MetaData(7, "Fun fact", "Vous donnera une haleine à repousser un monstre"),
			18 => new MetaData(8, "Fun fact", "Selon la légende, elle rend aimable"),
			19 => new MetaData(9, "Fun fact", "Vous fera pleurer si vous osez lui faire du mal"),


		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function findAll(): array
	{
		return array_values($this->categories);
	}

	/**
	 * {@inheritdoc}
	 */
	public function findMetaDataOfId(int $id): MetaData
	{
		if (!isset($this->categories[$id])) {
			throw new MetaDataNotFoundException();
		}

		return $this->categories[$id];
	}
}
