<?php

namespace App\Domain;

use App\Application\Actions\Action;
use Doctrine\ORM\Mapping as ORM;

/**
 * Products
 *
 * @ORM\Table(name="products")
 * @ORM\Entity
 */
class Products extends DoctrineModel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="products_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=256, nullable=true)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description_", type="string", length=256, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $price;

    /**
     * @var string|null
     *
     * @ORM\Column(name="icon", type="string", length=4, nullable=true)
     */
    private $icon;

    private $categories;
    private $metaData;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string|null $title
     *
     * @return Products
     */
    public function setTitle($title = null)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Products
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price.
     *
     * @param string|null $price
     *
     * @return Products
     */
    public function setPrice($price = null)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return string|null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set icon.
     *
     * @param string|null $icon
     *
     * @return Products
     */
    public function setIcon($icon = null)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon.
     *
     * @return string|null
     */
    public function getIcon()
    {
        return $this->icon;
    }


    /**
     * Set categories.
     *
     * @param Categories|null $categories
     *
     * @return Users
     */
    public function setCategories($categories = [])
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get categories.
     *
     * @return Collection|Categories[]
     */
    public function getCategories()
    {
        if (is_null($this->categories)) {
            $entityManager = Action::createEntityManager();

            $categoriesProduct = $entityManager->getRepository(CategoryProduct::class)->findBy(['product' => $this]);



            $this->categories = array_map([$this, 'getCategoriesFromCatProd'], $categoriesProduct);
        }

        return $this->categories;
    }

    public function getCategoriesFromCatProd(CategoryProduct $catProd)
    {
        return $catProd->getCategory();
    }


    /**
     * Set metaData.
     *
     * @param MetaData|null $metaData
     *
     * @return Users
     */
    public function setMetaData($metaData = [])
    {
        $this->metaData = $metaData;

        return $this;
    }

    /**
     * Get metaData.
     *
     * @return Collection|MetaData[]
     */
    public function getMetaData()
    {

        if (is_null($this->metaData)) {
            $entityManager = Action::createEntityManager();

            $this->metaData = $entityManager->getRepository(Metadata::class)->findBy(['product' => $this]);
        }

        return $this->metaData;
    }

    public function getAsArray(): array
    {
        return [
            'title' => $this->getTitle(),
            'description_' => $this->getDescription(),
            'price' => $this->getPrice(),
            'icon' => $this->getIcon(),
            'id' => $this->getId(),
            'categories' => array_map([$this, 'describe'], $this->getCategories()),
            'metadata' => array_map([$this, 'describe'], $this->getMetadata()),
        ];
    }
}
