<?php
include_once __DIR__ . "/../models/ProductModel.php";

class ProductController
{
  private $model;

  public function __construct()
  {
    $this->model = new ProductModel();
  }

  public function index()
  {
    // Get all products
    $products = $this->model->getAllProducts();
    // Load view with products data
    include __DIR__ . "/../views/product/index.php";
  }

  public function show($id)
  {
    // Get product by id
    $product = $this->model->getProductById($id);
    // echo "<pre>";
    // print_r($product);
    // echo "</pre>";
    // Load view with product data
    include __DIR__ . "/../views/product/productDetail.php";
  }

  public function create()
  {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $count = $_POST['count'];
    // Create a new product
    $this->model->create($name, $price, $category_id, $count);
    // Redirect or load view
    header("Location: /product");
  }

  public function edit($id)
  {
    // Get product by id
    $product = $this->model->getProductById($id);
    // Load view with product data
    include __DIR__ . "/../views/admin/product/edit.php";
  }

  public function update($id)
  {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $count = $_POST['count'];
    $img = $_POST['img'];
    $des = $_POST['description'];

    // Update the product
    $this->model->updateProduct($id, $name, $price, $category_id, $count, $img, $des);

    // Redirect or load view
    header("Location: /ecomerce-wd19314/admin/product");
  }

  public function delete($id)
  {
    // Delete the product
    $this->model->deleteProduct($id);

    // Redirect or load view
    header("Location: /ecomerce-wd19314/admin/product");
  }
}

// $productController = new ProductController();
// $productController->productDetail(3);
