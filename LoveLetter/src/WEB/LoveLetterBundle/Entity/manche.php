<?php

namespace WEB\LoveLetterBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

/**
 * manche
 *
 * @ORM\Table(name="manche")
 * @ORM\Entity(repositoryClass="WEB\LoveLetterBundle\Repository\mancheRepository")
 */
class manche
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="WEB\LoveLetterBundle\Entity\utilisateur")
     * @ORM\Column(name="gagnant", type="string", length=200)
     */
    private $gagnant;

    /**
     * @ORM\OneToOne(targetEntity="WEB\LoveLetterBundle\Entity\defausse")
     */
    private $defausse;

    /**
     * @ORM\OneToOne(targetEntity="WEB\LoveLetterBundle\Entity\pioche")
     */
    private $pioche;

    /**
     * @ORM\ManyToMany(targetEntity="WEB\LoveLetterBundle\Entity\utilisateur", cascade={"persist"})
     */
    private $utilisateur;

    // Comme la propriété $categories doit être un ArrayCollection,
    // On doit la définir dans un constructeur :
    public function __construct()
    {
       $this->utilisateur = new ArrayCollection();
    }

    // Notez le singulier, on ajoute une seule catégorie à la fois
    public function addUtilisateur(Utilisateur $user)
    {
        // Ici, on utilise l'ArrayCollection vraiment comme un tableau
        $this->utilisateur[] = $user;

        return $this;
    }

    public function viderUtilisateur(){
        $this->utilisateur->clear();
    }

    // Notez le pluriel, on récupère une liste de catégories ici !
    public function getUtilisateur($i)
    {
        foreach ($this->utilisateur as $user) {
            if ($user->getId() == $i) {
                return $user;
            }
        }
        return null;
    }

    public function removeUtilisateur(Utilisateur $user)
    {
        // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la catégorie en argument
        $this->utilisateur->removeElement($user);
    }

    public function getnbUtilisateur(){
        return $this->utilisateur->count();
    }

    public function getUtilisateurs(){
        return $this->utilisateur;
    }

    public function getOther($id)
    {
        foreach ($this->utilisateur as $user) {
            if ($user->getUsername() != $id) {
                return $user;
            }
        }
        return null;
    }

    public function getUserByName($username){
        foreach ($this->utilisateur as $user){
            if ($user->getUsername() == $username){
                return $user;
            }
        }
        return null;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return manche
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
     * @return manche
     */
    public function setGagnant(Utilisateur $gagnant)
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

    public function setDefausse(defausse $defausse)
    {
        $this->defausse = $defausse;

        return $this;
    }

    public function getDefausse()
    {
        return $this->defausse;
    }

    public function setPioche(Pioche $pioche)
    {
        $this->pioche = $pioche;

        return $this;
    }

    public function getPioche()
    {
        return $this->pioche;
    }

    public function resetDefausse()
    {
        $this->defausse = null;
    }

    public function resetPioche()
    {
        $this->pioche = null;
    }
}
