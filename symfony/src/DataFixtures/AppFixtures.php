<?php

namespace App\DataFixtures;

use App\Entity\Link;
use App\Helper\ShortUrlHelper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private static array $demoUrls = [
        'https://www.google.de',
        'https://www.youtube.de',
        'https://www.github.com/cooolinho',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::$demoUrls as $demoUrl) {
            $link = new Link($demoUrl);
            $link->setDescription($demoUrl);
            $link->setShortUrl(ShortUrlHelper::generate());

            $manager->persist($link);
        }

        $manager->flush();
    }
}
