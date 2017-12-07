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
                $array = array("taille" => 2, "c1" => $carte1->getNom(), "c2" => $carte2);
            }
        } else {
            $array = array("taille" => 0, "c1" => null, "c2" => null);
        }
        return $reponse->setData(array('tab' => $array));
    }

    public function refreshAction(){
        $em = $this->getDoctrine()->getManager();
        $plateau = $em->getRepository('WEBLoveLetterBundle:plateau')->find(1);
        $array = array();
        $i = 0;
        for ($i; $i < $plateau->getNbElements(); $i++){
            $array[$i+1] = $plateau->getCarte($i)->getNom();
        }
        $reponse = new JsonResponse();
        return $reponse->setData(array('taille' => $i, 'plateau' => $array));
    }
}