<?php

namespace App\Controller;

use App\Entity\Rendezvous;
use App\Form\RendezvousType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RendezvousController extends AbstractController
{
    /**
     * @Route("/displayrendezvous", name="displayrdv")
     */
    public function index(): Response
    {
        $rendezvous = $this->getDoctrine()->getManager()->getRepository(Rendezvous::class)->findAll();
        return $this->render('rendezvous/displayRendezvous.html.twig', [
            'r'=>$rendezvous
        ]);
    }
    /**
     * @Route("/fairerdv/{id}" , name="rdvv")
     */
    public function fairerdv(Request $request,int $id): Response
    {
       
        $rendezvous = new rendezvous();
        $rendezvous->setIdClient(1);
        $rendezvous->setIdDevis($id);
       
        
        $form = $this->createForm(RendezvousType::class,$rendezvous);

        $form->handleRequest($request);

        
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rendezvous);//Add
            $em->flush();

            return $this->redirectToRoute('displayrdv');
        }

        return $this->render('rendezvous/fairerdv.html.twig',['f'=>$form->createView()]);

        
        

        

        

       
    }
    


    
     /**
     * @Route("/addrendezvous", name="addrdv")
     */
    public function addrdv(Request $request): Response
    {
        $rendezvous = new rendezvous();

        $form = $this->createForm(RendezvousType::class,$rendezvous);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rendezvous);//Add
            $em->flush();

            return $this->redirectToRoute('displayrdv');
        }
        return $this->render('rendezvous/createRendezvous.html.twig',['d'=>$form->createView()]);
    } 

     /**
     * @Route("/removerendezvous/{id}", name="supprdv")
     */
    public function suppressionDevis(Rendezvous  $rendezvous): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($rendezvous);
        $em->flush();

        return $this->redirectToRoute('displayrdv');


    }

    /**
     * @Route("/modifrendezvous/{id}", name="modifrdv")
     */
    public function modifBlog(Request $request,$id): Response
    {
        $rendezvous = $this->getDoctrine()->getManager()->getRepository(Rendezvous::class)->find($id);

        $form = $this->createForm(RendezvousType::class,$rendezvous);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('displayrdv');
        }
        return $this->render('rendezvous/updateRendezvous.html.twig',['d'=>$form->createView()]);




    }



   
}
