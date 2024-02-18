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
            'description' => 'Comporte toutes les fonctionnalités souhaitées par le client'
        ],
        [
            'id' => 2,
            'name' => 'middle',
            'description' => 'Comporte les fonctionnalités optionnelles d\'optimisation'
        ],
        [
            'id' => 3,
            'name' => 'low',
            'description' => 'Comporte les fonctionnalités minimum fonctionnelle'
        ],
    ];

    public function levelProject(): array
    {
        return self::LEVEL;
    }
}
