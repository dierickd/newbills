<?php

namespace App\Entity;

use App\Repository\ProjectsFeaturesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectsFeaturesRepository::class)]
class ProjectsFeatures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $project_id = null;

    #[ORM\Column]
    private ?int $feature_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjectId(): ?int
    {
        return $this->project_id;
    }

    public function setProjectId(int $project_id): static
    {
        $this->project_id = $project_id;

        return $this;
    }

    public function getFeatureId(): ?int
    {
        return $this->feature_id;
    }

    public function setFeatureId(int $feature_id): static
    {
        $this->feature_id = $feature_id;

        return $this;
    }
}
