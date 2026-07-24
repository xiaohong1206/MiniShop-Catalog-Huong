<?php
//** @var array $categories *//
function h(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Categories</title>
</head>
<body>
    <h1>Danh muc</h1>
    <?php if (isset($_SESSION['flash'])): ?>

<p style="color:green;">

    <?= $_SESSION['flash'] ?>

</p>

<?php unset($_SESSION['flash']); ?>

<?php endif; ?>
    <p><a href="index.php?controller=category&action=create">+ Them moi</a></p>
    <table border="1" cellpadding="8">
        <tr><th>ID</th><th>Name</th><th>Mo ta</th><th></th></tr>
        <?php foreach ($categories as $row): ?>
            <tr>
                <td><?= (int) $row['id'] ?></td>
                <td><?= h($row['name']) ?></td>
                <td><?= h((string) ($row['description'] ?? '')) ?></td>
                <td>
                    <a href="index.php?controller=category&action=edit&id=<?= (int) $row['id'] ?>">Sua</a>
                    |
                    <form
    method="post"
    action="index.php?controller=category&action=delete"
    style="display:inline;"
    onsubmit="return confirm('Bạn có chắc muốn xóa?');"
>

    <input
        type="hidden"
        name="id"
        value="<?= (int)$row['id'] ?>">

    <button type="submit">
        Xóa
    </button>

</form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
