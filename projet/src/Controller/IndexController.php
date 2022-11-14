<?php

namespace App\Controller;

use App\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        $evt = new Evenement();
        $evt->setTitre('présentation du framework symfony');
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'evt'=>$evt,
        ]);
    }
}
