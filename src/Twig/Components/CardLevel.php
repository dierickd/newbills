<?php

namespace App\Twig\Components;

use App\Entity\Project;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent()]
final class CardLevel
{
    use DefaultActionTrait;

    public Project $project;
    public const LEVEL = [
        [
            'id' => 1,
            'name' => 'high',
            'description' => 'Comporte toutes les fonctionnalitées souhaitez par le client'
        ],
        [
            'id' => 2,
            'name' => 'middle',
            'description' => 'Comporte les fonctionnalitées optionnelles d\'optimisation'
        ],
        [
            'id' => 3,
            'name' => 'low',
            'description' => 'Comporte les fonctionnalitées minimum fonctionnelle'
        ],
    ];

    public function levelProject(): array
    {
        return self::LEVEL;
    }
}
