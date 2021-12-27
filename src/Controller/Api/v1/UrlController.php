<?php

namespace App\Controller\Api\v1;

use App\Entity\Url;
use App\Service\ShortUrlService;
use Doctrine\Persistence\ManagerRegistry;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UrlController extends AbstractFOSRestController
{
    /**
     * Lists all Urls.
     *
     *@Rest\Get("/urls")
     *
     *@return Response
     */
    public function getUrlsAction(ManagerRegistry $doctrine, SerializerInterface $serializer)
    {
        $repository = $doctrine->getRepository(Url::class);
        $urls = $repository->findAll();

        //TODO - Añadir filtros (ver docu Doctrine y ElasticSearch)
        return new Response($serializer->serialize($urls, 'json'));
    }

    /**
     * Create Url.
     *
     *@Rest\Post("/urls")
     *
     *@return Response
     */
    public function postUrlsAction(ManagerRegistry $doctrine, ShortUrlService $shortUrlService, Request $request)
    {
        $entityManager = $doctrine->getManager();

        $url = new Url();

        //TODO - Validar request (formato y existencia del parámetro originalUrl)
        $url->setOriginalUrl($request->get('originalUrl'));
        //TODO - Comprobar que no exista ya la url en la BBDD, si existe buscarla y devolver shortUrl
        $shortUrl = $shortUrlService->shorten_url();
        $url->setShortUrl($shortUrl);

        $entityManager->persist($url);
        $entityManager->flush();

        //TODO - Devolver error si la inserción falla (añadir manejo de excepciones con try/catch)
        return new JsonResponse(['status' => 'ok', 'id' => $url->getId()]);
    }
}
