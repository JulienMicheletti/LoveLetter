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
        return $this->redirectToRoute('oc_platform_menu', array('id' => 1));
    }

    public function jouerAction($id)
    {
        /*$em = $this->getDoctrine()->getManager();
        $listCarte = $em->getRepository('WEBLoveLetterBundle:carte')->findAll();
        $pioche = $em->getRepository('WEBLoveLetterBundle:pioche')->find(1);
        $defausse = $em->getRepository('WEBLoveLetterBundle:defausse')->find(1);
*/
        // return $this->render('WEBLoveLetterBundle:Advert:jouer.html.twig', array('pioche' => $pioche, 'carte' => null, 'defausse' => $carteDef));
    }

    public function jouer2Action($id)
    {
        $em = $this->getDoctrine()->getManager();
        $partie = $em->getRepository('WEBLoveLetterBundle:partie')->find($id);
        $manche = $partie->getManche(10);
        $pioche = $manche->getPioche();
        $defausse = $manche->getDefausse();
        $array = array();
        //2 JOUEURS : CARTE 1
        if ($manche->getnbUtilisateur() == 2) {
            $cartedef = $defausse->getCarte(0);
            $nb = rand(1, 16);
            while ($pioche->getCategorie($nb) == null) {
                $nb = rand(1, 16);
            }
            $carte1 = $pioche->getCategorie($nb);
            $defausse->addCarte($carte1);
            $pioche->removeCarte($carte1);
            $em->persist($pioche);
            $em->persist($defausse);
            $em->flush();
            //2 JOUEURS : CARTE 2
            while ($pioche->getCategorie($nb) == null) {
                $nb = rand(1, 16);
            }
            $carte2 = $pioche->getCategorie($nb);
            $defausse->addCarte($carte2);
            $pioche->removeCarte($carte2);
            $em->persist($pioche);
            $em->persist($defausse);
            $em->flush();
            //2 JOUEURS : CARTE 3
            while ($pioche->getCategorie($nb) == null) {
                $nb = rand(1, 16);
            }
            $carte3 = $pioche->getCategorie($nb);
            $defausse->addCarte($carte3);
            $pioche->removeCarte($carte3);
            $array = array($carte1, $carte2, $carte3);
            $em->persist($pioche);
            $em->persist($defausse);
            $em->flush();
        } else {
            $carte1 = $em->getRepository('WEBLoveLetterBundle:carte')->find(99);
            $cartedef = $carte1;
            $array = array($carte1, $carte1, $carte1);
        }
        return $this->render('WEBLoveLetterBundle:Advert:jouer2.html.twig', array('pioche' => $pioche, 'carte' => null, 'defausse' => $cartedef, 'regle' => $array));
    }

    public function piocherAction($enemy_check)
    {
        global $carte;
        $em = $this->getDoctrine()->getManager();
        $partie = $em->getRepository('WEBLoveLetterBundle:partie')->find(1);
        $defausse = $em->getRepository('WEBLoveLetterBundle:defausse')->find(1);
        $utilisateur = $em->getRepository('WEBLoveLetterBundle:utilisateur')->find($this->getUser());
        $manche = $partie->getManche(10);
        $enemy = $manche->getOther($utilisateur);
        $pioche = $manche->getPioche();
        $img = null;
        $id = null;
        $other = null;
        $rep = false;
        $me = null;
        $type = null;
        $other = null;
        $rep = null;
        $me = null;
        $fin = false;
        $check = 0;
        $setpose = 0;
        if ($manche->getEnd() == 1){
            if ($enemy->getVictoire() == 1){
                $nb = $enemy->getPoint() + 1;
                $enemy->setPoint($nb);
            }
            if ($utilisateur->getVictoire() == 1){
                $nb = $utilisateur->getPoint() + 1;
                $utilisateur->setPoint($nb);
            }
            $em->persist($utilisateur);
            $em->persist($enemy);
            $em->flush();
            if ($utilisateur->getPoint() == 7){
                $utilisateur->setPoint(0);
                $em->persist($utilisateur);
                $em->persist($enemy);
                $em->flush();
                return $this->render('WEBLoveLetterBundle:Advert:gagnant.html.twig', array('gagnant' => $utilisateur->getUsername()));
            }
            if ($enemy->getPoint() == 7){
                $enemy->setPoint(0);
                $em->persist($utilisateur);
                $em->persist($enemy);
                $em->flush();
                return $this->render('WEBLoveLetterBundle:Advert:gagnant.html.twig', array('gagnant' => $enemy->getUsername()));
            }
            return $this->redirectToRoute('oc_platform_gestion', array('nb_joueurs' => 2));
        }else if ($manche->getnbUtilisateur() == 2) {
            if ($enemy_check == 0)
                $utilisateur = $em->getRepository('WEBLoveLetterBundle:utilisateur')->find($this->getUser());
            else {
                $utilisateur = $em->getRepository('WEBLoveLetterBundle:utilisateur')->find($this->getUser());
                $enemy = $manche->getOther($utilisateur);
                $utilisateur = $enemy;
            }
            if ($utilisateur->getVictoire() == 0) {
                $img = null;
                $check = 2;
            } else {
                $check = 1;
                $nb = rand(1, 16);
                if ($pioche->getNbElements() != 0) {
                    while ($pioche->getCategorie($nb) == null) {
                        $nb = rand(1, 16);
                    }
                    $carte = $pioche->getCategorie($nb);
                    $img = $carte->getNom();
                    $pioche->removeCarte($carte);
                    $other = $manche->getOther($utilisateur)->getUsername();
                    $me = $utilisateur->getUsername();
                    $main = $utilisateur->getMain();
                    $main->addCarte($carte);
                    $id = $carte->getId();
                    $type = $carte->getType();
                    $rep = false;
                    $listCartes = $main->getCartes();
                    if ($img == "comtesse") {
                        foreach ($listCartes as $c) {
                            if ($c->getNom() == "roi" || $c->getNom() == "prince") {
                                $rep = true;
                                $main->removeCarte($carte);
                                $defausse->addCarte($carte);
                            }
                        }
                    } else if ($img == "roi" || $img == "prince") {
                        foreach ($listCartes as $carte) {
                            if ($carte->getNom() == "comtesse") {
                                $rep = true;
                                $main->removeCarte($carte);
                                $defausse->addCarte($carte);
                            }
                        }
                    }
                    $em->persist($main);
                    $em->persist($pioche);
                    $em->flush();
                    if ($main->getNbCartes() >= 2){
                        $setpose = 1;
                    }
                } else {
                    $img = null;
                    $fin = true;
                    $manche->setEnd(1);
                    $em->persist($manche);
                    $em->flush();
                }
            }
        }
        if ($enemy_check == 1)
            $img = 'pioche';
        $response = new JsonResponse();
        return $response->setData(array('check' => $check, 'carte' => $img, 'defausse' => null, 'id' => $id, 'utilisateurs' => $other, 'repComtesse' => $rep, 'me' => $me, 'type' => $type, 'fin' => $fin, 'pose'=>$setpose));
    }

    public function poserAction($idcarte, $carte, $typeCarte)
    {
      //  die('test poser');
        $em = $this->getDoctrine()->getManager();
        $plateau = $em->getRepository('WEBLoveLetterBundle:plateau')->find(1);
        $utilisateur = $em->getRepository('WEBLoveLetterBundle:utilisateur')->find($this->getUser());
        $partie = $em->getRepository('WEBLoveLetterBundle:partie')->find(1);
        $manche = $partie->getManche(10);
        $response = new JsonResponse();

        $main = $utilisateur->getMain();
        $card = $main->getIdCarte($idcarte);
    //    die($card->getNom());
        if ($manche->getTour() == 1){
            $manche->setTour(2);
        } else if ($manche->getTour() == 2){
            $manche->setTour(1);
        }
        if ($card != null) {
            $plateau->addCarte($card);
            $main->removeCarte($card);
        }

        $em->persist($main);
        $em->persist($plateau);
        $em->flush();
        if ($typeCarte == 1) { //guard
            return $this->redirectToRoute('oc_platform_guard', array('carteD' => $carte));
        } elseif ($typeCarte == 6) { //roi
            return $this->redirectToRoute('oc_platform_king', array());
        } elseif ($typeCarte == 5) {
            return $this->redirectToRoute('oc_platform_prince', array('nomUtilisateur' => $carte));
        } else if ($typeCarte == 3) {
            return $this->redirectToRoute('oc_platform_baron');
        } else if ($typeCarte == 2){
            return $this->redirectToRoute('oc_platform_pretre', array('nomEnemy' => $carte, 'checkvisible'=>1));
        } else {
            return $response->setData(array('card' => $card->getNom()));
        }
    }

    public function gestionAction($nb_joueurs)
    {
        $em = $this->getDoctrine()->getManager();
        $listCarte = $em->getRepository('WEBLoveLetterBundle:carte')->findAll();
        $pioche = $em->getRepository('WEBLoveLetterBundle:pioche')->find(1);
        $defausse = $em->getRepository('WEBLoveLetterBundle:defausse')->find(1);
        $partie = $em->getRepository('WEBLoveLetterBundle:partie')->find(1);
        $plateau = $em->getRepository('WEBLoveLetterBundle:plateau')->find(1);
        $manche = $partie->getManche(10);
        $manche->setTour(1);
        $manche->setEnd(0);
        $usr = $this->getUser()->getUsername();
        $main = $em->getRepository('WEBLoveLetterBundle:main')->find($usr);
        if ($main == null) {
            $main = new main();
            $main->setId($this->getUser());
            $em->persist($main);
            $em->flush();
        }
        foreach ($listCarte as $carte) {
            $main->removeCarte($carte);
        }
        $main->setVisible(0);
        $em->persist($main);
        $em->flush();
        $utilisateur = $em->getRepository('WEBLoveLetterBundle:utilisateur')->find($this->getUser());
        $enemy = $manche->getOther($utilisateur);
        $enemy->setVictoire(1);
        $manche->removeUtilisateur($utilisateur);
        $utilisateur->setMain($main);
        $utilisateur->setVictoire(1);
        $em->persist($utilisateur);
        $em->flush();
        $manche->addUtilisateur($utilisateur);
        $em->persist($manche);
        $em->flush();
        if ($manche->getnbUtilisateur() == 2) {
            //Mettres les cartes dans la pioche
            foreach ($listCarte as $carte) {
                if ($carte->getId() != 99) {
                    $pioche->removeCarte($carte);
                    $pioche->addCategory($carte);
                    $defausse->removeCarte($carte);
                }
            }
            $em->persist($pioche);
            $em->persist($defausse);
            $em->flush();
            //Vider le plateau
            foreach ($listCarte as $carte) {
                $plateau->removeCarte($carte);
            }
            $em->persist($plateau);
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
            $manche->setDefausse($defausse);
            $manche->setPioche($pioche);
            $em->persist($manche);
            $em->flush();
        }
        if ($nb_joueurs == 2) {
            return $this->redirectToRoute('oc_platform_jouer2', array('id' => $partie->getId()));
        } else {
            return $this->redirectToRoute('oc_platform_jouer', array('id' => $partie->getId()));
        }
    }

    public function adversaire2Action()
    {
        $em = $this->getDoctrine()->getManager();
        $partie = $em->getRepository('WEBLoveLetterBundle:partie')->find(1);
        $utilisateur = $em->getRepository('WEBLoveLetterBundle:utilisateur')->find($this->getUser());
        $manche = $partie->getManche(10);
        $reponse = new JsonResponse();
        if ($manche->getnbUtilisateur() == 2) {
            $enemy = $manche->getOther($utilisateur);
            $main = $enemy->getMain();
            $array = array();
            $taille = $main->getNbCartes();
            if ($taille == 0) {
                $array = array("taille" => 0, "c1" => null, "c2" => null);
            } elseif ($taille == 1) {
                $carte1 = $main->getCarte(0);
                $array = array("taille" => 1, "c1" => $carte1->getNom(), "c2" => null);
            } elseif ($taille == 2) {
                $carte1 = $main->getCarte(0);
                $carte2 = $main->getCarte(1);
                $array = array("taille" => 2, "c1" => $carte1->getNom(), "c2" => $carte2);
            }
        } else {
            $array = array("taille" => 0, "c1" => null, "c2" => null);
        }
        return $reponse->setData(array('tab' => $array));
    }

    public function menuAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $partie = $em->getRepository('WEBLoveLetterBundle:partie')->find(1);
        $form = $this->get('form.factory')->createNamedBuilder('menu-form', FormType::class, $partie)
            ->add('NbJoueurs', ChoiceType::class, array(
                'choices' => array(
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,)))
            ->add('Valider', SubmitType::class)
            ->getForm();;
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->persist($partie);
                $em->flush();
                return $this->redirectToRoute('oc_platform_gestion', array('nb_joueurs' => $partie->getnbJoueurs()));
            }
        }
        return $this->render('WEBLoveLetterBundle:Advert:menu.html.twig', array(
            'form' => $form->createView(), 'pseudo' => $this->getUser()
        ));
    }
}