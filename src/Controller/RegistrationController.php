<?php

namespace App\Controller;

use App\Entity\Theme;
use App\Entity\User;
use App\Entity\UserHasExercices;
use App\Entity\Exercice;
use App\Form\RegistrationFormType;
use App\Security\LoginAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginAuthenticator $authenticator): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Theme::class);
        $defaultTheme = $repository->findOneByName('defaut');

        $saveRepository = $this->getDoctrine()->getRepository(UserHasExercices::class);

        $exercice1 = $this->getDoctrine()->getRepository(Exercice::class)->findOneBySlug('html-exercice1');

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setTheme($defaultTheme);
            $user->setAvatar('default.png');
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['ROLE_USER']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);

            // Creation 1ere sauvegarde

            $save = new UserHasExercices();
                $save->setUsers($user);
                $save->setExercices($exercice1);
                $save->setTime(new \DateTime('00:00:00'));
                $save->setFinish(false);
                $value = 10;
                $save->setValue($value);

                $entityManager->persist($save);
               

            // Flush et enregistrement

            $entityManager->flush();

            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
