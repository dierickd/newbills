<?php

namespace App\Entity;

use App\Repository\ProjectFeatureRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProjectFeatureRepository::class)]
class ProjectFeature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank()]
    private ?int $project_id = null;

    #[ORM\Column]
    #[Assert\NotBlank()]
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
