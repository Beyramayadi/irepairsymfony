<?php

namespace App\Controller;

use App\Entity\Rendezvous;
use App\Form\RendezvousType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\RendezvousRepository;


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
     * @Route("/calendrier", name="calendrier")
     */
    public function calendrier(RendezvousRepository $redv): Response
    {
        $rendezvous = $redv->findAll();

        $rdvs = [];

        foreach($rendezvous as $event){
            $rdvs[] = [
                'id' => $event->getIdrdv(),
                'start' => $event->getDateRdv()->format('Y-m-d'),
                'end' => $event->getDateRdv()->format('Y-m-d'),
                'title' => $event->getTitrerdv(),
                
                 'backgroundColor' => '#C80F0F',
                 'allDay' => 'true',

            ];
        }
        $data = json_encode($rdvs);




        return $this->render('rendezvous/calendrier.html.twig',compact('data'));
    }

     /**
     * @Route("/afficherdv", name="afficherdv")
     */
    public function afficherdv(Request $request, PaginatorInterface $paginator): Response
    {
        $data = $this->getDoctrine()->getManager()->getRepository(Rendezvous::class)->findBy(
            
            ['id_client' => 1],
           
        );

        $rendezvous = $paginator->paginate(
            $data,
            $request->query->getInt('page',1),
            4
        );    

        return $this->render('rendezvous/afficheRendezvous.html.twig', [
            'r'=>$rendezvous
        ]);
    }
    /**
     * @Route("/fairerdv/{id}/{titrerdv}" , name="rdvv")
     */
    public function fairerdv(Request $request,int $id,string $titrerdv): Response
    {
       
        $rendezvous = new rendezvous();
        $rendezvous->setIdClient(1);
        $rendezvous->setIdDevis($id);
        $rendezvous->setTitrerdv($titrerdv);

       
        
        $form = $this->createForm(RendezvousType::class,$rendezvous);

        $form->handleRequest($request);

        
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rendezvous);//Add
            $em->flush();

            return $this->redirectToRoute('afficherdv');
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
     * @Route("/supprimerrdv/{id}", name="suprdv")
     */
    public function supprDevis(Rendezvous  $rendezvous): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($rendezvous);
        $em->flush();

        return $this->redirectToRoute('afficherdv');


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
