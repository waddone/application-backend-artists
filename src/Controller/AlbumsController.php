<?php
namespace App\Controller;
use App\Entity\Artists;
use App\Entity\Songs;
use App\Entity\Albums;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @property AlbumsRepository albumsRepository
 */
class AlbumsController extends AbstractController
{
    /**
     * @Route("/albums/{token}", name="get_albums")
     */
   
    public function getAlbum($token){
        $albums = $this->getDoctrine()->getRepository(Albums::class)->findToken($token);
        if (!is_object($albums)) {
            throw $this->createNotFoundException(
                'No Album found for entered token '.$token
            );
        }
        $array_c = array();
        foreach($albums as $album) {
            $songs  = $this->getDoctrine()->getRepository(Songs::class)->findSongs($album->getToken());
            foreach ($songs as $song){
                $related_songs = array(
                    'title'  => $song->getTitle(),
                    'lenght' => $song->getLength()
                );
            }
            $artists = $this->getDoctrine()->getRepository(Artists::class)->findArtists($album->getArtistToken());
            foreach ($artists as $artist){
                $related_artists = array(
                    'token'  => $artist->getToken(),
                    'name'   => $artist->getName()
                );
            }
            $array_c[] = array(
                'token'             => $album->getToken(),
                'title'             => $album->getTitle(),
                'description'       => $album->getDescription(),
                'cover'             => $album->getCover(),
                'related_artists'   => $related_artists,
                'related_songs'     => $related_songs

            );

        }
        return new JsonResponse($array_c);
    }    
    
}