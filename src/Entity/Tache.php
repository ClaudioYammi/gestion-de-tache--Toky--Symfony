<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TacheRepository::class)
 */
class Tache
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=ListeTache::class, inversedBy="tache", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $nom_tache;

    /**
     * @ORM\Column(type="time")
     */
    private $debut;

    /**
     * @ORM\Column(type="time")
     */
    private $fin;

    /**
     * @ORM\OneToOne(targetEntity=Employer::class, inversedBy="tache", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $nom_employer;

    /**
     * @ORM\Column(type="date")
     */
    private $date_ajout;

    public function __construct()
    {
        $this->date_ajout = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTache(): ?ListeTache
    {
        return $this->nom_tache;
    }

    public function setNomTache(ListeTache $nom_tache): self
    {
        $this->nom_tache = $nom_tache;

        return $this;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

        return $this;
    }

    public function getNomEmployer(): ?Employer
    {
        return $this->nom_employer;
    }

    public function setNomEmployer(Employer $nom_employer): self
    {
        $this->nom_employer = $nom_employer;

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
    
}
