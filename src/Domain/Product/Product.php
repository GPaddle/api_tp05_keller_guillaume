<?php

declare(strict_types=1);

namespace App\Domain\Product;

use App\Domain\Category\Category;
use App\Domain\MetaData\MetaData;
use JsonSerializable;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product implements JsonSerializable
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=256)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=2, scale=1)
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="product")     
     * @var Category[] An Array of Categories     
     */
    private $categories;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $icon;

    /**
     * @ORM\OneToMany(targetEntity="MetaData", mappedBy="product")     
     * @var MetaData[] An Array of metaData     
     */
    private $metaData;

    /**
     * @param int       $id
     * @param string    $title
     * @param string    $description
     * @param float     $price
     * @param array     $categories
     * @param string    $icon
     * @param array     $metaData
     */
    public function __construct(
        int  $id,
        string $title,
        string $description,
        float $price,
        array $categories,
        string $icon,
        array $metaData
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->categories = $categories;
        $this->icon = $icon;
        $this->metaData = $metaData;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getProductname(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    private function getCategories(Category $category)
    {
        return $category->getCategoryName();
    }

    private function getMetaData(MetaData $metaData)
    {
        return [
            'name' => $metaData->getMetaDataName(),
            'value' => $metaData->getMetaDataValue()
        ];
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "price" => $this->price,
            "categories" => array_map(array($this, 'getCategories'), $this->categories),
            "icon" => $this->icon,
            "metaData" => array_map(array($this, 'getMetaData'), $this->metaData)
        ];
    }
}
