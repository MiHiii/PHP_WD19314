<?php

class HomeController
{
  public function index()
  {
    // Assuming you have a Product model to interact with the database
    require_once __DIR__ . '/../models/ProductModel.php';
    $productModel = new ProductModel();

    // Fetch all products
    $allProducts = $productModel->getAllProducts();

    // Pass products to the view
    // $url = __DIR__ . '/../views/home/index.php';
    // echo $url;
    include __DIR__ . '/../views/home/index.php';
  }
}

// $homeController = new HomeController();
// $homeController->index();
