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
       
        return $this->render('front/index.html.twig');
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
