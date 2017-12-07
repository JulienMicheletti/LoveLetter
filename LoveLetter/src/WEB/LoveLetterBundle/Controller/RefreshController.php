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
        $plateau = $em->getRepository('WEBLoveLetterBundle:plateau')->find(1);
        $manche = $em->getRepository('WEBLoveLetterBundle:manche')->find(10);
        $def = $manche->getDefausse();
        $defausse_array = array();
        if ($manche->getnbUtilisateur()==2){
            $defausse_array[1] = $def->getCarte(0)->getNom();
            $defausse_array[2] = $def->getCarte(1)->getNom();
            $defausse_array[3] = $def->getCarte(2)->getNom();
            $defausse_array[4] = $def->getCarte(3)->getNom();
        } else {
            $carte = $em->getRepository('WEBLoveLetterBundle:carte')->find(99);
            $carte = $carte->getNom();
            $defausse_array[1] = $carte;
            $defausse_array[2] = $carte;
            $defausse_array[3] = $carte;
            $defausse_array[4] = $carte;
        }
        $array = array();
        $i = 0;
        for ($i; $i < $plateau->getNbElements(); $i++){
            $array[$i+1] = $plateau->getCarte($i)->getNom();
        }
        $reponse = new JsonResponse();
        return $reponse->setData(array('taille' => $i, 'plateau' => $array, 'defausse' => $defausse_array));
    }

    public function refreshMainAction(){
        $em = $this->getDoctrine()->getManager();
        $me = $em->getRepository('WEBLoveLetterBundle:utilisateur')->find($this->getUser());
        $main = $me->getMain();
        $taille = $main->getNbCartes();
        if (taille == 0){
            $array = array("taille" => 0, "c1" => null, "c2" => null);
        } elseif ($taille == 1){
            $array = array("taille" => 1, "c1" => $main->getCarte(0)->getNom(), "c2" => null);
        } elseif ($taille == 2){
            $array = array("taille" => 2, "c1" => $main->getCarte(0)->getNom(), "c2" => $main->getCarte(1)->getNom());
        }
        $response = new JsonResponse();
        return $response->setData(array("tab"=>$array));
    }
}