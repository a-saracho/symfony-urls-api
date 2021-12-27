<?php

namespace App\Controller\Api\v1;

use App\Entity\Url;
use Doctrine\Persistence\ManagerRegistry;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShortUrlController extends AbstractFOSRestController
{
    /**
     * Retrieve original Url.
     *
     *@Rest\Get("/short-url/{shortUrl}")
     *
     *@return Response
     */
    public function getShortUrlAction(string $shortUrl, ManagerRegistry $doctrine, )
    {
        $url = $doctrine->getRepository(Url::class)->findOneBy(['shortUrl' => $shortUrl]);

        if (!$url) {
            throw $this->createNotFoundException(
                'No url found for shortUrl '.$shortUrl
            );
        }
        //TODO - Mejorar manejo de excepciones con try/catch
        return new JsonResponse(['status' => 'ok', 'originalUrl' => $url->getOriginalUrl()]);
    }
}
