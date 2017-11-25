<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace WEB\LoveLetterBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use WEB\LoveLetterBundle\Entity\carte;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
    public function indexAction($page)
    {
        // On ne sait pas combien de pages il y a
        // Mais on sait qu'une page doit être supérieure ou égale à 1
        if ($page < 1) {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
            throw new NotFoundHttpException('Page "' . $page . '" inexistante.');
        }
        return $this->render('WEBLoveLetterBundle:Advert:index.html.twig', array('listAdverts' => array()));
    }

    public function jouerAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $this->getDoctrine()->getManager();
        $advertRepository = $em->getRepository('WEBLoveLetterBundle:carte');
        // Création de l'entité
        $carte = new Carte();
        $carte->setEffet('Effet2');
        $carte->setIdCarte(1);
        $carte->setImage("testImage2");
        $carte->setNom("Kuribo");

        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();

        // Étape 1 : On « persiste » l'entité
        $em->persist($carte);

        // Étape 2 : On « flush » tout ce qui a été persisté avant
        $em->flush();

        //return $this->redirect($this->generateUrl('oc_platform_jouer', array('nom' => $carte->getNom())));
        return $this->render('WEBLoveLetterBundle:Advert:jouer.html.twig', array('nom'  => $carte->getNom()));
        // return $this->render('WEBLoveLetterBundle:Advert:jouer.html.twig');
    }


    public function menuAction($limit)
    {
        // On fixe en dur une liste ici, bien entendu par la suite
        // on la récupérera depuis la BDD !
        $listAdverts = array(
            array('id' => 2, 'title' => 'Recherche développeur Symfony'),
            array('id' => 5, 'title' => 'Mission de webmaster'),
            array('id' => 9, 'title' => 'Offre de stage webdesigner')
        );

        return $this->render('WEBLoveLetterBundle:Advert:menu.html.twig', array(
            // Tout l'intérêt est ici : le contrôleur passe
            // les variables nécessaires au template !
            'listAdverts' => $listAdverts
        ));
    }
}