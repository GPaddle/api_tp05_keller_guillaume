<?php

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * Metadata
 *
 * @ORM\Table(name="metadata", indexes={@ORM\Index(name="IDX_4F1434144584665A", columns={"product_id"})})
 * @ORM\Entity
 */
class Metadata extends DoctrineModel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="metadata_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name_", type="string", length=256, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="value_", type="string", length=256, nullable=true)
     */
    private $value;

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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Metadata
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value.
     *
     * @param string|null $value
     *
     * @return Metadata
     */
    public function setValue($value = null)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value.
     *
     * @return string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set product.
     *
     * @param \App\Domain\Products|null $product
     *
     * @return Metadata
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

    public function getAsArray(): array
    {
        return [
            // 'id' => $this->GetId(),
            'name_' => $this->GetName(),
            'value_' => $this->GetValue(),
            // 'product' => $this->GetProduct(),
        ];
    }

}