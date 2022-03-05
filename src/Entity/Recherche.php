<?php

namespace App\Entity;

use App\Repository\RechercheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RechercheRepository::class)
 */
class Recherche
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $mediaContact;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observations;

    /**
     * @ORM\OneToMany(targetEntity=EtatRecherche::class, mappedBy="recherche")
     */
    private $etatsRecherche;

    /**
     * @ORM\ManyToOne(targetEntity=Employe::class, inversedBy="recherches")
     */
    private $employe;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="recherches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;

    /**
     * @ORM\ManyToOne(targetEntity=Etudiant::class, inversedBy="recherches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etudiant;

    /**
     * @ORM\OneToOne(targetEntity=Stage::class, inversedBy="recherche", cascade={"persist", "remove"})
     */
    private $stage;

    public function __construct()
    {
        $this->etatsRecherche = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMediaContact(): ?string
    {
        return $this->mediaContact;
    }

    public function setMediaContact(string $mediaContact): self
    {
        $this->mediaContact = $mediaContact;

        return $this;
    }

    public function getObservations(): ?string
    {
        return $this->observations;
    }

    public function setObservations(?string $observations): self
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * @return Collection<int, EtatRecherche>
     */
    public function getEtatsRecherche(): Collection
    {
        return $this->etatsRecherche;
    }

    public function addEtatRecherche(EtatRecherche $etatRecherche): self
    {
        if (!$this->etatsRecherche->contains($etatRecherche)) {
            $this->etatsRecherche[] = $etatRecherche;
            $etatRecherche->setRecherche($this);
        }

        return $this;
    }

    public function removeEtatRecherche(EtatRecherche $etatRecherche): self
    {
        if ($this->etatsRecherche->removeElement($etatRecherche)) {
            // set the owning side to null (unless already changed)
            if ($etatRecherche->getRecherche() === $this) {
                $etatRecherche->setRecherche(null);
            }
        }

        return $this;
    }

    public function getEmploye(): ?Employe
    {
        return $this->employe;
    }

    public function setEmploye(?Employe $employe): self
    {
        $this->employe = $employe;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getStage(): ?Stage
    {
        return $this->stage;
    }

    public function setStage(?Stage $stage): self
    {
        $this->stage = $stage;

        return $this;
    }
}
