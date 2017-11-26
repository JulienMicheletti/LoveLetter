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

        /**   $defausse = new Defausse();
        $defausse->setIdDefausse(1);
        $defausse->setIdCarte($carte->getIdCarte()); */

       /** $repo = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('WEBLoveLetterBundle:carte')
        ;*/
        $em = $this->getDoctrine()->getManager();
        $listCarte = $em->getRepository('WEBLoveLetterBundle:carte')->findAll();
        $pioche = new Pioche();
        $pioche->setId(10);

        foreach ($listCarte as $carte) {
            $pioche->addCategory($carte);
        }

        $em->persist($pioche);
        $em->flush();
       /** $manche1 = new Manche();
        $manche1->setIdDefausse($defausse->getIdDefausse());
        $manche1->setIdManche(0);
        $manche1->setIdPioche($pioche->getIdPioche());
        $manche1->setIdPartie($partie->getIdPartie());

        $manche2 = new Manche();
        $manche2->setIdDefausse($defausse->getIdDefausse());
        $manche2->setIdManche(0);
        $manche2->setIdPioche($pioche->getIdPioche());
        $manche2->setIdPartie($partie->getIdPartie());*/


        return $this->render('WEBLoveLetterBundle:Advert:jouer.html.twig', array('nom'  => $pioche));
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