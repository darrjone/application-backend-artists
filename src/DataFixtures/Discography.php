<?php

namespace App\DataFixtures;

use App\Entity\Albums;
use App\Entity\Artists;
use App\Entity\Songs;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Utils\TokenGenerator;

class Discography extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $discography = file_get_contents("https://gist.githubusercontent.com/fightbulc/9b8df4e22c2da963cf8ccf96422437fe/raw/8d61579f7d0b32ba128ffbf1481e03f4f6722e17/artist-albums.json");
        $discography = json_decode($discography, true);

        $tokenGenerator = new TokenGenerator();

        foreach($discography as $artist){
            $artistObj = new Artists();
            $artistObj->setName($artist["name"]);
            $artistObj->setToken($tokenGenerator->generate(6));
            $manager->persist($artistObj);

            foreach($artist["albums"] as $album){
                $albumObj = new Albums();
                $albumObj->setTitle($album["title"]);
                $albumObj->setToken($tokenGenerator->generate(6));
                $albumObj->setCover($album["cover"]);
                $albumObj->setDescription($album["description"]);
                $albumObj->setArtists($artistObj);
                $manager->persist($albumObj);

                foreach($album["songs"] as $song){
                    $songObj = new Songs();
                    $songObj->setTitle($song["title"]);
                    $songObj->setLength($this->timeToSeconds($song["length"]));
                    $songObj->setAlbum($albumObj);
                    $manager->persist($songObj);
                }
            }

        }

        $manager->flush();
    }

    /**
     * @param $time
     * @return float|int
     * Reference: https://stackoverflow.com/questions/4834202/convert-time-in-hhmmss-format-to-seconds-only
     */
    private function timeToSeconds($time){

        sscanf($time, "%d:%d:%d", $hours, $minutes, $seconds);

        return isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
    }
}
