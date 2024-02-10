<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $status = null;

    #[ORM\Column]
    private ?int $expert = null;

    #[ORM\Column]
    private ?int $confirmed = null;

    #[ORM\Column]
    private ?int $junior = null;

    #[ORM\Column]
    private ?int $selected = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Application $application = null;

    #[ORM\ManyToMany(targetEntity: Feature::class, inversedBy: 'projects')]
    private Collection $featureProject;

    public function __construct()
    {
        $this->featureProject = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getExpert(): ?int
    {
        return $this->expert;
    }

    public function setExpert(int $expert): static
    {
        $this->expert = $expert;

        return $this;
    }

    public function getConfirmed(): ?int
    {
        return $this->confirmed;
    }

    public function setConfirmed(int $confirmed): static
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    public function getJunior(): ?int
    {
        return $this->junior;
    }

    public function setJunior(int $junior): static
    {
        $this->junior = $junior;

        return $this;
    }

    public function getSelected(): ?int
    {
        return $this->selected;
    }

    public function setSelected(int $selected): static
    {
        $this->selected = $selected;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getApplication(): ?Application
    {
        return $this->application;
    }

    public function setApplication(?Application $application): static
    {
        $this->application = $application;

        return $this;
    }

    /**
     * @return Collection<int, Feature>
     */
    public function getFeatureProject(): Collection
    {
        return $this->featureProject;
    }

    public function addFeatureProject(Feature $featureProject): static
    {
        if (!$this->featureProject->contains($featureProject)) {
            $this->featureProject->add($featureProject);
        }

        return $this;
    }

    public function removeFeatureProject(Feature $featureProject): static
    {
        $this->featureProject->removeElement($featureProject);

        return $this;
    }
}
