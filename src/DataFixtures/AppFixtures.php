<?php

namespace App\DataFixtures;

use App\Entity\Exercice;
use App\Entity\Level;
use App\Entity\Theme;
use App\Entity\Trophy;
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

        $trophyTab = [];


            $trophy = new Trophy();
            $trophy->setLibelle('Niveau 1');
            $trophy->setIcone('trophy_one.png');
            $trophy->setNonObtainIcone('trophy_one_non_obtain.png');
            $trophy->setHidden(false);
            $trophyTab[] = $trophy;
            $manager->persist($trophy);

            $trophy = new Trophy();
            $trophy->setLibelle('Niveau 2');
            $trophy->setIcone('trophy_two.png');
            $trophy->setNonObtainIcone('trophy_two_non_obtain.png');
            $trophy->setHidden(false);
            $trophyTab[] = $trophy;
            $manager->persist($trophy);

            $trophy = new Trophy();
            $trophy->setLibelle('F12');
            $trophy->setIcone('trophy_three.png');
            $trophy->setNonObtainIcone('trophy_hidden.png');
            $trophy->setHidden(true);
            $trophyTab[] = $trophy;
            $manager->persist($trophy);

            $trophy = new Trophy();
            $trophy->setLibelle('Niveau 4');
            $trophy->setIcone('trophy_hidden.png');
            $trophy->setNonObtainIcone('trophy_hidden.png');
            $trophy->setHidden(false);
            $trophyTab[] = $trophy;
            $manager->persist($trophy);

            $trophy = new Trophy();
            $trophy->setLibelle('Niveau 5');
            $trophy->setIcone('trophy_hidden.png');
            $trophy->setNonObtainIcone('trophy_hidden.png');
            $trophy->setHidden(false);
            $trophyTab[] = $trophy;
            $manager->persist($trophy);

            $trophy = new Trophy();
            $trophy->setLibelle('Niveau 6');
            $trophy->setIcone('trophy_hidden.png');
            $trophy->setNonObtainIcone('trophy_hidden.png');
            $trophy->setHidden(false);
            $trophyTab[] = $trophy;
            $manager->persist($trophy);


        $name = ['Defaut', 'Vert','Noir', 'Bleu', 'Rouge', 'Gris', 'Jaune', 'Turquoise'];
        $color= ['dark', 'success','dark', 'primary', 'danger', 'secondary', 'warning', 'info'];

        $themes = [];

        for ($i = 0; $i < 8; $i++){
            $theme = new Theme();
            $theme->setName($name[$i]);
            $theme->setColor($color[$i]);
            $themes[] = $theme;
            $manager->persist($theme);
        }

        $users = [];

        for ($i = 0; $i < 5; $i++) {
            $user = New User();
            $user->setUsername('kiki'.$i);
            $user->setEmail('kiki'.$i.'@admin.com');
            $user->setRoles(['ROLE_ADMIN']);
            $plainPassword = 'kiki';
            $encodedPassword = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encodedPassword);
            $user->setTheme($themes[0]);
            $user->setAvatar('default.png');
            $users[] = $user;
            $manager->persist($user);
        }


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
                switch ($level->getNumber()) {
                    case 1:
                        $exercice->setLibelle('html'.' exercice'.$i);
                        break;
                    case 2:
                        $exercice->setLibelle('html/css'.' exercice'.$i);
                        break;
                    case 3:
                        $exercice->setLibelle('html/css/js'.' exercice'.$i);
                        break;

                    default:
                        # code...
                        break;
                }
                $exercice->setHelp('help'.$i);
                $exercice->setSolution('solution'.$i);
                $exercice->setNumber(($i-1));
                $exercice->setInstruction('instruction'.$i);
                $exercice->setLevel($level);

                $exercices[]=$exercice;

                $manager->persist($exercice);
            }
        }


        foreach ($users as $user) {
            for ($i = 0; $i < 20; $i++) {
                $number = $exercices[$i]->getNumber();
                $level = $exercices[$i]->getLevel()->getNumber();
                $value = $level . $number;
                $save = new UserHasExercices();
                $save->setExercices($exercices[$i]);
                $save->setUsers($user);
                $save->setFinish(true);
                $save->setValue($value);
                $m = rand(0, 50);
                $s = rand(1, 59);
                $save->setTime(new \DateTime('00:' . $m . ':' . $s));
                $manager->persist($save);
            }
        }


        $manager->flush();
    }
}
