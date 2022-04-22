<?php

namespace App\Controller;

use App\Entity\Devis;
use App\Form\DevisType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DevisController extends AbstractController
{


    /**
     * @Route("/", name="base")
     */
    public function base(): Response
    {
       
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/front", name="front")
     */
    public function front(): Response
    {
       
        return $this->render('front/index.html.twig');
    }
    /**
     * @Route("/fronti", name="dv")
     */
    public function frontdev(): Response
    {
       
        return $this->render('devis/ajoutDevis.html.twig');
    }

     /**
     * @Route("/devisordi")
     */
    public function devisordi(): Response
    {
       
        return $this->render('devis/devispossibles/ordinateurs.html.twig');
    }
     /**
     * @Route("/devispc")
     */
    public function devispc(): Response
    {
       
        return $this->render('devis/devispossibles/pc.html.twig');
    }
     /**
     * @Route("/devistab")
     */
    public function devistab(): Response
    {
       
        return $this->render('devis/devispossibles/tab.html.twig');
    }
     /**
     * @Route("/devisbafles")
     */
    public function devisbafles(): Response
    {
       
        return $this->render('devis/devispossibles/bafles.html.twig');
    }
     /**
     * @Route("/devisconn")
     */
    public function devisconn(): Response
    {
       
        return $this->render('devis/devispossibles/conn.html.twig');
    }
     /**
     * @Route("/devisdd")
     */
    public function devisdd(): Response
    {
       
        return $this->render('devis/devispossibles/dd.html.twig');
    }
     /**
     * @Route("/devisram")
     */
    public function devisram(): Response
    {
       
        return $this->render('devis/devispossibles/ram.html.twig');
    }
     /**
     * @Route("/devisbatterie")
     */
    public function devisbatterie(): Response
    {
       
        return $this->render('devis/devispossibles/batterie.html.twig');
    }
     /**
     * @Route("/devislecteur")
     */
    public function devislecteur(): Response
    {
       
        return $this->render('devis/devispossibles/lecteur.html.twig');
    }
    /**
     * @Route("/displaydevis", name="displaydevis")
     */
    public function index(): Response
    {
        $devis = $this->getDoctrine()->getManager()->getRepository(Devis::class)->findAll();
        return $this->render('devis/displayDevis.html.twig', [
            'd'=>$devis
        ]);
    }
    
     /**
     * @Route("/adddevis", name="adddevis")
     */
    public function adddevis(Request $request): Response
    {
        $devis = new devis();

        $form = $this->createForm(DevisType::class,$devis);

        $form->handleRequest($request);
        

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($devis);//Add
            $em->flush();

            return $this->redirectToRoute('displaydevis');
        }
        return $this->render('devis/createDevis.html.twig',['f'=>$form->createView()]);
    } 

     /**
     * @Route("/removeDevis/{id}", name="suppdevis")
     */
    public function suppressionDevis(Devis  $devis): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($devis);
        $em->flush();

        return $this->redirectToRoute('displaydevis');


    }

    /**
     * @Route("/modifDevis/{id}", name="modifdevis")
     */
    public function modifBlog(Request $request,$id): Response
    {
        $devis = $this->getDoctrine()->getManager()->getRepository(Devis::class)->find($id);

        $form = $this->createForm(DevisType::class,$devis);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('displaydevis');
        }
        return $this->render('devis/updateDevis.html.twig',['f'=>$form->createView()]);




    }



   
}
