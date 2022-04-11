<?php

namespace App\Controller;
use App\Entity\Compte;
use App\Form\CompteType;
use App\Repository\CompteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class CompteController extends AbstractController
{
    /**
     * @Route("/", name="base")
     */
    public function base(): Response
    {
       
        return $this->render('admin/index2.html.twig');
    }
    /**
     * @Route("/compte", name="add_compte")
     */
    public function index(): Response
    {
        return $this->render('compte/index.html.twig', [
            'controller_name' => 'CompteController',
        ]);
    }

    /**
     * @Route("/addCompte", name="display_compte")
     */
    public function addCompte(Request $request)
    {
        
        $compte= new Compte();
        $form = $this->createForm(CompteType::class,$compte);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($compte);//ajout
            $em->flush();

            return $this->redirectToRoute('display_compte');

        }
        return $this->render('compte/createCompte.html.twig',['f'=>$form->createView()]);

    }
     /**
     * @Route("/listCompte", name="listCompte")
     */
    public function list()
    {
        $compte= $this->getDoctrine()->getRepository(Compte::class)->findAll();
        return $this->render("compte/list.html.twig",array("tabclass"=>$compte));
    }
    /**
     * @Route("/deleteCompte/{id}", name="suppCompte")
     */
    public function delete($id)
    {
        $compte= $this->getDoctrine()->getRepository(Compte::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($compte);
        $em->flush();
        return $this->redirectToRoute("listCompte");
    }
     /**
     * @Route("/updateCompte/{id}", name="updateCompte")
     */
    public function update(Request $request,CompteRepository $repository,$id)
    {
        //$compte= $this->getDoctrine()->getRepository(Compte::class)->find($id)
        $compte= $repository->find($id);
        $form= $this->createForm(CompteType::class,$compte);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em= $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("listCompte");
        }
        return $this->render("compte/update.html.twig",array("compte"=>$compte,"formCompte"=>$form->createView()));
    }

}
