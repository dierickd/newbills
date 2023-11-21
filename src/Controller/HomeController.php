<?php

namespace App\Controller;

use App\DTO\SearchDTO;
use App\Repository\ProjectRepository;
use App\Services\Constants;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(#[MapQueryString()] ?SearchDTO $searchDto = null): Response
    {
        return $this->render('home/index.html.twig', [
            'STATUS' => Constants::getStatus(),
            'searchDto' => $searchDto
        ]);
    }
}
