<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/CategoryModel.php';

class CategoryController
{
    private CategoryModel $model;

    public function __construct()
    {
        $this->model = new CategoryModel();
    }

    public function index(): void
    {
        $categories = $this->model->all();
        require __DIR__ . '/../views/category/index.php';
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            if ($name !== '') {
                $this->model->create($name, $description !== '' ? $description : null);
            }
             $_SESSION['flash'] = 'Thêm danh mục thành công.';
            header('Location: index.php?controller=category&action=index');
            exit;
        }
        require __DIR__ . '/../views/category/create.php';
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $category = $this->model->find($id);
        if (!$category) {
            http_response_code(404);
            echo 'Not found';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $this->model->update($id, $name, $description !== '' ? $description : null);
            $_SESSION['flash'] = 'Cập nhật thành công.';
            header('Location: index.php?controller=category&action=index');
            exit;
        }

        require __DIR__ . '/../views/category/edit.php';
    }

    public function delete(): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

        http_response_code(405);

        exit('Method Not Allowed');
    }

    $id = (int) ($_POST['id'] ?? 0);

    $this->model->delete($id);

    $_SESSION['flash'] = 'Xóa thành công.';

    header('Location: index.php?controller=category&action=index');

    exit;
}
}
