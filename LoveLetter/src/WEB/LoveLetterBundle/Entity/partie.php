<?php

namespace WEB\LoveLetterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * partie
 *
 * @ORM\Table(name="partie")
 * @ORM\Entity(repositoryClass="WEB\LoveLetterBundle\Repository\partieRepository")
 */
class partie
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_joueurs", type="integer")
     */
    private $nbJoueurs;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_manches", type="integer")
     */
    private $nbManches;

    /**
     * @var string
     *
     * @ORM\Column(name="gagnant", type="string", length=200, unique=true)
     */
    private $gagnant;

    /**
     * @ORM\ManyToMany(targetEntity="WEB\LoveLetterBundle\Entity\manche", cascade={"persist"})
     */
    private $manches;

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return partie
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get idCarte
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
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

    /**
     * Set nbManches
     *
     * @param integer $nb
     *
     * @return partie
     */
    public function setnbManches($nb)
    {
        $this->nbManches = $nb;

        return $this;
    }

    /**
     * Get nbJoueurs
     *
     * @return integer
     */
    public function getnbJoueurs()
    {
        return $this->nbJoueurs;
    }

    /**
     * Set nbJoueurs
     *
     * @param integer $nb
     *
     * @return partie
     */
    public function setnbJoueurs($nb)
    {
        $this->nbJoueurs = $nb;

        return $this;
    }

    /**
     * Get nbManches
     *
     * @return integer
     */
    public function getnbManches()
    {
        return $this->nbManches;
    }

    public function __construct()
    {
        $this->manches = new ArrayCollection();
    }

    // Notez le singulier, on ajoute une seule catégorie à la fois
    public function addManche(Manche $manche)
    {
        // Ici, on utilise l'ArrayCollection vraiment comme un tableau
        $this->manches[] = $manche;

        return $this;
    }

    public function getNbElements(){
        $i = 0;
        foreach ($this->manches as $manche) {
            $i++;
        }
        return $i;
    }

    public function removeCarte(Manche $manche)
    {
        // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la catégorie en argument
        $this->manches->removeElement($manche);
    }

    public function getManche($i){
        foreach ($this->manches as $manche) {
        if ($manche->getId() == $i){
            return $manche;
        }
    }
        return null;
    }

    public function getManches()
    {
        return $this->manches;
    }

}