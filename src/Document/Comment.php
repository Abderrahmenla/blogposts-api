<?php


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Comment
 * @MongoDB\EmbeddedDocument 
 */
class Comment
{
   /**
     *@MongoDB\ReferenceOne(targetDocument=User::class)
     */
  private $creatorId;

    /** @MongoDB\Field(type="string") */
    private $creatorName;

    /** @MongoDB\Field(type="string") */
    private $content;

    /** @MongoDB\Field(type="string") */
    private $creationDate;

    public function getCreatorId(): ?string { return $this->creatorId; }
    public function setCreatorId(string $creatorId): void { $this->creatorId = $creatorId; }

    public function getCreatorName(): ?string { return $this->creatorName; }
    public function setCreatorName(string $creatorName): void { $this->creatorName = $creatorName; }

    public function getContent(): ?string { return $this->content; }
    public function setContent(string $content): void { $this->content = $content; }
    
    public function getCreationDate(): ?string { return $this->creationDate; }
    public function setCreationDate(string $creationDate): void { $this->creationDate = $creationDate; }

}