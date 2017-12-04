<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace WEB\LoveLetterBundle\Controller;


use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use WEB\LoveLetterBundle\Entity\main;
use WEB\LoveLetterBundle\Entity\partie;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdvertController extends Controller
{
    public function indexAction($page)
    {
        // On ne sait pas combien de pages il y a
        // Mais on sait qu'une page doit être supérieure ou égale à 1
        $_SESSION['username'] = 'anonymous';
        if ($page < 1) {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
            throw new NotFoundHttpException('Page "' . $page . '" inexistante.');
        }
        return $this->render('WEBLoveLetterBundle:Advert:login.html.twig', array('listAdverts' => array(), 'error' => null, 'last_username' => null));
    }
/*
    public function loginAction($user, $mdp)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('WEBLoveLetterBundle:utilisateur')->findOneBy([
            "id" => $user,
            "mot_de_passe" => $mdp,
        ]);
        $response = new JsonResponse();

        if ($entities == null){
            return $response->setData(array('check'=>0));
        } else {
            $usr = $entities->getPseudo();
            $_SESSION['username'] = $usr;
            return $response->setData(array('check'=>1, 'pseudo'=>$usr));
        }
    }
*/

    public function loginAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            return $this->redirectToRoute('oc_platform_menu', array("id"=>1));
        }
        $authenticationUtils = $this->get('security.authentication_utils');
        return $this->render('WEBLoveLetterBundle:Advert:login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
        ));
    }

    public function jouerAction($id)
    {
        /*$em = $this->getDoctrine()->getManager();
        $listCarte = $em->getRepository('WEBLoveLetterBundle:carte')->findAll();
        $pioche = $em->getRepository('WEBLoveLetterBundle:pioche')->find(1);
        $defausse = $em->getRepository('WEBLoveLetterBundle:defausse')->find(1);
*/
        return $this->render('WEBLoveLetterBundle:Advert:jouer.html.twig', array('pioche' => $pioche, 'carte' => null, 'defausse' => $carteDef));
    }

    public function jouer2Action($id)
    {
        $em = $this->getDoctrine()->getManager();
        $partie = $em->getRepository('WEBLoveLetterBundle:partie')->find($id);
        $manche = $partie->getManche(10);
        $pioche = $manche->getPioche();
        $defausse = $manche->getDefausse();
        $cartedef = $defausse->getCarte(0);

        //2 JOUEURS : CARTE 1
        $nb = rand(1, 8);
        while ($pioche->getCategorie($nb) == null) {
            $nb = rand(1, 8);
        }
        $carte1 = $pioche->getCategorie($nb);
        $defausse->addCarte($carte1);
        $pioche->removeCarte($carte1);
        $em->persist($pioche);
        $em->persist($defausse);
        $em->flush();
        //2 JOUEURS : CARTE 2
        while ($pioche->getCategorie($nb) == null) {
            $nb = rand(1, 8);
        }
        $carte2 = $pioche->getCategorie($nb);
        $defausse->addCarte($carte2);
        $pioche->removeCarte($carte2);
        $em->persist($pioche);
        $em->persist($defausse);
        $em->flush();
        //2 JOUEURS : CARTE 3
        while ($pioche->getCategorie($nb) == null) {
            $nb = rand(1, 8);
        }
        $carte3 = $pioche->getCategorie($nb);
        $defausse->addCarte($carte3);
        $pioche->removeCarte($carte3);
        $array = array($carte1, $carte2, $carte3);
        $em->persist($pioche);
        $em->persist($defausse);
        $em->flush();

        return $this->render('WEBLoveLetterBundle:Advert:jouer2.html.twig', array('pioche' => $pioche, 'carte' => null, 'defausse' => $cartedef, 'regle' => $array));

    }

    public function piocherAction()
    {
        global $finManche;
        global $carte;
        $em = $this->getDoctrine()->getManager();
        $partie = $em->getRepository('WEBLoveLetterBundle:partie')->find(1);
        $manche = $partie->getManche(10);
        $pioche = $manche->getPioche();
        $img = null;
        if ($manche->getnbUtilisateur() == 2) {
            $check = 1;
            $nb = rand(1, 8);
            if ($pioche->getNbElements() != 0) {
                while ($pioche->getCategorie($nb) == null) {
                    $nb = rand(1, 8);
                }
                $carte = $pioche->getCategorie($nb);
                $img = $carte->getNom();
                $pioche->removeCarte($carte);
            } else {
                $img = null;
            }
            $utilsateur = $em->getRepository('WEBLoveLetterBundle:utilisateur')->find($_SESSION['username']);
            $main = $utilsateur->getMain();
            $main->addCarte($carte);
            $em->persist($main);
            $em->persist($pioche);
            $em->flush();
            $response = new JsonResponse();
        } else {
            $check = 0;
            $response = new JsonResponse();
        }
        return $response->setData(array('check' => $check, 'carte' => $img, 'defausse' => null));
    }

    public function gestionAction($nb_joueurs)
    {
        $em = $this->getDoctrine()->getManager();
        $listCarte = $em->getRepository('WEBLoveLetterBundle:carte')->findAll();
        $pioche = $em->getRepository('WEBLoveLetterBundle:pioche')->find(1);
        $defausse = $em->getRepository('WEBLoveLetterBundle:defausse')->find(1);
        $partie = $em->getRepository('WEBLoveLetterBundle:partie')->find(1);
        $manche = $partie->getManche(10);
        $main = $em->getRepository('WEBLoveLetterBundle:main')->find($_SESSION['username']);
        if ($main == null){
            $main = new main();
            $main->setId($_SESSION['username']);
            $em->persist($main);
            $em->flush();
        }
        foreach ($listCarte as $carte) {
            $main->removeCarte($carte);
        }
        $em->persist($main);
        $em->flush();
        $utilisateur = $em->getRepository('WEBLoveLetterBundle:utilisateur')->find($_SESSION['username']);
        $utilisateur->setMain($main);
        $em->persist($main);
        $em->flush();
        //Mettres les cartes dans la pioche
        foreach ($listCarte as $carte) {
            $pioche->removeCarte($carte);
            $pioche->addCategory($carte);
            $defausse->removeCarte($carte);
        }
        $em->persist($pioche);
        $em->persist($defausse);
        $em->flush();
        //Enlever la première carte du dessus
        $nb = rand(1, 8);
        $carte = $pioche->getCategorie($nb);
        $defausse->addCarte($carte);
        $pioche->removeCarte($carte);
        $em->persist($pioche);
        $em->persist($defausse);
        $em->flush();

        $manche->resetDefausse();
        $manche->resetPioche();
        $em->persist($manche);
        $em->flush();

        $manche->addUtilisateur($utilisateur);
        $manche->setDefausse($defausse);
        $manche->setPioche($pioche);
        $em->persist($manche);
        $em->flush();

        if ($nb_joueurs == 2){
            return $this->redirectToRoute('oc_platform_jouer2', array('id' => $partie->getId()));
        } else {
            return $this->redirectToRoute('oc_platform_jouer', array('id' => $partie->getId()));
        }
    }

    public function adversaire2Action(){
        $em = $this->getDoctrine()->getManager();
        $partie = $em->getRepository('WEBLoveLetterBundle:partie')->find(1);
        $manche = $partie->getManche(10);
        $reponse = new JsonResponse();
        if ($manche->getnbUtilisateur() == 2) {
            $utilisateur = $em->getRepository('WEBLoveLetterBundle:utilisateur')->find($_SESSION['username']);
            $enemy = $manche->getOther($utilisateur);
            $main = $enemy->getMain();
            $array = array();
            $taille = $main->getNbCartes();
            $array = array("taille"=>1, "c1" => $_SESSION['username'], "c2"=>null);
            /*if ($taille == 0) {
                $array = array("taille" => 0, "c1" => null, "c2" => null);
            } elseif ($taille == 1) {
                $carte1 = $main->getCarte(0);
                $array = array("taille" => 1, "c1" => $carte1, "c2" => null);
            } elseif ($taille == 2) {
                $carte1 = $main->getCarte(0);
                $carte2 = $main->getCarte(1);
                $array = array("taille" => 2, "c1" => $carte1, "c2" => $carte2);
            }*/
        } else {
            $array = array("taille" => 0, "c1" => $_SESSION['username'], "c2" => null);
        }
        return $reponse->setData(array('tab' => $array));

    }

    public function menuAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $partie = $em->getRepository('WEBLoveLetterBundle:partie')->find(1);

        $form = $this->get('form.factory')->createNamedBuilder('menu-form', FormType::class, $partie)
            ->add('NbJoueurs', ChoiceType::class, array(
                'choices'  => array(
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,)))
            ->add('Valider', SubmitType::class)
            ->getForm();
        ;

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->persist($partie);
                $em->flush();

                return $this->redirectToRoute('oc_platform_gestion', array('nb_joueurs' => $partie->getnbJoueurs()));
            }
        }
        return $this->render('WEBLoveLetterBundle:Advert:menu.html.twig', array(
            'form' => $form->createView(), 'pseudo' => $_SESSION['username']
        ));
    }

}