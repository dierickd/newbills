<?php

namespace App\Twig\Components;

use App\DTO\SearchDTO;
use App\Repository\ProjectRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent()]
final class ProjectCards
{
    use DefaultActionTrait;

    public ?SearchDTO $searchDto = null;

    public function __construct(private readonly ProjectRepository $projectRepository)
    {
    }

    public function getProjects(): array
    {
        return $this->projectRepository->search($this->searchDto);
    }
}
