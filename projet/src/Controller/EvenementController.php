<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\MembreType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    #[Route('/detailevt/{id?}', name: 'detail_evt')]
    public function detailevt($id, ManagerRegistry $doctrine): Response
    {
        //var_dump(new \DateTime('now'));
        $entityManager = $doctrine->getManager();
        // chemin du repository ou on va prendre les informations
        $repository = $entityManager->getRepository('App\Entity\Evenement');
        // ca prend le bon event avec l'id qu'on met
        $EvenementChoisi = $repository->find($id);
        // récupération de toutes les sessions associé à cet evenement :
        $listeSessions=$EvenementChoisi->getSessions();
        return $this->render('evenement/detailevt.html.twig', [
            'evenement_choisi' => $EvenementChoisi,
            'listeSessions' => $listeSessions,
        ]);
    }
    #[Route('/detailevtpass/{id?}', name: 'detail_evt_pass')]
    public function detailvtpass($id): Response
    {
        return $this->render('evenement/detailvtpass.html.twig', [
            'controller_name' => 'détail de l\'évènement passé',
            'id' => $id,
        ]);
    }
    #[Route('/detailprop/{id?}', name: 'detail_prop')]
    public function detailvtprop($id): Response
    {
        return $this->render('evenement/detailprop.html.twig', [
            'controller_name' => 'détail des propositions ?',
            'id' => $id,
        ]);
    }
    #[Route('/detailsession/{id?}', name: 'detail_session')]
    public function detailsession($id): Response
    {
        return $this->render('evenement/detailsession.html.twig', [
            'controller_name' => 'détail de la session',
            'id' => $id,
        ]);
    }
    #[Route('/add', name: 'add_event')]
    public function add(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager=$doctrine->getManager();
        $member = new Membre();
        $form = $this->createForm(MembreType::class, $member);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($member);
            $entityManager->flush();
        }
        return $this->render('evenement/add.html.twig', [
            'form' =>$form->createView()
        ]);
    }
    #[Route('/addprop/{id?}', name: 'add_prop')]
    public function addprop($id): Response
    {
        return $this->render('evenement/detailsession.html.twig', [
            'controller_name' => 'ajout d\'un event a la suite d\'une proposition,',
            'id' => $id,
        ]);
    }

    #[Route('/listevt', name: 'listevt')]
    public function listevt(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $repository = $entityManager->getRepository('App\Entity\Evenement');
        $evenements = $repository->find2021();
        return $this->render('evenement/listevt.html.twig', [
            'evenements' => $evenements,
        ]);
    }
}



