<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace WEB\LoveLetterBundle\Controller;


use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use WEB\LoveLetterBundle\Entity\partie;
use WEB\LoveLetterBundle\Entity\manche;
use WEB\LoveLetterBundle\Entity\defausse;
use WEB\LoveLetterBundle\Entity\utilisateur;
use WEB\LoveLetterBundle\Entity\main;
use WEB\LoveLetterBundle\Entity\pioche;
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
        global $pioche;
        $em = $this->getDoctrine()->getManager();
        $listCarte = $em->getRepository('WEBLoveLetterBundle:carte')->findAll();
        $anciennePioche = $em->getRepository('WEBLoveLetterBundle:pioche')->find(1);
        if ($anciennePioche != null){
            $pioche = $anciennePioche;
        } else {
            $pioche = new Pioche();
            $pioche->setId(1);
        }

        foreach ($listCarte as $carte) {
            $pioche->removeCategory($carte);
        }

        foreach ($listCarte as $carte) {
            $pioche->addCategory($carte);
        }

        $em->persist($pioche);
        $em->flush();

        return $this->render('WEBLoveLetterBundle:Advert:jouer.html.twig', array('pioche'  => $pioche, 'carte' => null));
    }

    public function piocherAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pioche = $em->getRepository('WEBLoveLetterBundle:pioche')->find(1);

        $nb = rand(1, 8);
        while ($pioche->getCategorie($nb) == null){
            $nb = rand(1, 8);
        }
        $carte = $pioche->getCategorie($nb);
        $pioche->removeCategory($carte);

        $em->persist($pioche);
        $em->flush();

        return $this->render('WEBLoveLetterBundle:Advert:jouer.html.twig', array('carte'  => $carte));
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