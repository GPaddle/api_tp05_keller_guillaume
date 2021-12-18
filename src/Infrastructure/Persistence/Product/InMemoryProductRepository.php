<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Product;

use App\Domain\Category\Category;
use App\Domain\MetaData\MetaData;
use App\Domain\Product\Product;
use App\Domain\Product\ProductNotFoundException;
use App\Domain\Product\ProductRepository;
use App\Infrastructure\Persistence\Category\InMemoryCategoryRepository;
use App\Infrastructure\Persistence\MetaData\InMemoryMetaDataRepository;

class InMemoryProductRepository implements ProductRepository
{
	/**
	 * @var Product[]
	 */
	private $products;

	/**
	 * InMemoryProductRepository constructor.
	 *
	 * @param array|null $products
	 */
	public function __construct(array $products = null)
	{
		$metaData = (new InMemoryMetaDataRepository())->findAll();
		$categories = (new InMemoryCategoryRepository())->findAll();

		$this->products = $products ?? [
			0 => new Product([0, "Orange",				"🍊 Comme une célèbre marque de télécom", 0.58, [$categories["Fruit"], $categories["Agrume"]], "🍊", [$metaData[0], $metaData[1]]]),
			1 => new Product([1, "Pomme", 				"🍎 Sympa, disponible toute l'année", 0.18, [$categories["Fruit"], $categories["Local"]], "🍎", [$metaData[2]]]),
			2 => new Product([2, "Banane", 				"🍌 Pas mal pour avoir la forme avant une course.", 0.43, [$categories["Fruit"], $categories["Tropical"]], "🍌", [$metaData[3]]]),
			3 => new Product([3, "Pastèque", 			"🍉 Top pour l'été, rafraichissant.", 1.00, [$categories["Fruit"], $categories["Tropical"]], "🍉", [$metaData[4], $metaData[5]]]),
			4 => new Product([4, "Ananas", 				"🍍 Très bon en tranche.", 2.99, [$categories["Fruit"], $categories["Tropical"]], "🍍", [$metaData[6], $metaData[7]]]),
			5 => new Product([5, "Fraise", 				"🍓 Sucré, summer vibes, c'est top !", 0.05, [$categories["Fruit"], $categories["Estival"]], "🍓", [$metaData[8]]]),
			6 => new Product([6, "Citron", 				"🍋 Ca pique un peu les papilles.", 0.30, [$categories["Fruit"], $categories["Agrume"]], "🍋", [$metaData[9]]]),
			7 => new Product([7, "Pêche", 				"🍑 Bon été", 1.40, [$categories["Fruit"], $categories["Local"]], "🍑", []]),
			8 => new Product([8, "Raisin", 				"🍇 Aussi pour bon le vin que pour la table", 2.98, [$categories["Fruit"], $categories["Local"]], "🍇", []]),
			9 => new Product([9, "Cerise", 				"🍒 De belles boucles d'oreilles qui se mange", 0.12, [$categories["Fruit"], $categories["Local"]], "🍒", []]),
			10 => new Product([10, "Kiwi", 				"🥝 Avec le kiwi, une bonne dose de vitamine C tous les matins", 1.30, [$categories["Fruit"], $categories["Exotique"]], "🥝", [$metaData[10]]]),
			11 => new Product([11, "Cornichon", 		"🥒 Le petit frère du concombre", 0.99, [$categories["Légume"], $categories["Local"]], "🥒", [$metaData[11]]]),
			12 => new Product([12, "Poire", 			"🍐 Juteuses et très colorées", 1.20, [$categories["Fruit"], $categories["Locaux"]], "🍐", []]),
			13 => new Product([13, "Mangue ", 			"🥭", 2.00, [$categories["Fruit"], $categories["Exotique"]], "🥭", []]),
			14 => new Product([14, "Noix de coco",		"🥥", 3.50, [$categories["Fruit"], $categories["Exotique"]], "🥥", [$metaData[12]]]),
			15 => new Product([15, "Aubergine", 		"🍆", 2.30, [$categories["Légume"], $categories["Local"]], "🍆", []]),
			16 => new Product([16, "Avocat", 			"🥑", 1.80, [$categories["Légume"], $categories["Exotique"]], "🥑", [$metaData[13]]]),
			17 => new Product([17, "Brocolis", 			"🥦", 1.70, [$categories["Légume"], $categories["Local"]], "🥦", [$metaData[14]]]),
			18 => new Product([18, "Navet", 			"🥬", 3.40, [$categories["Légume"], $categories["Local"]], "🥬", [$metaData[15]]]),
			19 => new Product([19, "Maïs", 				"🌽", 1.90, [$categories["Légume"], $categories["Local"]], "🌽", [$metaData[16]]]),
			20 => new Product([20, "Piment", 			"🌶 Sensations fortes culinaires garanties", 0.98, [$categories["Légume"], $categories["Exotique"]], "🌶", []]),
			21 => new Product([21, "Pomme de terre",	"🥔 Un féculent d'excellente qualité, peu cher, l'idéal pour vos Baeckeoffe", 0.12, [$categories["Légume"], $categories["Local"]], "🥔", []]),
			22 => new Product([22, "Ail", 				"🧄", 0.70, [$categories["Légume"], $categories["Local"]], "🧄", [$metaData[17]]]),
			23 => new Product([23, "Carotte", 			"🥕", 0.90, [$categories["Légume"], $categories["Local"]], "🥕", [$metaData[18]]]),
			24 => new Product([24, "Oignons", 			"🧅", 0.80, [$categories["Légume"], $categories["Local"]], "🧅", [$metaData[19]]])
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function findAll(): array
	{
		return array_values($this->products);
	}

	/**
	 * {@inheritdoc}
	 */
	public function findProductOfId(int $id): Product
	{
		if (!isset($this->products[$id])) {
			throw new ProductNotFoundException();
		}

		return $this->products[$id];
	}
}
