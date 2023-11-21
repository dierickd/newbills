<?php

namespace App\Twig\Components;

use App\DTO\SearchDTO;
use App\Form\MainSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent()]
final class MainSearch extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp]
    public ?SearchDTO $searchDto = null;

    protected function instantiateForm(): FormInterface
    {
        // we can extend AbstractController to get the normal shortcuts
        return $this->createForm(MainSearchType::class, $this->searchDto);
    }

    #[LiveAction]
    public function save(): RedirectResponse
    {
        $this->submitForm();
        /** @var SearchDTO $searchDto */
        $this->searchDto = $this->getForm()->getData();

        $params = ['search' => $this->searchDto->search];
        if ($this->searchDto->closed) $params['closed'] = $this->searchDto->closed;
        if ($this->searchDto->archived) $params['archived'] = $this->searchDto->archived;
        if ($this->searchDto->active) $params['active'] = $this->searchDto->active;
        return $this->redirectToRoute('app_project_list', $params);
    }
}
