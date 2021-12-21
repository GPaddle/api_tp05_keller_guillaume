<?php

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * Accounts
 *
 * @ORM\Table(name="accounts", indexes={@ORM\Index(name="IDX_CAC89EACA76ED395", columns={"user_id"})})
 * @ORM\Entity
 */
class Accounts extends DoctrineModel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="accounts_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="login_", type="string", length=20, nullable=true)
     */
    private $login;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hashedpassword", type="string", length=256, nullable=true)
     */
    private $hashedpassword;

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
     * Set login.
     *
     * @param string|null $login
     *
     * @return Accounts
     */
    public function setLogin($login = null)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login.
     *
     * @return string|null
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set hashedpassword.
     *
     * @param string|null $password
     *
     * @return Accounts
     */
    public function setHashedpassword($password = null)
    {
        $this->hashedpassword = password_hash($password, PASSWORD_DEFAULT);

        return $this;
    }

    /**
     * Get hashedpassword.
     *
     * @return string|null
     */
    public function getHashedpassword()
    {
        return $this->hashedpassword;
    }

    /**
     * Set user.
     *
     * @param \App\Domain\Users|null $user
     *
     * @return Accounts
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
            'login_' => $this->getLogin(),
            'hashedpassword' => $this->getHashedpassword(),
        ];
    }
}
