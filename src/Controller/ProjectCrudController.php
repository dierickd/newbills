<?php

namespace App\Controller;

use App\DTO\SearchDTO;
use App\Entity\Feature;
use App\Entity\Project;
use App\Form\FeatureType;
use App\Form\ProjectType;
use App\Repository\CategoryRepository;
use App\Repository\FeatureRepository;
use App\Repository\ProjectRepository;
use App\Services\Constants;
use App\Services\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/project')]
class ProjectCrudController extends AbstractController
{
    #[Route('/', name: 'app_project_crud_index', methods: ['GET'])]
    public function index(ProjectRepository $projectRepository, Request $request, #[MapQueryString()] ?SearchDTO $searchDto = null): Response
    {
        return $this->render('crud/project/index.html.twig', [
            'projects' => $projectRepository->findAll(),
            'STATUS' => Constants::getStatus(),
            'searchDto' => $searchDto,
            'request' => $request
        ]);
    }

    #[Route('/{slug}/{select<\d+>}', name: 'app_project_crud_selected', methods: ['GET'])]
    public function selected(string $select, Project $project, EntityManagerInterface $entityManager): Response
    {
        $project->setSelected($select);
        $entityManager->persist($project);
        $entityManager->flush();

        return $this->redirectToRoute('app_project_crud_show', ['slug' => $project->getSlug()], Response::HTTP_SEE_OTHER);
    }

    #[Route('/new', name: 'app_project_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $project->setCreatedAt(new \DateTimeImmutable());
            $project->setStatus(1);
            $project->setExpert(0);
            $project->setConfirmed(100);
            $project->setJunior(0);
            $project->setSelected(1);
            $project->setSlug(Slugify::generate($form['name']->getData()));

            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('app_project_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('crud/project/new.html.twig', [
            'project' => $project,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_project_crud_show', methods: ['GET', 'POST'])]
    public function show(Request $request, Project $project): Response
    {
        $featureProject = new Feature();

        $form = $this->createForm(FeatureType::class, $featureProject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump("Hello");
        }

        return $this->render('crud/project/show.html.twig', [
            'project' => $project,
            'modalStatus' => Constants::getStatusName($project->getStatus()),
            'form' => $form,
        ]);
    }

    #[Route('/{slug}/edit', name: 'app_project_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Project $project, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_project_crud_show', ['slug' => $project->getSlug()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('crud/project/edit.html.twig', [
            'project' => $project,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_project_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Project $project, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $project->getId(), $request->request->get('_token'))) {
            $entityManager->remove($project);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_project_crud_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{action}/{slug}', name: 'app_project_crud_status', requirements: ['action' => 'active|closed|archived'])]
    public function reopen(string $action, Project $project, EntityManagerInterface $entityManager): Response
    {
        $project->setStatus(Constants::getStatusChange($action));
        $entityManager->persist($project);
        $entityManager->flush();

        return $this->redirectToRoute('app_project_crud_show', ['slug' => $project->getSlug()], Response::HTTP_SEE_OTHER);
    }
}
