<?php


namespace App\Controller;


use App\Service\UserService;
use App\Document\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class UserController
 * @package App\Controller
 * @Route("/api/users", name="userController")
 */
class UserController extends AbstractController
{
    /**
     * @var UserService
     */
    private $userService;



    /**
     * UserController constructor.
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
    * @return Response
    * @Route("/", name="createUser" , methods={"POST"})
    */
   public function createUser(Request $request){
       $user = $this->userService->create($request->getContent());
       return  $this->json(["message" =>$user['message']]);

   }

    /**
     * @return JsonResponse
     * @Route("/{id}", name="updatetUser" , methods={"PUT"})
     */
    public function updateUser(User $user,Request $request){
         $updated = $this->userService->update($user,$request->getContent());

        return  $this->json(["message" =>$updated['message']]);
         
    }

   /**
     * @return Response
     * @Route("/{id}", name="gettUser" , methods={"GET"})
     */
    public function getById(User $user){
        if($user) { return  $this->json($user); }
        else { return  $this->json(["message"=>"Oops something happened"]); }
        }

    /**
     * @return JsonResponse
     * @Route("/{id}", name="deleteUser" , methods={"DELETE"})
     */
    public function deleteUser(User $user){
        $deleted = $this->userService->remove($user);
        return $this->json(["message" => $deleted]);
    }

    /**
     * @return Response
     * @Route("/" , name="getUsers" , methods={"GET"})
     */
    public function getUsers() {
        $users = $this->userService->findAll();
        return $this->json($users);
    }


}