<?php

namespace WEB\LoveLetterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * manche
 *
 * @ORM\Table(name="manche")
 * @ORM\Entity(repositoryClass="WEB\LoveLetterBundle\Repository\mancheRepository")
 */
class manche
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
     * @ORM\Column(name="id_manche", type="integer", unique=true)
     */
    private $idManche;

    /**
     * @var int
     *
     * @ORM\Column(name="id_defausse", type="integer")
     */
    private $idDefausse;

    /**
     * @var int
     *
     * @ORM\Column(name="id_partie", type="integer")
     */
    private $idPartie;

    /**
     * @var int
     *
     * @ORM\Column(name="id_pioche", type="integer")
     */
    private $idPioche;

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
     * Set idManche
     *
     * @param integer $idManche
     *
     * @return manche
     */
    public function setIdManche($idManche)
    {
        $this->idManche = $idManche;

        return $this;
    }

    /**
     * Get idManche
     *
     * @return int
     */
    public function getIdManche()
    {
        return $this->idManche;
    }

    /**
     * Set idDefausse
     *
     * @param integer $idDefausse
     *
     * @return manche
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

    /**
     * Set idPartie
     *
     * @param integer $idPartie
     *
     * @return manche
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
     * Set idPioche
     *
     * @param integer $idPioche
     *
     * @return manche
     */
    public function setIdPioche($idPioche)
    {
        $this->idPioche = $idPioche;

        return $this;
    }

    /**
     * Get idPioche
     *
     * @return int
     */
    public function getIdPioche()
    {
        return $this->idPioche;
    }

    /**
     * Set gagnant
     *
     * @param string $gagnant
     *
     * @return manche
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

