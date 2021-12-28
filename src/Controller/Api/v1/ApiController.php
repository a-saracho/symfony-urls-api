<?php

/*
* Código a partir de ejemplo
* https://h-benkachoud.medium.com/
*/

namespace App\Controller\Api\v1;

 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\JsonResponse;

 class ApiController extends AbstractController
 {
     /**
      * @var int HTTP status code - 200 (OK) by default
      */
     protected $statusCode = 200;

     /**
      * Gets the value of statusCode.
      *
      * @return int
      */
     public function getStatusCode()
     {
         return $this->statusCode;
     }

     /**
      * Returns a JSON response.
      *
      * @param array $data
      * @param array $headers
      *
      * @return JsonResponse
      */
     public function response($data, $headers = [])
     {
         return new JsonResponse($data, $this->getStatusCode(), $headers);
     }

     /**
      * Sets an error message and returns a JSON response.
      *
      * @param string $errors
      * @param $headers
      *
      * @return JsonResponse
      */
     public function respondWithErrors($errors, $headers = [])
     {
         $data = [
             'status' => $this->getStatusCode(),
             'errors' => $errors,
         ];

         return new JsonResponse($data, $this->getStatusCode(), $headers);
     }

     /**
      * Sets an error message and returns a JSON response.
      *
      * @param string $success
      * @param $headers
      *
      * @return JsonResponse
      */
     public function respondWithSuccess($success, $headers = [])
     {
         $data = [
             'status' => $this->getStatusCode(),
             'success' => $success,
         ];

         return new JsonResponse($data, $this->getStatusCode(), $headers);
     }

     /**
      * Returns a 401 Unauthorized http response.
      *
      * @param string $message
      *
      * @return JsonResponse
      */
     public function respondUnauthorized($message = 'Not authorized!')
     {
         return $this->setStatusCode(401)->respondWithErrors($message);
     }

     /**
      * Returns a 422 Unprocessable Entity.
      *
      * @param string $message
      *
      * @return JsonResponse
      */
     public function respondValidationError($message = 'Validation errors')
     {
         return $this->setStatusCode(422)->respondWithErrors($message);
     }

     /**
      * Returns a 404 Not Found.
      *
      * @param string $message
      *
      * @return JsonResponse
      */
     public function respondNotFound($message = 'Not found!')
     {
         return $this->setStatusCode(404)->respondWithErrors($message);
     }

     /**
      * Returns a 201 Created.
      *
      * @param array $data
      *
      * @return JsonResponse
      */
     public function respondCreated($data = [])
     {
         return $this->setStatusCode(201)->response($data);
     }

     /**
      * Sets the value of statusCode.
      *
      * @param int $statusCode the status code
      *
      * @return self
      */
     protected function setStatusCode($statusCode)
     {
         $this->statusCode = $statusCode;

         return $this;
     }

     // this method allows us to accept JSON payloads in POST requests
     // since Symfony 4 doesn’t handle that automatically:

     protected function transformJsonBody(\Symfony\Component\HttpFoundation\Request $request)
     {
         $data = json_decode($request->getContent(), true);

         if (null === $data) {
             return $request;
         }

         $request->request->replace($data);

         return $request;
     }
 }
