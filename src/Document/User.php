<?php


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique;

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
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());
    }
}