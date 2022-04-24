<?php

namespace App\Controller;

use App\Entity\Devis;
use App\Form\DevisType;
use App\Form\SearchFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\DevisRepository;

class DevisController extends AbstractController
{


     /**
     * @Route("/fairedevis/{prix}/{titre}" , name="fairedevis")
     */
    public function fairedevis(Request $request,float $prix,string $titre): Response
    {
       
        $devis = new devis();
        $devis->setPrix($prix);
        $devis->setTitre($titre);
        $date = new \DateTime('now');
        $devis->setDateDevis($date);
        $devis->setIdClient(1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($devis);//Add
        $em->flush();

        return $this->redirectToRoute('afficherdevis');

       
    }
     /**
     * @Route("/afficherdevis", name="afficherdevis")
     */
    public function afficherdevis(Request $request, PaginatorInterface $paginator)
    {
        $data = $this->getDoctrine()->getManager()->getRepository(Devis::class)->findBy(
            
            ['Id_Client' => 1]);
        $devis = $paginator->paginate(
            $data,
            $request->query->getInt('page',1),
            10
        );   
        $formSearch= $this->createForm(SearchFormType::class);
        $formSearch->handleRequest($request);


        if($formSearch->isSubmitted()){
            $titre= $formSearch->getData();
            $results = $this->getDoctrine()->getRepository(Devis::class)->searchDevis($titre);
            $res = $paginator->paginate(
                $results,
                $request->query->getInt('page',1),
                10
            ); 

             
            return $this->render("devis/afficherdevis.html.twig",
                array("searchForm"=>$formSearch->createView(),
                    "d"=>$res));
        }

        


        return $this->render("devis/afficherdevis.html.twig",
                array("searchForm"=>$formSearch->createView(),
                    "d"=>$devis));
    }
     /**
     * @Route("/supprimerdevis/{id}", name="supprdevis")
     */
    public function remdevis(Devis  $devis): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($devis);
        $em->flush();

        return $this->redirectToRoute('afficherdevis');


    }

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
