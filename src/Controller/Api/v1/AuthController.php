<?php

/*
* Código a partir de ejemplo de
* https://h-benkachoud.medium.com/
* TODO - Mejorar implementacion mediante FOSUserBundle
*/

namespace App\Controller\Api\v1;

 use App\Entity\User;
 use Doctrine\Persistence\ManagerRegistry;
 use FOS\RestBundle\Controller\Annotations as Rest;
 use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
 use Symfony\Component\HttpFoundation\JsonResponse;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
 use Symfony\Component\Security\Core\User\UserInterface;

 class AuthController extends ApiController
 {
     /**
      * Register user.
      *
      *@Rest\Post("/register")
      *
      *@return Response
      */
     public function register(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher)
     {
         $em = $doctrine->getManager();
         $request = $this->transformJsonBody($request);
         $password = $request->get('password');
         $email = $request->get('email');

         if (empty($password) || empty($email)) {
             return $this->respondValidationError('Invalid Username or Password or Email');
         }

         $user = new User($email);
         $user->setPassword($passwordHasher->hashPassword($user, $password));
         $user->setEmail($email);
         $em->persist($user);
         $em->flush();

         return $this->respondWithSuccess(sprintf('User %s successfully created', $user->getUserIdentifier()));
     }

     /**
      * @return JsonResponse
      */
     public function getTokenUser(UserInterface $user, JWTTokenManagerInterface $JWTManager)
     {
         return new JsonResponse(['token' => $JWTManager->create($user)]);
     }
 }
