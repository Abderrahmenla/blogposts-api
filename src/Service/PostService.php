<?php


namespace App\Service;




use App\Document\Post;
use App\Document\Comment;
use App\Manager\PostManager;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PostService
{
  /**
   * @var PostManager $postManager
   */

   private $postManager;

   /**
    * @var Serializer $serializer
    */
  private $serializer;

    /**
     * PostService constructor.
     * @param PostManager
     */
    public function __construct(PostManager $postManager)
    {
      $this->postManager = $postManager;
      $encoders = [new XmlEncoder(), new JsonEncoder()];
      $normalizers = [new ObjectNormalizer()];
      $this->serializer = new Serializer($normalizers, $encoders);
    }

    /**
     * @param string
     * @return string
     */
    public function create($data){
      $post = $this->serializer->deserialize($data , Post::class , 'json');
      $created = $this->postManager->create($post);

      return $created;
   }

    /**
     * @param Post
     * @return string
     */
    public function update($post,$updatedPost){
      $updated = $this->postManager->update($post,$updatedPost);
      return $updated;
   }
    /**
     * @return object[]
     */
    public function findAll(){
      return $this->postManager->findAll();
  }

    /**
     * @param Post
     * @return string
     */
    public function remove($post){
      $deleted = $this->postManager->remove($post);
      return $deleted;
  }
    
      /**
     * @param Post
     * @return string
     */
    public function createComment($post,$data){
      $comment = $this->serializer->deserialize($data , Comment::class , 'json');
      $createdComment = $this->postManager->createComment($post,$comment);

      return $createdComment;
   }
       /**
     * @param Post
     * @return string
     */
    public function deleteComment($post,$commentId){
      $deleted = $this->postManager->deleteComment($post,$commentId);
      return $deleted;
   }
}