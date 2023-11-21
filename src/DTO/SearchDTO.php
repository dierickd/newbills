<?php

namespace App\DTO;

class SearchDTO
{
    public ?string $search = null;
    public ?bool $closed = null;
    public ?bool $archived = null;
    public ?bool $active = null;
}