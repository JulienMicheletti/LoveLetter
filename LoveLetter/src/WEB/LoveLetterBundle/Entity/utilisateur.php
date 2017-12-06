<?php

namespace WEB\LoveLetterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="WEB\LoveLetterBundle\Repository\utilisateurRepository")
 */
class utilisateur extends BaseUser
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_win", type="integer", nullable=true)
     */
    private $nbWin;

    /**
     * @var integer
     *
     * @ORM\Column(name="victoire", type="integer", nullable=true)
     */
    private $victoire;

    /**
     * @ORM\OneToOne(targetEntity="WEB\LoveLetterBundle\Entity\pioche")
     */
    private $pioche;

    /**
     * @ORM\OneToOne(targetEntity="WEB\LoveLetterBundle\Entity\main")
     */
    private $main;

    /**
     * @ORM\OneToOne(targetEntity="WEB\LoveLetterBundle\Entity\defausse")
     */
    private $defausse;

    /**
     * Get nbWin
     *
     * @return int
     */
    public function getNbWin()
    {
        return $this->nbWin;
    }

    public function setNbWin($nbWin)
    {
        $this->nbWin = $nbWin;
        return $this;
    }

    public function setMain($main){
        $this->main = $main;
    }

    public function getPioche()
    {
        return $this->pioche;
    }

    public function getMain()
    {
        return $this->main;
    }

    public function getDefausse()
    {
        return $this->defausse;
    }

    public function setVictoire($var)
    {
        $this->victoire = $var;
    }

    public function getVictoire()
    {
        return $this->victoire;
    }
}