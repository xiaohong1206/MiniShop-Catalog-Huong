<?php

require_once __DIR__ . '/config.php';

$id = (int)($_POST['id'] ?? 0);

$stmt = db()->prepare('DELETE FROM categories WHERE id = ?');
$stmt->execute([$id]);

header('Location: categories.php');
exit;