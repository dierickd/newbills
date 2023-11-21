<?php

namespace App\Controller;

use App\DTO\SearchDTO;
use App\Repository\ProjectRepository;
use App\Services\Constants;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route('/project', name: 'app_project_list')]
    public function list(#[MapQueryString()] ?SearchDTO $searchDto = null): Response
    {
        return $this->render('project/list.html.twig', [
            'STATUS' => Constants::getStatus(),
            'searchDto' => $searchDto
        ]);
    }

    #[Route('/project/{slug}', name: 'app_project_detail')]
    public function detail(string $slug, ProjectRepository $projectRepository): Response
    {
        return $this->render('project/detail.html.twig', [
            'project' => $projectRepository->findOneBy(['slug' => $slug]),
        ]);
    }
}
