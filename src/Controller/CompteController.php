<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class CompteController extends AbstractController
{
    /**
     * @Route("/adminhome", name="adminhome")
     */
    public function base(): Response
    {
       
        return $this->render('admin/index.html.twig');
    }
    /**
     * @Route("/user", name="add_user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

 


    
    /**
     * @Route("/addUser", name="display_user")
     */
    public function addUser(Request $request)
    {
        
        $user= new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);//ajout
            $em->flush();

            return $this->redirectToRoute('display_user');

        }
        return $this->render('compte/createCompte.html.twig',['f'=>$form->createView()]);

    }
     /**
     * @Route("/listUser", name="listUser")
     */
    public function list()
    {
        $user= $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render("compte/list.html.twig",array("tabclass"=>$user));
    }
    /**
     * @Route("/deleteUser/{id}", name="suppUser")
     */
    public function delete($id)
    {
        $user= $this->getDoctrine()->getRepository(User::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute("listUser");
    }
     /**
     * @Route("/updateUser/{id}", name="updateUser")
     */
    public function update(Request $request,UserRepository $repository,$id)
    {
        //$user= $this->getDoctrine()->getRepository(User::class)->find($id)
        $user= $repository->find($id);
        $form= $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em= $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("listUser");
        }
        return $this->render("compte/update.html.twig",array("user"=>$user,"formUser"=>$form->createView()));
    }

}
