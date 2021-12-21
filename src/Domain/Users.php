<?php

namespace App\Domain;

use App\Application\Actions\Action;
use App\Domain\Contact\Contact;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users extends DoctrineModel
{

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="users_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="firstname", type="string", length=256, nullable=true)
     */
    private $firstname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lastname", type="string", length=256, nullable=true)
     */
    private $lastname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="civility", type="string", length=256, nullable=true)
     */
    private $civility;

    /**
     * @var Addresses[]
     * 
     * @ORM\OneToMany(targetEntity="Addresses", mappedBy="users")
     */
    private $addresses;
    private $contact;
    private $account;

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
     * Set firstname.
     *
     * @param string|null $firstname
     *
     * @return Users
     */
    public function setFirstname($firstname = null)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname.
     *
     * @return string|null
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname.
     *
     * @param string|null $lastname
     *
     * @return Users
     */
    public function setLastname($lastname = null)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname.
     *
     * @return string|null
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set civility.
     *
     * @param string|null $civility
     *
     * @return Users
     */
    public function setCivility($civility = null)
    {
        $this->civility = $civility;

        return $this;
    }

    /**
     * Get civility.
     *
     * @return string|null
     */
    public function getCivility()
    {
        return $this->civility;
    }

    /**
     * Set addresses.
     *
     * @param Addresses|null $addresses
     *
     * @return Users
     */
    public function setAddresses($addresses = [])
    {
        $this->addresses = $addresses;

        return $this;
    }

    /**
     * Get addresses.
     *
     * @return Addresses[]
     */
    public function getAddresses()
    {
        $entityManager = Action::createEntityManager();

        $this->addresses = $entityManager->getRepository(Addresses::class)->findBy(['user' => $this]);

        return $this->addresses;
    }

    /**
     * Set contact.
     *
     * @param Contact|null $contact
     *
     * @return Users
     */
    public function setContact($contact = [])
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact.
     *
     * @return Contacts
     */
    public function getContact()
    {

        if (is_null($this->contact)) {
            $entityManager = Action::createEntityManager();

            $this->contact = $entityManager->getRepository(Contacts::class)->findOneBy(['user' => $this]);
        }

        return $this->contact;
    }

    /**
     * Set account.
     *
     * @param Account|null $account
     *
     * @return Users
     */
    public function setAccount($account = [])
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account.
     *
     * @return Account
     */
    public function getAccount()
    {
        if (is_null($this->account)) {
            $entityManager = Action::createEntityManager();

            $this->account = $entityManager->getRepository(Accounts::class)->findOneBy(['user' => $this]);
        }

        return $this->account;
    }

    public function getAsArray(): array
    {
        return [
            'id' => $this->getId(),
            'firstname' => $this->getFirstname(),
            'lastname' => $this->getLastname(),
            'civility' => $this->getCivility(),
            'addresses' => array_map([$this, 'describe'], $this->getAddresses()),
            'contact' => $this->getContact()->getAsArray(),
            'account' => $this->getAccount()->getAsArray(),
        ];
    }
}
