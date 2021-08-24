<?php


namespace App\Document;

use DateTime;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @MongoDB\Document(repositoryClass=PostRepository::class)
 */

class Post 
{
      /**
     * @MongoDB\Id
     */
    protected string $id;

    /**
     *@MongoDB\ReferenceOne(targetDocument=User::class)
     */
    private $user;

    /**
     * @MongoDB\Field(type="string")
     */
    protected string $content;

    /**
     * @MongoDB\Field(type="string")
     */
    protected string $title;

    /**
     * @MongoDB\Field(type="date")
     */
    protected DateTime $creationDate;

    /**
     * @MongoDB\EmbedMany(targetDocument=Comment::class)
     */
    
    protected $comments;

    /**
     * Post Constructor
     */

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId() { return $this->id; }

    public function getUser(): ?string { return $this->user; }
    public function setUser(string $user): void { $this->user = $user; }

    /**
     * @return string
     */
    public function getEmail() : string { return $this->email; }

    /**
     * @param string $email
     */
    public function setEmail(string $email) : void { $this->email = $email; }

    /**
     * @return string
     */
    public function getContent() : string { return $this->content; }

    /**
     * @param string $content
     */
    public function setContent(string $content): void { $this->content = $content; }

    /**
     * @return string
     */
    public function getTitle(): string { return $this->title; }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void { $this->title = $title; }

    /**
     * @return DateTime
     */
    public function getCreationDate() : \DateTime { return $this->creationDate; }

    public function setCreationDate(): void { $this->creationDate = new DateTime('now'); }

    public function getComments(): ArrayCollection { return $this->comments; }
    public function addComment(Comment $comment): void { $this->comments[] = $comment; }
}

/** @MongoDB\EmbeddedDocument */
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