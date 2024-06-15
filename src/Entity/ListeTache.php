<?php

namespace App\Entity;

use App\Repository\ListeTacheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListeTacheRepository::class)
 */
class ListeTache
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_tache;

    /**
     * @ORM\Column(type="date")
     */
    private $date_ajout;

    /**
     * @ORM\OneToOne(targetEntity=Tache::class, mappedBy="nom_tache", cascade={"persist", "remove"})
     */
    private $tache;
    
    public function __construct()
    {
        $this->date_ajout = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTache(): ?string
    {
        return $this->nom_tache;
    }

    public function setNomTache(string $nom_tache): self
    {
        $this->nom_tache = $nom_tache;

        return $this;
    }

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->date_ajout;
    }

    public function setDateAjout(\DateTimeInterface $date_ajout): self
    {
        $this->date_ajout = $date_ajout;

        return $this;
    }

    public function getTache(): ?Tache
    {
        return $this->tache;
    }

    public function setTache(Tache $tache): self
    {
        // set the owning side of the relation if necessary
        if ($tache->getNomTache() !== $this) {
            $tache->setNomTache($this);
        }

        $this->tache = $tache;

        return $this;
    }

    public function __toString(){
        return $this->nom_tache; // Remplacer champ par une propriété "string" de l'entité
    }
}
