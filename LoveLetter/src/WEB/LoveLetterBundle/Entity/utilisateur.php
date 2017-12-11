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
     * @ORM\OneToOne(targetEntity="WEB\LoveLetterBundle\Entity\main")
     */
    private $main;

    /**
     * @ORM\OneToOne(targetEntity="WEB\LoveLetterBundle\Entity\plateau")
     */
    private $plateau;

    /**
     * @var integer
     *
     * @ORM\Column(name="point", type="integer", nullable=true)
     */
    private $point;

    /**
     * @var integer
     *
     * @ORM\Column(name="immunite", type="integer", nullable=true)
     */
    private $immunite;


    public function setImmunite($i){
        $this->immunite = $i;
        return $this;
    }

    public function getImmunite(){
        return $this->immunite;
    }

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

    public function getPoint()
    {
        return $this->point;
    }

    public function resetPoint()
    {
        $this->point = 0;
        return $this;
    }

    public function setPoint($point)
    {
        $this->point = $point;
    }

    public function setMain($main){
        $this->main = $main;
    }

    public function getMain()
    {
        return $this->main;
    }

    public function setPlateau($plateau){
        $this->plateau = $plateau;
    }

    public function getPlateau(){
        return $this->plateau;
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