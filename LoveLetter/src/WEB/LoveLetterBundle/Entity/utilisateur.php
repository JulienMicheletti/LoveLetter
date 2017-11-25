<?php

namespace WEB\LoveLetterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="WEB\LoveLetterBundle\Repository\utilisateurRepository")
 */
class utilisateur
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="pseudo", type="string", length=20, unique=true)
     */
    private $pseudo;

    /**
     * @var int
     *
     * @ORM\Column(name="mdp", type="integer")
     */
    private $mdp;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_win", type="integer")
     */
    private $nbWin;

    /**
     * @var int
     *
     * @ORM\Column(name="id_main", type="integer", nullable=true)
     */
    private $idMain;

    /**
     * @var int
     *
     * @ORM\Column(name="id_defausse", type="integer")
     */
    private $idDefausse;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return utilisateur
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set mdp
     *
     * @param integer $mdp
     *
     * @return utilisateur
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return int
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set nbWin
     *
     * @param integer $nbWin
     *
     * @return utilisateur
     */
    public function setNbWin($nbWin)
    {
        $this->nbWin = $nbWin;

        return $this;
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

    /**
     * Set idMain
     *
     * @param integer $idMain
     *
     * @return utilisateur
     */
    public function setIdMain($idMain)
    {
        $this->idMain = $idMain;

        return $this;
    }

    /**
     * Get idMain
     *
     * @return int
     */
    public function getIdMain()
    {
        return $this->idMain;
    }

    /**
     * Set idDefausse
     *
     * @param integer $idDefausse
     *
     * @return utilisateur
     */
    public function setIdDefausse($idDefausse)
    {
        $this->idDefausse = $idDefausse;

        return $this;
    }

    /**
     * Get idDefausse
     *
     * @return int
     */
    public function getIdDefausse()
    {
        return $this->idDefausse;
    }
}

