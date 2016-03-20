<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Musee
 *
 * @ORM\Table(name="musee")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MuseeRepository")
 */
class Musee
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var array
     *
     * @ORM\Column(name="coordonnees", type="json_array")
     */
    private $coordonnees;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="codePostal", type="string", length=255)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="siteWeb", type="string", length=255)
     */
    private $siteWeb;

    /**
     * @var bool
     *
     * @ORM\Column(name="statut", type="boolean")
     */
    private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="reouverture", type="string", length=255)
     */
    private $reouverture;

    /**
     * @var string
     *
     * @ORM\Column(name="fermetureAnnuelle", type="string", length=255)
     */
    private $fermetureAnnuelle;

    /**
     * @var string
     *
     * @ORM\Column(name="periodesOuverture", type="text")
     */
    private $periodesOuverture;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="musee")
     */
    private $comments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Musee
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set coordonnees
     *
     * @param array $coordonnees
     *
     * @return Musee
     */
    public function setCoordonnees($coordonnees)
    {
        $this->coordonnees = $coordonnees;

        return $this;
    }

    /**
     * Get coordonnees
     *
     * @return array
     */
    public function getCoordonnees()
    {
        return $this->coordonnees;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Musee
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return Musee
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Musee
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set siteWeb
     *
     * @param string $siteWeb
     *
     * @return Musee
     */
    public function setSiteWeb($siteWeb)
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    /**
     * Get siteWeb
     *
     * @return string
     */
    public function getSiteWeb()
    {
        return $this->siteWeb;
    }

    /**
     * Set statut
     *
     * @param boolean $statut
     *
     * @return Musee
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return bool
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set reouverture
     *
     * @param string $reouverture
     *
     * @return Musee
     */
    public function setReouverture($reouverture)
    {
        $this->reouverture = $reouverture;

        return $this;
    }

    /**
     * Get reouverture
     *
     * @return string
     */
    public function getReouverture()
    {
        return $this->reouverture;
    }

    /**
     * Set fermetureAnnuelle
     *
     * @param string $fermetureAnnuelle
     *
     * @return Musee
     */
    public function setFermetureAnnuelle($fermetureAnnuelle)
    {
        $this->fermetureAnnuelle = $fermetureAnnuelle;

        return $this;
    }

    /**
     * Get fermetureAnnuelle
     *
     * @return string
     */
    public function getFermetureAnnuelle()
    {
        return $this->fermetureAnnuelle;
    }

    /**
     * Set periodesOuverture
     *
     * @param string $periodesOuverture
     *
     * @return Musee
     */
    public function setPeriodesOuverture($periodesOuverture)
    {
        $this->periodesOuverture = $periodesOuverture;

        return $this;
    }

    /**
     * Get periodesOuverture
     *
     * @return string
     */
    public function getPeriodesOuverture()
    {
        return $this->periodesOuverture;
    }

    /**
     * Add comment
     *
     * @param \AppBundle\Entity\Comment $comment
     *
     * @return Musee
     */
    public function addComment(Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \AppBundle\Entity\Comment $comment
     */
    public function removeComment(Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}
