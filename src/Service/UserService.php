<?php
namespace App\Service;

use App\Document\User;
use App\Document\Contact;
use App\Manager\UserManager;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Psr\Log\LoggerInterface;

class UserService
{
  /**
   * @var UserManager
   */

   private $userManager;

   private $logger;

   /**
    * @var Serializer
    */
  private $serializer;

    /**
     * UserService constructor.
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager,LoggerInterface $logger)
    {
      $this->userManager = $userManager;
      $encoders = [new XmlEncoder(), new JsonEncoder()];
      $normalizers = [new ObjectNormalizer()];
      $this->serializer = new Serializer($normalizers, $encoders);
      $this->logger = $logger;
    }

    /**
     * @param string
     * @return string
     */
    public function create($data){
      $user = $this->serializer->deserialize($data , User::class , 'json');
      $this->logger->info(gettype($user));
      $updated = $this->userManager->create($user);
      
      return $updated;
   }

    /**
     * @param User
     * @return string
     */
    public function update($user,$updatedUser){
      $created = $this->userManager->update($user,$updatedUser);
      return $created;
   }
    /**
     * @return object[]
     */
    public function findAll(){
      return $this->userManager->findAll();
  }

    /**
     * @param User
     * @return string
     */
    public function remove($user){
      $deleted = $this->userManager->remove($user);
      return $deleted;
  }

    
}