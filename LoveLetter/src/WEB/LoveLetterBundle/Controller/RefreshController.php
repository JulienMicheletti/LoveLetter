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
        $array = array(3);
        $array['taille'] = 0;
        $array['c1'] = 0;
        $array['c2'] = 0;
        if ($manche->getnbUtilisateur() == 2) {
            $enemy = $manche->getOther($utilisateur);
            $main = $enemy->getMain();
            $taille = $main->getNbCartes();
            if ($taille == 1) {
                $carte1 = $main->getCarte(0);
                $array['taille'] = 1;
                $array['c1'] = $carte1->getNom();
            } elseif ($taille == 2) {
                $carte1 = $main->getCarte(0);
                $carte2 = $main->getCarte(1);
                $array['taille'] = 2;
                $array['c1'] = $carte1->getNom();
                $array['c2'] = $carte2->getNom();
            }
        }
        return array($array);
    }

    public function refreshAction(){
        $em = $this->getDoctrine()->getManager();
        $plateau = $em->getRepository('WEBLoveLetterBundle:plateau')->find(1);
        $array = $plateau->getCartes();
        $i = $plateau->getNbElements();
       /* for ($i; $i < $plateau->getNbElements(); $i++){
            //$var = $i;
            //$carte = "carte".$var;
            $array[$i] = $plateau->getCarte($i);
        }*/
        $reponse = new JsonResponse();
        $adversaire = $this->adversaire2Action();
        return $reponse->setData(array('taille' => $i, 'plateau' => $array, 'tab' => $adversaire));
    }
}