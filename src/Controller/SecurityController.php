<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/","/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $errormsg = 0;
        if ($user = $this->getUser()) {
            if ($user->isBlocked()) {
                $errormsg = 'User blocker par Admin';
            } else if (!$user->IsVerified()) {
                $errormsg = 'Mail pas encour verifier';
            } else {
                // if ($user->isVerified()) {
                // if (in_array('ROLE_ADMIN', $user->getRoles())) {
                //     return $this->redirectToRoute('admin_home');
                // }
                // if (in_array('ROLE_ETUDIANT', $user->getRoles())) {
                //     return $this->redirectToRoute('etudiant_home');
                // }
                // if (in_array('ROLE_RECRUTEUR', $user->getRoles())) {
                //     return $this->redirectToRoute('recruteur_home');
                // }

                return $this->redirectToRoute('user_back_index');
                // }
            }
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'errormsg' => $errormsg
        ]);
            // return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);

         
         
        // return $this->render('admin/index2.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
       


    }

   
}
