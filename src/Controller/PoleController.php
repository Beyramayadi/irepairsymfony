<?php

namespace App\Controller;
use App\Entity\Pole;
use App\Form\PoleType;
use App\Repository\PoleRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PoleController extends AbstractController
{
    /**
     * @Route("/", name="base")
     */
    public function base(): Response
    {
       
        return $this->render('admin/index2.html.twig');
    }
    /**
     * @Route("/pole", name="app_pole")
     */
    public function index(): Response
    {
        return $this->render('pole/index.html.twig', [
            'controller_name' => 'PoleController',
        ]);
     
    }
    /**
     * @Route("/listPole", name="listPole")
     */
    public function list()
    {
        $pole= $this->getDoctrine()->getRepository(Pole::class)->findAll();
        return $this->render("pole/list.html.twig",array("tabclass"=>$pole));
    }

    /**
     * @Route("/addPole", name="addpole")
     */
    public function ajout(Request $request)
    {
        $pole= new Pole();
        $form= $this->createForm(PoleType::class,$pole);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($pole);
            $em->flush();
            return $this->redirectToRoute("listPole");
        }
        return $this->render("pole/createpole.html.twig",array("f"=>$form->createView()));
    }
     /**
     * @Route("/deletePole/{id}", name="suppPole")
     */
    public function delete($id)
    {
        $pole= $this->getDoctrine()->getRepository(Pole::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($pole);
        $em->flush();
        return $this->redirectToRoute("listPole");
    }
    
    /**
     * @Route("/updatePole/{id}", name="updatePole")
     */
    public function update(Request $request,PoleRepository $repository,$id)
    {
        //$Pole= $this->getDoctrine()->getRepository(Pole::class)->find($id)
        $Pole= $repository->find($id);
        $form= $this->createForm(PoleType::class,$Pole);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("listPole");
        }
        return $this->render("pole/update.html.twig",array("Pole"=>$Pole,"f"=>$form->createView()));
    }
}