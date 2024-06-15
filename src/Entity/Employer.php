<?php

namespace App\Entity;

use App\Repository\EmployerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployerRepository::class)
 */
class Employer
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
    private $nom_employer;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $Poste;

    /**
     * @ORM\Column(type="string", length=255,)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="date")
     */
    private $date_ajout;

    /**
     * @ORM\OneToOne(targetEntity=Tache::class, mappedBy="nom_employer", cascade={"persist", "remove"})
     */
    private $tache;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $prenom;

    public function __construct()
    {
        $this->date_ajout = new \DateTime('now');
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEmployer(): ?string
    {
        return $this->nom_employer;
    }

    public function setNomEmployer(string $nom_employer): self
    {
        $this->nom_employer = $nom_employer;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->Poste;
    }

    public function setPoste(string $Poste): self
    {
        $this->Poste = $Poste;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

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
        if ($tache->getNomEmployer() !== $this) {
            $tache->setNomEmployer($this);
        }

        $this->tache = $tache;

        return $this;
    }
    public function __toString(){
        return $this->nom_employer; // Remplacer champ par une propriété "string" de l'entité
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }
}
