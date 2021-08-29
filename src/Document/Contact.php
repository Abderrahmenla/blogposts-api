<?php


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Contact 
 * @MongoDB\EmbeddedDocument 
 */
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