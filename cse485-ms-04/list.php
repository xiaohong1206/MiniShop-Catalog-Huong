<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

$pdo = db();
$message = "";

/* ==========================
   CREATE
========================== */

if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["action"] ?? "") === "create") {

    $name = trim($_POST["name"] ?? "");
    $description = trim($_POST["description"] ?? "");

    // Validate tên
    if (strlen($name) < 2 || strlen($name) > 100) {

        $message = "Tên danh mục phải từ 2 đến 100 ký tự.";

    } else {

        try {

            $stmt = $pdo->prepare(
                "INSERT INTO categories(name, description)
                 VALUES(?, ?)"
            );

            $stmt->execute([
                $name,
                $description
            ]);

            // PRG
            header("Location: categories.php");
            exit;

        } catch (PDOException $e) {

            $message = "Tên danh mục đã tồn tại.";

        }

    }

}

/* ==========================
   READ
========================== */

$categories = $pdo
    ->query("SELECT * FROM categories ORDER BY id DESC")
    ->fetchAll();

/* ==========================
   ESCAPE HTML
========================== */

function h(string $text): string
{
    return htmlspecialchars($text, ENT_QUOTES, "UTF-8");
}

?>

<!DOCTYPE html>

<html lang="vi">

<head>

<meta charset="UTF-8">

<title>Categories CRUD</title>

</head>

<body>

<h1>Quản lý Categories</h1>

<?php if ($message): ?>

<p style="color:red">

    <?= h($message) ?>

</p>

<?php endif; ?>


<h2>Thêm mới</h2>

<form method="post">

<input
type="hidden"
name="action"
value="create">

<p>

Tên danh mục

<br>

<input
type="text"
name="name"
required>

</p>

<p>

Mô tả

<br>

<input
type="text"
name="description">

</p>

<button type="submit">

Thêm

</button>

</form>

<hr>

<h2>Danh sách</h2>

<table border="1" cellpadding="8">

<tr>

<th>ID</th>

<th>Name</th>

<th>Description</th>

<th>Created At</th>

<th>Thao tác</th>

</tr>

<?php foreach ($categories as $row): ?>

<tr>

<td><?= (int)$row["id"] ?></td>

<td><?= h($row["name"]) ?></td>

<td><?= h((string)$row["description"]) ?></td>

<td><?= h($row["created_at"]) ?></td>

<td>

<a href="edit.php?id=<?= (int)$row["id"] ?>">

Sửa

</a>

|

<form
action="delete.php"
method="post"
style="display:inline;">

<input
type="hidden"
name="id"
value="<?= (int)$row["id"] ?>">

<button
type="submit"
onclick="return confirm('Bạn có chắc muốn xóa?')">

Xóa

</button>

</form>

</td>

</tr>

<?php endforeach; ?>

</table>

</body>

</html>
