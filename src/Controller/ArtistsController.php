<?php
/**
 * Created by PhpStorm.
 * User: darrjone
 * Date: 28/11/2018
 * Time: 16:54
 */

namespace App\Controller;

use App\Entity\Artists;
use App\Exception\ArtistNotFoundException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ArtistsController extends AbstractController
{
    /**
     * @return JsonResponse
     * @Route("/artists", name="get_artists")
     */
    public function getArtists()
    {
        try {
            $artists = $this->getDoctrine()->getRepository(Artists::class)->findAll();

            if (count($artists) === 0) {
                throw new ArtistNotFoundException("Cannot find any artist in our discography at the moment");
            }

            $results = [];
            foreach ($artists as $artist) {
                array_push($results, $this->buildArtist($artist));
            }

            return new JsonResponse($results, 200);
        }catch(ArtistNotFoundException $e){
            return new JsonResponse($e->getMessage(), 404);
        }catch(\Exception $e){
            return new JsonResponse("Something went wrong", 500);
        }
    }

    /**
     * @param $token
     * @return JsonResponse
     * @Route("/artists/{token}", name="get_artists_by_token")
     */
    public function getArtist($token)
    {
        try {
            $artist = $this->getDoctrine()->getRepository(Artists::class)->findOneBy([
                "token" => $token
            ]);

            if (!$artist instanceof Artists) {
                throw new ArtistNotFoundException("The artist with token {$token} doesn not exist");
            }

            $results = $this->buildArtist($artist);

            return new JsonResponse($results, 200);
        }catch(ArtistNotFoundException $e){
            return new JsonResponse($e->getMessage(), 404);
        }catch(\Exception $e){
            return new JsonResponse("Something went wrong", 500);
        }
    }

    /**
     * @param Artists $artist
     * @return array
     */
    public function buildArtist(Artists $artist) : array
    {
        /**
         * @var Artists $artist
         */
        $collection = [
            "token" => $artist->getToken(),
            "name" => $artist->getName()
        ];

        foreach ($artist->getAlbums() as $album) {
            $collection["albums"][] = [
                "token" => $album->getToken(),
                "title" => $album->getTitle(),
                "cover" => $album->getCover()
            ];
        }

        return $collection;
    }
}