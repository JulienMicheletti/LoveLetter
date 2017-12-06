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

    public function guardAction($carteA, $carteD){
       $rep = false;
        if ($carteA == $carteD){
            $rep = true;
        }
        $response = new JsonResponse();
        return $response->setData(array('card' => "garde", 'rep' => $rep));
    }
}