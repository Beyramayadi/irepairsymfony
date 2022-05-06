<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class DashboardController
 * @package App\Controller\Admin
 */

class DashboardController extends AbstractController{
    /**
     * @Route("/admin/home",name="admin_home")
     */
    public function index():Response
    {
        return $this->render('admin/index.html.twig');

        // return $this->render('admin/home.html.twig');
    }
    /**
     * @Route("/front",name="user_home")
     */
    public function indexfront():Response
    {
        return $this->render('admin/fronthome.html.twig');
    }
}