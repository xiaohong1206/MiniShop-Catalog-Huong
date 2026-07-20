<?php

declare(strict_types=1);

class Category
{
    public function __construct(
        public int $id,
        public string $name,
        public string $description = ''
    ) {}

    public function label(): string
    {
        return "[{$this->id}] {$this->name}";
    }
}