<?php
//** @var array $category *//
function h(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Sua Category</title></head>
<body>
    <h1>Sua #<?= (int) $category['id'] ?></h1>
    <form method="post">
        <input name="name" value="<?= h($category['name']) ?>" required>
        <input name="description" value="<?= h((string) ($category['description'] ?? '')) ?>">
        <button>Cap nhat</button>
    </form>
</body>
</html>