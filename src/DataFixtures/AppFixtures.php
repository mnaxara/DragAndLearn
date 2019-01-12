<?php

namespace App\DataFixtures;

use App\Entity\Exercice;
use App\Entity\Level;
use App\Entity\Theme;
use App\Entity\User;
use App\Entity\UserHasExercices;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $name = ['Defaut', 'Vert', 'Bleu', 'Rouge'];
        $color= ['dark', 'success', 'primary', 'alert'];

        $themes = [];

        for ($i = 0; $i < 3; $i++){
            $theme = new Theme();
            $theme->setName($name[$i]);
            $theme->setColor($color[$i]);
            $themes[] = $theme;
            $manager->persist($theme);
        }

        $user = New User();
        $user->setUsername('kiki');
        $user->setEmail('kiki@admin.com');
        $user->setRoles(['ROLE_ADMIN']);
        $plainPassword = 'kiki';
        $encodedPassword = $this->encoder->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);
        $user->setTheme($themes[0]);

        $manager->persist($user);


        $levels = [];

        for ($i = 1; $i < 4; $i++){
            $level = new Level();
            $level->setNumber($i);
            $levels[$i] = $level;
            $manager->persist($level);
        }

        $exercices = [];

        foreach ($levels as $level) {
            for ($i = 1; $i < 11; $i++){
                $exercice = new Exercice();
                $exercice->setLibelle('Niveau :'. $level->getNumber().' exercice'.$i);
                $exercice->setHelp('help'.$i);
                $exercice->setSolution('solution'.$i);
                $exercice->setNumber($i);
                $exercice->setLevel($level);

                $exercices[]=$exercice;

                $manager->persist($exercice);
            }
        }

        for ($i = 0; $i < 3; $i++){
            $save = new UserHasExercices();
            $save->setExercices($exercices[$i]);
            $save->setUsers($user);
            $save->setTime(new \DateTime(date('Y-m-d H:i:s')));;
            $manager->persist($save);
        }


        $manager->flush();
    }
}
