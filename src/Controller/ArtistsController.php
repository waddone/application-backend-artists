<?php
namespace App\Controller;
use App\Entity\Artists;
use App\Entity\Albums;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @property ArtistsRepository artistsRepository
 */
class ArtistsController extends AbstractController
{
    /**
     * @Route("/artists", name="artists")
     */
   
    public function getAll(){
        $artists = $this->getDoctrine()->getRepository(Artists::class)->findAll();
        $array_c = array();
        foreach($artists as $artist) {
            $albums = $this->getDoctrine()->getRepository(Albums::class)->findAlbum($artist->getToken());
            foreach ($albums as $album){
                $related_album = array(
                    'token' => $album->getToken(),
                    'title' => $album->getTitle(),
                    'cover' => $album->getCover()
                );
            }
            $array_c[] = array(
                'name'      => $artist->getName(),
                'token'     => $artist->getToken(),
                'related'   => $related_album
            );
        }

        return new JsonResponse($array_c);
    }

    /**
     * @Route("/artists/{token}", name="get_artist")
     */

    public function getByToken($token){
            
            $artist = $this->getDoctrine()->getRepository(Artists::class)->findOneBy(['token' => $token]);
            if (!is_object($artist)) {
                throw $this->createNotFoundException(
                    'No Artist found for entered token '.$token
                );
            }
            $array_c = array();
            $albums = $this->getDoctrine()->getRepository(Albums::class)->findAlbum($artist->getToken());
            $array_c['name']  = $artist->getName();
            $array_c['token'] = $artist->getToken();
            foreach ($albums as $album){
                $related_album = array(
                    'token' => $album->getToken(),
                    'title' => $album->getTitle(),
                    'cover' => $album->getCover()
                );
                $array_c['related'] = $related_album;
            }

        return new JsonResponse($array_c);
    }
    
}