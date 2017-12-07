<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 05/12/2017
 * Time: 14:26
 */
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
class EffetController extends Controller
{
    public function guardAction($carteD){
        $rep = false;
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository('WEBLoveLetterBundle:utilisateur')->find($this->getUser());
        $partie = $em->getRepository('WEBLoveLetterBundle:partie')->find(1);
        $manche = $partie->getManche(10);

        $enemy = $manche->getOther($utilisateur);
        $main = $enemy->getMain();
        $carteA = $main->getCarte(0)->getNom();

        if ($carteA == $carteD){
            $rep = true;
        }
        $response = new JsonResponse();
        return $response->setData(array('card' => "garde", 'rep' => $rep));
    }

    public function countAction(){
        $rep = false;
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository('WEBLoveLetterBundle:utilisateur')->find($this->getUser());
        $partie = $em->getRepository('WEBLoveLetterBundle:partie')->find(1);
        $manche = $partie->getManche(10);

        $main = $utilisateur->getMain();
        $listCartes = $main->getCartes();
        foreach ($listCartes as $carte){
            if ($carte->getNom() == "roi" || $carte->getNom() == "prince"){
                $rep = true;
            }
        }
        $response = new JsonResponse();
        return $response->setData(array('card' => "comtesse", 'rep' => $rep));
    }
}