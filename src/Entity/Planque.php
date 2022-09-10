<?php

namespace App\Entity;

use App\Repository\PlanqueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanqueRepository::class)]
class Planque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code_planque = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $pays = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $type_planque = null;

    #[ORM\ManyToOne(inversedBy: 'planques')]
    private ?Mission $Mission = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodePlanque(): ?string
    {
        return $this->code_planque;
    }

    public function setCodePlanque(string $code_planque): self
    {
        $this->code_planque = $code_planque;

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

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getTypePlanque(): ?string
    {
        return $this->type_planque;
    }

    public function setTypePlanque(string $type_planque): self
    {
        $this->type_planque = $type_planque;

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
}
