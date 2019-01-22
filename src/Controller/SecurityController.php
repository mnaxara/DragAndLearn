<?php

namespace App\Controller;

use App\Entity\Level;
use App\Entity\Trophy;
use App\Entity\UserHasExercices;
use App\Form\UserEmailType;
use App\Form\UserProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Theme;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error, 'registrationForm' => $form->createView()]);
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profile(Request $request, UserPasswordEncoderInterface $encoder): Response
    {

        $user = $this->getUser();

        $themes = $this->getDoctrine()->getRepository(Theme::class)->findAll();

        $trophies = $this->getDoctrine()->getRepository(Trophy::class)->findAll();

        $hasTrophies = $user->getTrophies();


        //Recuperation de la save pour barre de progression
        $repositoryU = $this->getDoctrine()->getRepository(UserHasExercices::class);
        $lastSave = $repositoryU->getLastSave($user);
        $results = $repositoryU->getResults($user);

        $repositoryL = $this->getDoctrine()->getRepository(Level::class);
        $nbLevel = $repositoryL->countLevel();

        $exerciceByLevel = [];
        for ($i = 1; $i <= $nbLevel; $i++){
            foreach ($results as $result) {
                if ($result['levelNumber'] == $i)
                    $exerciceByLevel[$i][$result['exoNumber']+1] = $result;
            }
        }

        // GESTION DU CHANGEMENT DE MOT DE PASSE
        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createForm(UserProfileType::class, $user);

        $mdpSend = $request->request->get('mdpActu');
        $mdpActu = $user->getPassword();

        $form->handleRequest($request);

        if (password_verify($mdpSend, $mdpActu)){

            if($form->isSubmitted() && $form->isValid()){

                $user = $form->getData();

                $new = $user->getPlainPassword();

                $encoded = $encoder->encodePassword($user, $new);

                $user->setPassword($encoded);

                $entityManager->persist($user);

                $entityManager->flush();

                $this->addFlash('success', 'Mot de passe modifié');

                return $this->render('security/profile.html.twig', [
                    'user' => $user,
                    'theme' => $theme,
                    'trophies' => $trophies,
                    'hasTrophies' => $hasTrophies,
                    'last_exercice' => $lastSave,
                    'exerciceByLevel' => $exerciceByLevel,
                    'userPassForm'=>$form->createView()
                ]);
            }
        }
        else if (!empty($mdpSend))
        {
            $this->addFlash('danger', 'Mot de passe incorrect');
        }

        //**************************************

        // Modif email
        $formEmail = $this->createForm(UserEmailType::class, $user);
        $formEmail->handleRequest($request);
        $user = $formEmail->getData();
        $entityManager->flush();


        //****************


        return $this->render('security/profile.html.twig', [
            'user' => $user,
            'themes' => $themes,
            'trophies' => $trophies,
            'hasTrophies' => $hasTrophies,
            'last_exercice' => $lastSave,
            'exerciceByLevel' => $exerciceByLevel,
            'userPassForm'=>$form->createView(),
            'userEmailForm'=>$formEmail->createView(),
        ]);

    }

    /**
     * @Route("/forgotten_password", name="app_forgotten_password")
     */
    public function forgottenPassword(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        \Swift_Mailer $mailer,
        TokenGeneratorInterface $tokenGenerator
    ): Response
    {

        if ($request->isMethod('POST')) {

            $email = $request->request->get('email');

            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByEmail($email);
            /* @var $user User */

            if ($user === null) {
                $this->addFlash('danger', 'Email Inconnu');
                return $this->redirectToRoute('app_login');
            }
            $token = $tokenGenerator->generateToken();

            try{
                $user->setResetToken($token);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('app_login');
            }

            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

            $message = (new \Swift_Message('Forgot Password'))
                ->setFrom('g.ponty@dev-web.io')
                ->setTo($user->getEmail())
                ->setBody(
                    "blablabla voici le token pour reseter votre mot de passe : <a href='". $url ."'>Cliquez ici !</a>",
                    'text/html'
                );

            $mailer->send($message);

            $this->addFlash('notice', 'Mail envoyé');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/forgotten_password.html.twig');
    }

    /**
     * @Route("/reset_password/{token}", name="app_reset_password")
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {
 
        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();
 
            $user = $entityManager->getRepository(User::class)->findOneByResetToken($token);
            /* @var $user User */
 
            if ($user === null) {
                $this->addFlash('danger', 'Token Inconnu');
                return $this->redirectToRoute('app_login');
            }
 
            $user->setResetToken(null);
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            $entityManager->flush();
 
            $this->addFlash('notice', 'Mot de passe mis à jour');
 
            return $this->redirectToRoute('app_login');
        }else {
 
            return $this->render('security/reset_password.html.twig', ['token' => $token]);
        }

    }
}


