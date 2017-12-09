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
class RefreshController extends Controller
{
    public function adversaire2Action(){
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
                if ($main->getVisible() == 1)
                    $array = array("taille" => 1, "c1" => $carte1->getNom(), "c2" => null);
                else
                    $array = array("taille" => 1, "c1" => "pioche", "c2" => null);
            } elseif ($taille == 2) {
                $carte1 = $main->getCarte(0);
                $carte2 = $main->getCarte(1);
                $array = array("taille" => 2, "c1" => $carte1->getNom(), "c2" => $carte2->getNom());
            }
        } else {
            $array = array("taille" => 0, "c1" => null, "c2" => null);
        }
        return $reponse->setData(array('tab' => $array));
    }

    public function refreshAction(){
        $em = $this->getDoctrine()->getManager();
        $manche = $em->getRepository('WEBLoveLetterBundle:manche')->find(10);
        $utilisateur = $em->getRepository('WEBLoveLetterBundle:utilisateur')->find($this->getUser());
        $def = $manche->getDefausse();
        $defausse_array = array();
        $array_a = array();
        $array_j = array();
        if ($manche->getnbUtilisateur()==2){
            $plateau_j = $utilisateur->getPlateau();
            $plateau_a = $manche->getOther($utilisateur)->getPlateau();
            $i = 0;
            $array_a[1] = $plateau_a->getNbElements();
            for ($i; $i < $plateau_a->getNbElements(); $i++){
                $array_a[$i+2] = $plateau_a->getCarte($i)->getNom();
            }
            $i = 0;
            $array_j[1] = $plateau_j->getNbElements();
            for ($i; $i < $plateau_j->getNbElements(); $i++){
                $array_j[$i+2] = $plateau_j->getCarte($i)->getNom();
            }
            $defausse_array[1] = $def->getCarte(0)->getNom();
            $defausse_array[2] = $def->getCarte(1)->getNom();
            $defausse_array[3] = $def->getCarte(2)->getNom();
            $defausse_array[4] = $def->getCarte(3)->getNom();
        } else {
            $array_a[1] = 0;
            $array_j[1] = 0;
            $carte = $em->getRepository('WEBLoveLetterBundle:carte')->find(99);
            $carte = $carte->getNom();
            $defausse_array[1] = $carte;
            $defausse_array[2] = $carte;
            $defausse_array[3] = $carte;
            $defausse_array[4] = $carte;
        }
        $reponse = new JsonResponse();
        return $reponse->setData(array('plateau_a' => $array_a, "plateau_j" => $array_j, 'defausse' => $defausse_array));
    }

    public function refreshMainAction(){
        $em = $this->getDoctrine()->getManager();
        $me = $em->getRepository('WEBLoveLetterBundle:utilisateur')->find($this->getUser());
        $plateau = $em->getRepository('WEBLoveLetterBundle:plateau')->find(1);
        $manche = $em->getRepository('WEBLoveLetterBundle:manche')->find(10);
        $check = 0;
        $user = null;
        $array = array();
        if ($manche->getnbUtilisateur() == 2) {
            $main = $me->getMain();
            $taille = $main->getNbCartes();
            $user = $manche->getOther($me)->getUsername();
            $me = $me->getUsername();
            if ($taille == 0) {
                $array = array("taille" => 0, "c1" => null, "c2" => null, "type1" => null, "type2" => null);
            } elseif ($taille == 1) {
                $id = $main->getCarte(0)->getId();
                $array = array("taille" => 1, "c1" => $main->getCarte(0)->getNom(), "c2" => null, "type1" => $main->getCarte(0)->getType(), "type2" => null, 'idCarte1' => $id, 'idCarte2' => null);
            } elseif ($taille == 2) {
                $id = $main->getCarte(0)->getId();
                $id2 = $main->getCarte(1)->getId();
                $array = array("taille" => 2, "c1" => $main->getCarte(0)->getNom(), "c2" => $main->getCarte(1)->getNom(), "type1" => $main->getCarte(0)->getType(), "type2" => $main->getCarte(1)->getType(), 'idCarte1' => $id, 'idCarte2' => $id2);
            }
        }
        $response = new JsonResponse();
        return $response->setData(array("user"=>$user, "me" => $me, "tab"=>$array));
    }
}