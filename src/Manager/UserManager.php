<?php


namespace App\Manager;


use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;


class UserManager
{
    /**
     * @var DocumentManager
     */
    private $dm ;

    /**
     * UserManager constructor.
     * @param DocumentManager $dm
     */
    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    /**
     * return User Repository
     */
    public function getUserRepository(){
        return $this->dm->getRepository(User::class);
    }

    /**
     * @return object[]
     *
     */
    public function findAll(){
        return  $this->getUserRepository()->findAll();
    }

    /**
     * @param $user
     * @return array|bool
     */
    public function remove( User $user){
        try{
            $this->dm->remove($user);
            $this->dm->flush();
            return "User deleted successfully ";
        }catch(\Throwable $th){
          return [
              'error' => true ,
              'message' => $th->getMessage()
              ] ;
        }
    }

    /**
     * @param $user
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function create($user){
        try {
            $this->dm->persist($user);
            $this->dm->flush();
            return [
                'error' => true,
                'message' => "User created successfully"
            ];;
        }catch (\Throwable $th)
        {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }

    }

    /**
     * @param $user
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function update($user,$updatedUser){
        try {
            $this->dm->persist($user);
            $this->dm->flush();
            return "User updated successfully";
        }catch (\Throwable $th)
        {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }

    }
    
}