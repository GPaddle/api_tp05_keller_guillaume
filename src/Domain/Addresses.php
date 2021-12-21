<?php

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * Addresses
 *
 * @ORM\Table(name="addresses", indexes={@ORM\Index(name="IDX_6FCA7516A76ED395", columns={"user_id"})})
 * @ORM\Entity
 */
class Addresses extends DoctrineModel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="addresses_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="street", type="string", length=256, nullable=true)
     */
    private $street;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postal_code", type="string", length=5, nullable=true)
     */
    private $postalCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=256, nullable=true)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country", type="string", length=256, nullable=true)
     */
    private $country;

    /**
     * @var \App\Domain\Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


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
     * Set street.
     *
     * @param string|null $street
     *
     * @return Addresses
     */
    public function setStreet($street = null)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street.
     *
     * @return string|null
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set postalCode.
     *
     * @param string|null $postalCode
     *
     * @return Addresses
     */
    public function setPostalCode($postalCode = null)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode.
     *
     * @return string|null
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set city.
     *
     * @param string|null $city
     *
     * @return Addresses
     */
    public function setCity($city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return string|null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country.
     *
     * @param string|null $country
     *
     * @return Addresses
     */
    public function setCountry($country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country.
     *
     * @return string|null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set user.
     *
     * @param \App\Domain\Users|null $user
     *
     * @return Addresses
     */
    public function setUser(\App\Domain\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \App\Domain\Users|null
     */
    public function getUser()
    {
        return $this->user;
    }

    public function getAsArray(): array
    {
        return [
            'id' => $this->getId(),
            'street' => $this->getStreet(),
            'postal_code' => $this->getPostalCode(),
            'city' => $this->getCity(),
            'country' => $this->getCountry(),
        ];
    }
}
