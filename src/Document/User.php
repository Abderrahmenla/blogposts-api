<?php


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use App\Repository\UserRepository;

/**
 * @MongoDB\Document(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @MongoDB\Id
     */
    protected string $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected string $name;

    /**
     * @MongoDB\Field(type="string")
     */
    protected string $email;

        /**
     * @MongoDB\Field(type="string")
     */
    protected string $password;

    /**
     * @MongoDB\EmbedOne(targetDocument=Contact::class)
     */
    
    protected $contact;
    
    /**
     * @return string
     */
    public function getId() { return $this->id; }

    /**
     * @return string
     */
    public function getEmail() : string { return $this->email; }

    /**
     * @param string
     */
    public function setEmail(string $email) : void { $this->email = $email; }

    public function getContact(): ?Contact { return $this->contact; }
    public function setContact(Contact $contact): void { $this->contact = $contact; }

    /**
     * @return string
     */
    public function getPassword() : string { return $this->password; }

    public function setPassword(string $password): void { $this->password = $password; }

    /**
     * @return string
     */
    public function getName(): string { return $this->name; }

    /**
     * @param string
     */
    public function setName(string $name): void { $this->name = $name; }
}

/** @MongoDB\EmbeddedDocument */
class Contact
{
    /** @MongoDB\Field(type="string") */
    private $address;

    /** @MongoDB\Field(type="string") */
    private $city;

    /** @MongoDB\Field(type="string") */
    private $country;

    /** @MongoDB\Field(type="string") */
    private $zipCode;

    public function getAddress(): ?string { return $this->address; }
    public function setAddress(string $address): void { $this->address = $address; }

    public function getCity(): ?string { return $this->city; }
    public function setCity(string $city): void { $this->city = $city; }

    public function getCountry(): ?string { return $this->country; }
    public function setCountry(string $country): void { $this->country = $country; }

    public function getZipCode(): ?string { return $this->zipCode; }
    public function setZipCode(string $zipCode): void { $this->zipCode = $zipCode; }
}