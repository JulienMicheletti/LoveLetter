<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace WEB\LoveLetterBundle\Controller;


use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
        $em = $this->getDoctrine()->getManager();
        $listCarte = $em->getRepository('WEBLoveLetterBundle:carte')->findAll();
        $pioche = $em->getRepository('WEBLoveLetterBundle:pioche')->find(1);
        $defausse = $em->getRepository('WEBLoveLetterBundle:defausse')->find(1);

        foreach ($listCarte as $carte) {
            $pioche->removeCarte($carte);
            $pioche->addCategory($carte);
            $defausse->removeCarte($carte);
        }
        $em->persist($pioche);
        $em->persist($defausse);
        $em->flush();

        $nb = rand(1,8);

        $carte = $pioche->getCategorie($nb);

        $defausse->addCarte($carte);
        $carteDef = $defausse->getCarte(1);
        $pioche->removeCarte($carte);
        $em->persist($pioche);
        $em->persist($defausse);
        $em->flush();

        return $this->render('WEBLoveLetterBundle:Advert:jouer.html.twig', array('pioche' => $pioche, 'carte' => null, 'defausse' => $carteDef));
    }

    public function piocherAction()
    {
        global $finManche;
        global $carte;
        $em = $this->getDoctrine()->getManager();
        $pioche = $em->getRepository('WEBLoveLetterBundle:pioche')->find(1);
        $nb = rand(1, 8);
        if ($pioche->getNbElements() != 0) {
            while ($pioche->getCategorie($nb) == null) {
                $nb = rand(1, 8);
            }
            $carte = $pioche->getCategorie($nb);
            $pioche->removeCarte($carte);
        } else {
           $carte = null;
        }

        $em->persist($pioche);
        $em->flush();

        return $this->render('WEBLoveLetterBundle:Advert:jouer.html.twig', array('carte' => $carte, 'defausse' => null));
    }

    public function plateau(){

    }

}