<?php

namespace App\Controller;

use App\Entity\Albums;
use App\Exception\AlbumNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumsController extends AbstractController
{
    /**
     * @param $token
     * @return JsonResponse|Response
     * @Route("/albums/{token}", name="get_albums")
     */
    public function getAlbums($token)
    {
        try {
            /**
             * @var Albums $album
             */
            $album = $this->getDoctrine()->getRepository(Albums::class)->findOneBy([
                "token" => $token
            ]);

            if (!$album instanceof Albums) {
                throw new AlbumNotFoundException("The album with token {$token} does not exist");
            }

            $result = [
                "token" => $album->getToken(),
                "title" => $album->getTitle(),
                "description" => $album->getDescription(),
                "cover" => $album->getCover(),
                "artist" => [
                    "token" => $album->getArtists()->getToken(),
                    "name" => $album->getArtists()->getName()
                ]
            ];

            foreach ($album->getSongs() as $song) {
                $result["songs"][] = [
                    "title" => $song->getTitle(),
                    "length" => $song->getLength()
                ];
            }

            return new JsonResponse($result, 200);
        }catch(AlbumNotFoundException $e){
            return new JsonResponse($e->getMessage(), 404);
        }catch(\Exception $e){
            return new JsonResponse("Something went wrong", 500);
        }
    }
}