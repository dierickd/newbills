<?php

namespace App\Twig\Components;

use App\DTO\SearchDTO;
use App\Repository\ProjectRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent()]
final class ProjectCards
{
    use DefaultActionTrait;

    public ?SearchDTO $searchDto = null;
    public Request $request;
    public PaginationInterface $pagination;

    public function __construct(private readonly ProjectRepository $projectRepository, private readonly PaginatorInterface $paginator)
    {
    }

    public function getProjects(): PaginationInterface
    {
        $query = $this->projectRepository->search($this->searchDto);
        $this->pagination = $this->paginator->paginate(
            $query,
            $this->request->query->getInt('page', 1),
            10
        );
        return $this->pagination;
    }
}
