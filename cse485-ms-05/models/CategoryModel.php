<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

class CategoryModel
{
    public function all(): array
    {
        $stmt = db()->query('SELECT * FROM categories ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = db()->prepare('SELECT * FROM categories WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(string $name, ?string $description): int
    {
        $stmt = db()->prepare('INSERT INTO categories (name, description) VALUES (?, ?)');
        $stmt->execute([$name, $description]);
        return (int) db()->lastInsertId();
    }

    public function update(int $id, string $name, ?string $description): bool
    {
        $stmt = db()->prepare('UPDATE categories SET name = ?, description = ? WHERE id = ?');
        return $stmt->execute([$name, $description, $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = db()->prepare('DELETE FROM categories WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
