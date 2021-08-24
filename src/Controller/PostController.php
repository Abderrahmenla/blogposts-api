<?php


namespace App\Controller;


use App\Service\PostService;
use App\Document\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class PostController
 * @package App\Controller
 * @Route("/api/posts" , name="postController")
 */
class PostController extends AbstractController
{
    /**
     * @var postService
     */
    private $postService;



    /**
     * PostController constructor.
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }


    /**
    * @return Response
    * @Route("/", name="createPost" , methods={"POST"})
    */
   public function createPost(Request $request){
       $post = $this->postService->create($request->getContent());
       return  $this->json(["message" =>$post['message']]);

   }

    /**
     * @return Response
     * @Route("/{id}", name="updatePost" , methods={"PUT"})
     */
    public function updatePost(Post $post,Request $request){
         $updated = $this->postService->update($post,$request->getContent());

         return  $this->json(["message" =>$updated['message']]);


    }
            /**
     * @return Response
     * @Route("/{id}", name="gettPost" , methods={"GET"})
     */
    public function getById(Post $post){
        if($post) { return  $this->json($post); }
        else { return  $this->json(["message"=>"Oops something happened"]); }
        }


    /**
     * @return JsonResponse
     * @Route("/{id}", name="deletePost" , methods={"DELETE"})
     */
    public function deletePost(Post $post){

          $deleted = $this->postService->remove($post);
          return $this->json(["message" => $deleted]);
    }

    /**
     * @return Response
     * @Route("/" , name="getPosts" , methods={"GET"})
     */
    public function getPosts() {
        $posts = $this->postService->findAll();
        return $this->json($posts);
    }

           /**
    * @return Response
    * @Route("/{postId}/{commentId}", name="createComment" , methods={"POST"})
    */
    public function deleteComment(Post $post,$commentId){

        $comment = $this->postService->deleteComment($post,$commentId);
        return  $this->json(["message" =>$comment['message']]);
 
    }

}