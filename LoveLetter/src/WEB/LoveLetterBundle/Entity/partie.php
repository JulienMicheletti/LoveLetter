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
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="idPartie", type="integer", unique=true)
     */
    private $idPartie;

    /**
     * @var int
     *
     * @ORM\Column(name="nbJoueurs", type="integer")
     */
    private $nbJoueurs;

    /**
     * @var int
     *
     * @ORM\Column(name="nbManche", type="integer")
     */
    private $nbManche;

    /**
     * @var string
     *
     * @ORM\Column(name="gagnant", type="string", length=255, nullable=true)
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
     * Set nbJoueurs
     *
     * @param integer $nbJoueurs
     *
     * @return partie
     */
    public function setNbJoueurs($nbJoueurs)
    {
        $this->nbJoueurs = $nbJoueurs;

        return $this;
    }

    /**
     * Get nbJoueurs
     *
     * @return int
     */
    public function getNbJoueurs()
    {
        return $this->nbJoueurs;
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

