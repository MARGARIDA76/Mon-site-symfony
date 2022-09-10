<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgentRepository::class)]
class Agent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date_naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $code_identification = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $nationalite = null;

    #[ORM\ManyToOne(inversedBy: 'agents')]
    private ?Mission $Mission = null;

    #[ORM\OneToMany(mappedBy: 'Agent', targetEntity: Specialite::class)]
    private Collection $specialites;

    public function __construct()
    {
        $this->specialites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
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

    public function getDateNaissance(): ?\DateTimeImmutable
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeImmutable $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getCodeIdentification(): ?string
    {
        return $this->code_identification;
    }

    public function setCodeIdentification(string $code_identification): self
    {
        $this->code_identification = $code_identification;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getMission(): ?Mission
    {
        return $this->Mission;
    }

    public function setMission(?Mission $Mission): self
    {
        $this->Mission = $Mission;

        return $this;
    }

    /**
     * @return Collection<int, Specialite>
     */
    public function getSpecialites(): Collection
    {
        return $this->specialites;
    }

    public function addSpecialite(Specialite $specialite): self
    {
        if (!$this->specialites->contains($specialite)) {
            $this->specialites->add($specialite);
            $specialite->setAgent($this);
        }

        return $this;
    }

    public function removeSpecialite(Specialite $specialite): self
    {
        if ($this->specialites->removeElement($specialite)) {
            // set the owning side to null (unless already changed)
            if ($specialite->getAgent() === $this) {
                $specialite->setAgent(null);
            }
        }

        return $this;
    }
}
