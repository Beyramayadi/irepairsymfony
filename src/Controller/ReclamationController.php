<?php

namespace App\Controller;
use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ReclamationController extends AbstractController
{
    /**
     * @Route("/reclamation", name="add_reclamation")
     */
    public function index(): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'controller_name' => 'ReclamationController',
        ]);
    }
    /**
     * @Route("/addReclamation", name="display_reclamation")
     */
    public function addReclamation(Request $request)
    {
        $reclamations= $this->getDoctrine()->getRepository(Reclamation::class)->findAll();
        $reclamation= new Reclamation();
        $form = $this->createForm(ReclamationType::class,$reclamation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $reclamation->setIdClient($this->getUser()->getId());
            $reclamation->setImportant(0);
            $em->persist($reclamation);//ajout
            $em->flush();

            return $this->redirectToRoute('listReclamation');

        }
        return $this->render('reclamation/createReclamation.html.twig',['f'=>$form->createView()]);

    }
    /**
     * @Route("/front/addReclamation", name="frontdisplay_reclamation")
     */
    public function frontaddReclamation(Request $request)
    {
        $reclamations= $this->getDoctrine()->getRepository(Reclamation::class)->findAll();
        $reclamation= new Reclamation();
        $form = $this->createForm(ReclamationType::class,$reclamation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $reclamation->setIdClient($this->getUser()->getId());
            $reclamation->setImportant(0);
            $em->persist($reclamation);//ajout
            $em->flush();

            return $this->redirectToRoute('listReclamation');

        }
        return $this->render('reclamation/frontcreateReclamation.html.twig',['f'=>$form->createView()]);

    }
     /**
     * @Route("/listReclamation", name="listReclamation")
     */
    public function list()
    {
        $reclamation= $this->getDoctrine()->getRepository(Reclamation::class)->findAll();
        return $this->render("reclamation/list.html.twig",array("tabclass"=>$reclamation));
    }
    /**
     * @Route("/deleteReclamation/{id}", name="suppReclamation")
     */
    public function delete($id)
    {
        $reclamation= $this->getDoctrine()->getRepository(Reclamation::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($reclamation);
        $em->flush();
        return $this->redirectToRoute("listReclamation");
    }
    /**
     * @Route("/important/{id}", name="impoReclamation")
     */
    public function important($id)
    {
        $reclamation= $this->getDoctrine()->getRepository(Reclamation::class)->find($id);
        $reclamation->setImportant(!$reclamation->getImportant());
        $em = $this->getDoctrine()->getManager();
        $em->persist($reclamation);
        $em->flush();
        return $this->redirectToRoute("listReclamation");
    }
     /**
     * @Route("/updateReclamation/{id}", name="updateReclamation")
     */
    public function update(Request $request,ReclamationRepository $repository,$id)
    {
        //$reclamation= $this->getDoctrine()->getRepository(Reclamation::class)->find($id)
        $reclamation= $repository->find($id);
        $form= $this->createForm(ReclamationType::class,$reclamation);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em= $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("listReclamation");
        }
        return $this->render("reclamation/update.html.twig",array("reclamation"=>$reclamation,"formReclamation"=>$form->createView()));
    }

}
