<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\StockRepository;
use App\Entity\Stock;
use App\Form\StockType;

class StockController extends AbstractController
{
    /**
     * @Route("/stock", name="app_stock")
     */
    public function index(): Response
    {
        return $this->render('stock/index.html.twig', [
            'controller_name' => 'StockController',
        ]);
    }
     /**
     * @Route("/listStock", name="listStock")
     */
    public function list()
    {
        $Stock= $this->getDoctrine()->getRepository(Stock::class)->findAll();
      
        return $this->render("Stock/list.html.twig",array("tabclass"=>$Stock));
    }

    /**
     * @Route("/addStock", name="addstock")
     */
    public function ajout(Request $request)
    {
        $Stock= new Stock();
        $form= $this->createForm(StockType::class,$Stock);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($Stock);
            $em->flush();
            return $this->redirectToRoute("listStock");
        }
        return $this->render("Stock/createStock.html.twig",array("f"=>$form->createView()));
    }
     /**
     * @Route("/deleteStock/{id}", name="suppStock")
     */
    public function delete($id)
    {
        $Stock= $this->getDoctrine()->getRepository(Stock::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Stock);
        $em->flush();
        return $this->redirectToRoute("listStock");
    }
    
    /**
     * @Route("/updateStock/{id}", name="updateStock")
     */
    public function update(Request $request,StockRepository $repository,$id)
    {
        //$Stock= $this->getDoctrine()->getRepository(Stock::class)->find($id)
        $Stock= $repository->find($id);
        $form= $this->createForm(StockType::class,$Stock);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("listStock");
        }
        return $this->render("Stock/update.html.twig",array("Stock"=>$Stock,"f"=>$form->createView()));
    }
      /**
     * @Route("/data/nader", name="up_data")
     */
    public function data()
    {
        $Stock= $this->getDoctrine()->getRepository(Stock::class)->findAll();
       return $this->render("Stock/data.html.twig",array("tabclass"=>$Stock));
    }
     /**
     * @Route("/stat", name="stat")
     */
    public function stat(StockRepository $stockRepo)
    {
     $Stock = $stockRepo->findall();
     $nomArticl =[] ;
     $quantiteArticl =[] ;

     foreach($Stock as $Stock){
        $nomArticl[] = $Stock->getnomArticle();
        $quantiteArticl[] = $Stock->getquantiteArticle();
     }
     
     
       return $this->render("Stock/stat.html.twig", [
        'nomArticl' => json_encode($nomArticl),
        'quantiteArticl' => json_encode($quantiteArticl),

       ]);
    
    }
}
