<?php


namespace App\Controller;


use App\Resolver\UserResolver;
use App\Document\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Serializer;
use App\Common\Serializable\SerializationGroups;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;


/**
 * Class UserController
 * @package App\Controller
 * @Route("/api/users", name="userController")
 */
class UserController extends AbstractController
{
    /**
     * @var UserResolver
     */
    private $userResolver;



    /**
     * UserController constructor.
     */
    public function __construct(UserResolver $userResolver)
    {
        $this->userResolver = $userResolver;
    }


    /**
    * @return Response
    * @Route("/", name="createUser" , methods={"POST"})
    */
   public function createUser(Request $request,ValidatorInterface $validator){
       $user = $this->userResolver->create($request->getContent());
       return  $this->json(["message" =>$user['message']]);
   }

    /**
     * @return JsonResponse
     * @Route("/{id}", name="updatetUser" , methods={"PATCH"})
     */
    public function updateUser(User $user,Request $request,ValidatorInterface $validator):Response{
        $updatedUser = $this->serializer->deserialize($request->getContent(),User::class,'json',[
            AbstractNormalizer::OBJECT_TO_POPULATE => $user
        ]);
        $errors= $validator->validate($updatedUser);
        if (count($errors)) {
            // there are errors, now you can show them
            foreach ($errors as $error) {
                echo $error->getMessage().'<br>';
            }
        }
        $updated = $this->userResolver->update($user,$request->getContent());
        return  $this->json(["message" =>$updated['message']]);
    }

   /**
     * @return Response
     * @Route("/{id}", name="gettUser" , methods={"GET"})
     */
    public function getById(User $user):Response{
        if($user) { return  $this->json($user); }
        else { return  $this->json(["message"=>"Oops something happened"]); }
        }

    /**
     * @return JsonResponse
     * @Route("/{id}", name="deleteUser" , methods={"DELETE"})
     */
    public function deleteUser(User $user):Response {
        $deleted = $this->userResolver->remove($user);
        return $this->json(["message" => $deleted]);
    }

    /**
     * @return Response
     * @Route("/" , name="getUsers" , methods={"GET"})
     */
    public function getUsers():Response {
        $users = $this->userResolver->findAll();
        return $this->json($users);
    }
}