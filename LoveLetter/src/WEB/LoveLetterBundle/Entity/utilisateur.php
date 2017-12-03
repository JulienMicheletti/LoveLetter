<?php

namespace WEB\LoveLetterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

/**
 * utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="WEB\LoveLetterBundle\Repository\utilisateurRepository")
 */
class utilisateur
{
    /**
     * @ORM\Column(name="id", type="string", length=200)
     * @ORM\Id
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(name="mod_de_passe", type="string", length=200)
     */
    private $mot_de_passe;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_win", type="integer")
     */
    private $nbWin;

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
     * Get pseudo
     *
     * @return int
     */
    public function getPseudo()
    {
        return $this->id;
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

    public function __toString(){
        return $this->id;
    }
}