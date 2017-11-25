<?php

namespace WEB\LoveLetterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * partie
 *
 * @ORM\Table(name="partie")
 * @ORM\Entity(repositoryClass="WEB\LoveLetterBundle\Repository\partieRepository")
 */
class partie
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id_partie", type="integer", unique=true)
     */
    private $idPartie;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_joueur", type="integer")
     */
    private $nbJoueur;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_manche", type="integer")
     */
    private $nbManche;

    /**
     * @var string
     *
     * @ORM\Column(name="gagnant", type="string", length=20)
     */
    private $gagnant;


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
     * Set idPartie
     *
     * @param integer $idPartie
     *
     * @return partie
     */
    public function setIdPartie($idPartie)
    {
        $this->idPartie = $idPartie;

        return $this;
    }

    /**
     * Get idPartie
     *
     * @return int
     */
    public function getIdPartie()
    {
        return $this->idPartie;
    }

    /**
     * Set nbJoueur
     *
     * @param integer $nbJoueur
     *
     * @return partie
     */
    public function setNbJoueur($nbJoueur)
    {
        $this->nbJoueur = $nbJoueur;

        return $this;
    }

    /**
     * Get nbJoueur
     *
     * @return int
     */
    public function getNbJoueur()
    {
        return $this->nbJoueur;
    }

    /**
     * Set nbManche
     *
     * @param integer $nbManche
     *
     * @return partie
     */
    public function setNbManche($nbManche)
    {
        $this->nbManche = $nbManche;

        return $this;
    }

    /**
     * Get nbManche
     *
     * @return int
     */
    public function getNbManche()
    {
        return $this->nbManche;
    }

    /**
     * Set gagnant
     *
     * @param string $gagnant
     *
     * @return partie
     */
    public function setGagnant($gagnant)
    {
        $this->gagnant = $gagnant;

        return $this;
    }

    /**
     * Get gagnant
     *
     * @return string
     */
    public function getGagnant()
    {
        return $this->gagnant;
    }
}

