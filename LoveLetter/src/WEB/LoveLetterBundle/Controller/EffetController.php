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
            $enemy->setVictoire(0);
        }
        $em->persist($enemy);
        $em->flush();
        $response = new JsonResponse();
        return $response->setData(array('card' => "garde", 'rep' => $rep));
    }

    public function princeAction($nomUtilisateur){
        $em = $this->getDoctrine()->getManager();
        $partie = $em->getRepository('WEBLoveLetterBundle:partie')->find(1);
        $manche = $partie->getManche(10);
        $utilisateur = $em->getRepository('WEBLoveLetterBundle:utilisateur')->find($this->getUser());
        if ($utilisateur->getUsername() != $nomUtilisateur){
            $user = $utilisateur;
            $utilisateur = $manche->getOther($user);
        }
        $pioche = $manche->getPioche();

        $main = $utilisateur->getMain();
        $carteSuppr = $main->getCarte(0);
        if ($carteSuppr != null){
            $main->removeCarte($carteSuppr);
        }
        $nomCarte = "default";
        $em->persist($main);
        $em->flush();

        $nomCarteSuppr = $carteSuppr->getNom();
        $nb = rand(1, 8);
        if ($pioche->getNbElements() != 0) {
            while ($pioche->getCategorie($nb) == null) {
                $nb = rand(1, 8);
            }
            $carte = $pioche->getCategorie($nb);
            $nomCarte = $carte->getNom();
            $pioche->removeCarte($carte);
            $main->addCarte($carte);
        }
        $em->persist($main);
        $em->persist($pioche);
        $em->flush();
        $rep = true;
        $response = new JsonResponse();
        return $response->setData(array('card' => "prince", 'repPrince' => $rep, 'nouvelleCarte' => $nomCarte, 'ancienneCarte' => $nomCarteSuppr, 'user' => $utilisateur->getUsername()));
    }
}