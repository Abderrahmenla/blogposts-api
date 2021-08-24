<?php


namespace App\Manager;


use App\Document\Post;
use Doctrine\ODM\MongoDB\DocumentManager;


class PostManager
{
    /**
     * @var DocumentManager
     */
    private $dm ;

    /**
     * PostManager constructor.
     * @param DocumentManager $dm
     */
    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    /**
     * return Post Repository
     */
    public function getPostRepository(){
        return $this->dm->getRepository(Post::class);
    }

    /**
     * @return object[]
     *
     */
    public function findAll(){
        return  $this->getPostRepository()->findAll();
    }

    /**
     * @param $post
     * @return array|bool
     */
    public function remove( Post $post){
        try{
            $this->dm->remove($post);
            $this->dm->flush();
            return "Post deleted successfully";
        }catch(\Throwable $th) { return  $th->getMessage(); }
    }

    /**
     * @param $post
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function create($post){
        try {
            $this->dm->persist($post);
            $this->dm->flush();
            return "Post created successfully";
        }catch (\Throwable $th) { return  $th->getMessage(); }

    }

    /**
     * @param Post
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function update($post,$updatedPost){
        try {
            $this->dm->persist($post);
            $this->dm->flush();
            return "Post updated successfully";
        }catch (\Throwable $th) { return $th->getMessage(); }
    }

    /**
     * @param $post
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function createComment($post,$comment){
        try {
            $post->setComment($comment);
            $this->dm->persist($post);
            $this->dm->flush();
            return "Comment created successfully";
        }
        catch (\Throwable $th) { return  $th->getMessage(); }
    }
    public function deleteComment( Post $post,$commentId){
        try{
            $this->dm->persist($post);
            $this->dm->flush();
            return "Post deleted successfully";
        }catch(\Throwable $th) { return  $th->getMessage(); }
    }
}