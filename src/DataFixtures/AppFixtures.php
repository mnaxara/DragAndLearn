<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $name = ['Defaut', 'Vert', 'Bleu', 'Rouge'];
        $color= ['dark', 'success', 'primary', 'alert'];

        for ($i = 0; $i < 3; $i++){
            $theme = new Theme();
            $theme->setName($name[$i]);
            $theme->setColor($color[$i]);

            $manager->persist($theme);
        }

        $manager->flush();
    }
}
