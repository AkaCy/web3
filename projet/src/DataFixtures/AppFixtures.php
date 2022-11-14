<?php

namespace App\DataFixtures;

use App\Entity\Evenement;
use App\Entity\Membre;
use App\Entity\Session;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // les membres
        $membre1 = new Membre();
        $membre1->setNom('Jeannot');
        $membre1->setPrenom('Lapin');
        $membre1->setTel('0202020202');
        $membre1->setAdressemail('jeannotlapin@gmail.com');
        $manager->persist($membre1);
        $membre2 = new Membre();
        $membre2->setNom('Claire');
        $membre2->setPrenom('Chazal');
        $membre2->setTel('0202020202');
        $membre2->setAdressemail('jeannotlapin@gmail.com');
        $manager->persist($membre2);

        // les event
        $event1 = new Evenement();
        $event1->setTitre('Imagine tu travailles');
        $event1->setAdresse("dans un arbre");

        // TROUVE COMMENT METTRE LA DATE

        //$DateD='2020-12-10';
        //$DateD->format('Y-m-d');
        $event1->setDateHeureDebut(new \DateTime('2022-10-10 14:42:56'));
        $event1->setDateHeureFin(new \DateTime("2020-12-10"));
        $event1->setNbpartmax(50);
        $event1->setEvtcourant(false);

        $event1->addMembre($membre1);
        $event1->addMembre($membre2);
        $manager->persist($event1);

        $event2 = new Evenement();
        $event2->setTitre('Imagine tu voyages');
        $event2->setDateHeureDebut(new \DateTime("2020-12-10"));
        $event2->setDateHeureFin(new \DateTime("2020-12-10"));
        $event2->setNbpartmax(50);
        $event2->setEvtcourant(false);
        $event2->setAdresse("Sur la montagne");

        $event2->addMembre($membre1);
        $manager->persist($event2);

        // les sessions
        $session1=new Session();

        $session1->setTitre('Début du travail');
        $session1->setNomauteur('Un prof lambda');
        $session1->setEvenement($event1);
        $manager->persist($session1);

        $session2=new Session();

        $session2->setTitre('Suite du travail');
        $session2->setNomauteur('Un autre prof lambda');
        $session2->setEvenement($event1);
        $manager->persist($session2);

        $manager->flush();
    }
}
