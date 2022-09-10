<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MissionRepository::class)]
class Mission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $titre_mission = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_mission = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_code = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $pays = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $type_mission = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $statut_mission = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date_debut = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date_fin = null;

    #[ORM\OneToMany(mappedBy: 'Mission', targetEntity: Agent::class)]
    private Collection $agents;

    #[ORM\OneToMany(mappedBy: 'Mission', targetEntity: Cible::class)]
    private Collection $cibles;

    #[ORM\OneToMany(mappedBy: 'Mission', targetEntity: Contact::class)]
    private Collection $contacts;

    #[ORM\OneToMany(mappedBy: 'Mission', targetEntity: Planque::class)]
    private Collection $planques;

    public function __construct()
    {
        $this->agents = new ArrayCollection();
        $this->cibles = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->planques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreMission(): ?string
    {
        return $this->titre_mission;
    }

    public function setTitreMission(string $titre_mission): self
    {
        $this->titre_mission = $titre_mission;

        return $this;
    }

    public function getDescriptionMission(): ?string
    {
        return $this->description_mission;
    }

    public function setDescriptionMission(string $description_mission): self
    {
        $this->description_mission = $description_mission;

        return $this;
    }

    public function getNomCode(): ?string
    {
        return $this->nom_code;
    }

    public function setNomCode(string $nom_code): self
    {
        $this->nom_code = $nom_code;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getTypeMission(): ?string
    {
        return $this->type_mission;
    }

    public function setTypeMission(string $type_mission): self
    {
        $this->type_mission = $type_mission;

        return $this;
    }

    public function getStatutMission(): ?string
    {
        return $this->statut_mission;
    }

    public function setStatutMission(string $statut_mission): self
    {
        $this->statut_mission = $statut_mission;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeImmutable
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeImmutable $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeImmutable
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeImmutable $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    /**
     * @return Collection<int, Agent>
     */
    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgent(Agent $agent): self
    {
        if (!$this->agents->contains($agent)) {
            $this->agents->add($agent);
            $agent->setMission($this);
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self
    {
        if ($this->agents->removeElement($agent)) {
            // set the owning side to null (unless already changed)
            if ($agent->getMission() === $this) {
                $agent->setMission(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Cible>
     */
    public function getCibles(): Collection
    {
        return $this->cibles;
    }

    public function addCible(Cible $cible): self
    {
        if (!$this->cibles->contains($cible)) {
            $this->cibles->add($cible);
            $cible->setMission($this);
        }

        return $this;
    }

    public function removeCible(Cible $cible): self
    {
        if ($this->cibles->removeElement($cible)) {
            // set the owning side to null (unless already changed)
            if ($cible->getMission() === $this) {
                $cible->setMission(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts->add($contact);
            $contact->setMission($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getMission() === $this) {
                $contact->setMission(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Planque>
     */
    public function getPlanques(): Collection
    {
        return $this->planques;
    }

    public function addPlanque(Planque $planque): self
    {
        if (!$this->planques->contains($planque)) {
            $this->planques->add($planque);
            $planque->setMission($this);
        }

        return $this;
    }

    public function removePlanque(Planque $planque): self
    {
        if ($this->planques->removeElement($planque)) {
            // set the owning side to null (unless already changed)
            if ($planque->getMission() === $this) {
                $planque->setMission(null);
            }
        }

        return $this;
    }
}
