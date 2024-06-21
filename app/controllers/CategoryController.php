<?php
include_once __DIR__ . "/../models/CategoryModel.php";

class CategoryController
{
  private $model;

  public function __construct()
  {
    $this->model = new CategoryModel();
  }

  public function index()
  {
    // Get all categories
    $categories = $this->model->getAllCategories();
    // Load view with categories data
    include __DIR__ . "/../views/category/index.php";
  }

  public function show($id)
  {
    // Get category by id
    $category = $this->model->getCategoryById($id);
    // Load view with category data
    include __DIR__ . "/../views/category/show.php";
  }

  public function create($name)
  {
    // Create a new category
    $this->model->create($name);
    // Redirect or load view
    header("Location: /ecomerce-wd19314/admin/category");
  }

  public function edit($id)
  {
    // Get category by id
    $category = $this->model->getCategoryById($id);
    // Load view with category data
    include __DIR__ . "/../views/admin/category/edit.php";
  }

  public function update($id)
  {
    $name = $_POST['name'];
    // Update the category
    $this->model->updateCategory($id, $name,);
    // Redirect or load view
    header("Location: /ecomerce-wd19314/admin/category");
  }

  public function delete($id)
  {
    // Delete the category
    $this->model->deleteCategory($id);
    // Redirect or load view
    header("Location: /ecomerce-wd19314/admin/category");
  }
}

// $categoryModel = new CategoryController();
// $categoryModel->update();
