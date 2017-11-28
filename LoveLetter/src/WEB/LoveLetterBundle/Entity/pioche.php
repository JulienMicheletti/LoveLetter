<?php

namespace WEB\LoveLetterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Tests\Constraints\CardSchemeValidatorTest;

/**
 * pioche
 *
 * @ORM\Table(name="pioche")
 * @ORM\Entity(repositoryClass="WEB\LoveLetterBundle\Repository\piocheRepository")
 */
class pioche
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", unique=true)
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="WEB\LoveLetterBundle\Entity\carte", cascade={"persist"})
     */
    private $cartes;

    // Comme la propriété $categories doit être un ArrayCollection,
    // On doit la définir dans un constructeur :
    public function __construct()
    {
        $this->cartes = new ArrayCollection();
    }

    // Notez le singulier, on ajoute une seule catégorie à la fois
    public function addCategory(Carte $carte)
    {
        // Ici, on utilise l'ArrayCollection vraiment comme un tableau
        $this->cartes[] = $carte;

        return $this;
    }

    public function getNbElements(){
        $i = 0;
        foreach ($this->cartes as $carte) {
            $i++;
        }
        return $i;
    }

    public function removeCarte(Carte $carte)
    {
        // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la catégorie en argument
        $this->cartes->removeElement($carte);
    }

    // Notez le pluriel, on récupère une liste de catégories ici !
    public function getCategorie($i){
        foreach ($this->cartes as $carte) {
            if ($carte->getId() == $i){
                return $carte;
            }
        }
        return null;

    }
    public function getCategories()
    {
        return $this->cartes;
    }
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
     * Set idCarte
     *
     * @param integer $idCarte
     *
     * @return carte
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}

