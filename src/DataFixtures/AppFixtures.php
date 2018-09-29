<?php

namespace App\DataFixtures;
use App\Entity\Albums;
use App\Entity\Artists;
use App\Entity\Songs;
use App\Utils\TokenGenerator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
class AppFixtures extends Fixture
{
    
    public function load(ObjectManager $manager): void
    {
        $json = file_get_contents('https://gist.githubusercontent.com/fightbulc/9b8df4e22c2da963cf8ccf96422437fe/raw/8d61579f7d0b32ba128ffbf1481e03f4f6722e17/artist-albums.json');
        $data = json_decode($json, true);
        
        foreach ($data as $artistData) {  
            $artist = $this->addArtist($artistData);
            $manager->persist($artist);
            $albums = $artistData['albums'];
            
            foreach ($albums as $albumData) {     
                $album = $this->addAlbum($artist, $albumData);
                $manager->persist($album);
                $songs = $albumData['songs'];
                
                foreach ($songs as $songData) {
                    $song = $this->addSong($album, $songData);
                    $manager->persist($song);
                    
                }
            }    
        }
        $manager->flush();
    }

    public function addArtist($artistData): ?Artists
    {
        $artist = new Artists();
        $artist->setName($artistData['name']);
        return $artist;
    }
    public function addAlbum($artist, $albumData): ?Albums
    {
        $album = new Albums();
        $album->setTitle($albumData['title']);
        $album->setCover($albumData['cover']);
        $album->setDescription($albumData['description']);
        $album->setArtistToken($artist->getToken());
        return $album;
    }
    public function addSong($album, $songData): ?Songs
    {
        $song = new Songs();
        $song->setTitle($songData['title']);
        $song->setLength($songData['length']);
        $song->setAlbumToken($album->getToken());
        return $song;
    }
    
    
  
} 