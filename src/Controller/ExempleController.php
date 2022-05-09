<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PersonneRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Personne;

class ExempleController extends AbstractController
{
    /**
     * @Route("/exemple", name="app_exemple")
     */
    public function index(): Response
    {
        return $this->render('exemple/index.html.twig', [
            'controller_name' => 'ExempleController',
        ]);
    }
    /**
     * @Route("/affichage", name="affichage")
     */
    public function list(Request $request,PersonneRepository $PersonneRepository): Response
    {
        $Personne= $this->getDoctrine()->getRepository(Personne::class)->findAll();

       // $Personne= $this->getDoctrine()->getRepository(exemple::class)->findAll();
        return $this->render("exemple/affichage.html.twig",array("tabclass"=>$Personne));
    }
}


