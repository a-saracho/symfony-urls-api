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
    //TODO - Llevar esto a ShortUrlService para quitar peso del controlador al servicio
    private $em;
    private $ser;

    public function __construct(ManagerRegistry $doctrine, SerializerInterface $serializer)
    {
        $this->em = $doctrine->getManager();
        $this->serializer = $serializer;
    }

    /**
     * Lists all Urls.
     *
     *@Rest\Get("/urls")
     *
     *@return Response
     */
    public function getUrlsAction()
    {
        $repository = $this->em->getRepository(Url::class);
        $urls = $repository->findAll();

        //TODO - Añadir filtros (ver docu Doctrine y ElasticSearch)
        return new Response($this->serializer->serialize($urls, 'json'));
    }

    /**
     * Create Url.
     *
     *@Rest\Post("/urls")
     *
     *@return JsonResponse
     */
    public function postUrlsAction(ShortUrlService $shortUrlService, Request $request)
    {
        $url = new Url();

        //TODO - Validar request (formato y existencia del parámetro originalUrl)
        $url->setOriginalUrl($request->get('originalUrl'));
        //TODO - Comprobar que no exista ya la url en la BBDD, si existe buscarla y devolver shortUrl
        $shortUrl = $shortUrlService->shorten_url();
        $url->setShortUrl($shortUrl);

        $this->em->persist($url);
        $this->em->flush();

        //TODO - Devolver error si la inserción falla (añadir manejo de excepciones con try/catch)
        return new JsonResponse(['status' => 'ok', 'id' => $url->getId()]);
    }

    /**
     * Create Url.
     *
     *@Rest\Delete("/urls/{id}")
     *
     *@return Response
     */
    public function deleteUrlsAction(int $id)
    {
        $url = $this->em->getRepository(Url::class)->find($id);

        if (!$url) {
            throw $this->createNotFoundException(
                'No url found  with id '.$id
            );
        }

        $this->em->remove($url);
        $this->em->flush();

        //TODO - Mejorar manejo de excepciones con try/catch (devolver como json)
        return new JsonResponse(['status' => 'ok', 'message' => 'Deleted url with id '.$id]);
    }
}
