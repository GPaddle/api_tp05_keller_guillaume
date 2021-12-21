<?php

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoryProduct
 *
 * @ORM\Table(name="category_product", indexes={@ORM\Index(name="IDX_149244D34584665A", columns={"product_id"}), @ORM\Index(name="IDX_149244D312469DE2", columns={"category_id"})})
 * @ORM\Entity
 */
class CategoryProduct extends DoctrineModel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="category_product_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \App\Domain\Products
     *
     * @ORM\ManyToOne(targetEntity="Products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @var \App\Domain\Categories
     *
     * @ORM\ManyToOne(targetEntity="Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;


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
     * Set product.
     *
     * @param \App\Domain\Products|null $product
     *
     * @return CategoryProduct
     */
    public function setProduct(\App\Domain\Products $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product.
     *
     * @return \App\Domain\Products|null
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set category.
     *
     * @param \App\Domain\Categories|null $category
     *
     * @return CategoryProduct
     */
    public function setCategory(\App\Domain\Categories $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return \App\Domain\Categories|null
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function getAsArray(): array
    {
        return [
            'id' => $this->getId(),
            'category' => $this->getCategory(),
            'product' => $this->getProduct(),
        ];
    }
}