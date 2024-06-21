<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Autoloading hoặc thủ công bao gồm các file cần thiết
require_once __DIR__ . '/../app/controllers/AdminController.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/ProductController.php';
require_once __DIR__ . '/../app/controllers/CategoryController.php';

// Đặt controller mặc định
$routes['default_controller'] = 'Home';

// Định nghĩa routes cho Products
$routes['product'] = 'ProductController@index';
$routes['product/show'] = 'ProductController@productDetail';
$routes['product/create'] = 'ProductController@create';
$routes['product/update'] = 'ProductController@update';
$routes['product/delete'] = 'ProductController@delete';
$routes['product/edit'] = 'ProductController@edit';

// Định nghĩa routes cho Auth
$routes['auth/handle-login'] = 'AuthController@login'; // Sử dụng cho xử lý đăng nhập
$routes['auth/login'] = 'AuthController@showLoginForm'; // Sử dụng cho hiển thị biểu mẫu đăng nhập
$routes['auth/logout'] = 'AuthController@logout';

// Định nghĩa routes cho Categories
$routes['category'] = 'CategoryController@index';
$routes['category/show'] = 'CategoryController@show';
$routes['category/create'] = 'CategoryController@create';
$routes['category/update'] = 'CategoryController@update';


// Định nghĩa routes cho Users
$routes['user'] = 'UserController@index';
$routes['user/show'] = 'UserController@show';
$routes['user/create'] = 'UserController@create';
$routes['user/create-form'] = 'UserController@showCreateForm';
$routes['user/update'] = 'UserController@update';



// Định nghĩa routes cho Admin - User Management
$routes['admin/user'] = 'AdminController@listUsers';
$routes['admin/user/create'] = 'AdminController@createUser';
$routes['admin/user/update'] = 'AdminController@updateUser';
$routes['admin/user/delete'] = 'AdminController@deleteUser';

// Định nghĩa routes cho Admin - Category Management
$routes['admin/category'] = 'AdminController@listCategories';
$routes['admin/category/create'] = 'AdminController@createCategory';
$routes['admin/category/update'] = 'AdminController@updateCategory';
$routes['admin/category/delete'] = 'AdminController@deleteCategory';

// Định nghĩa routes cho Admin - Product Management
$routes['admin/product'] = 'AdminController@listProducts';
$routes['admin/product/create'] = 'AdminController@createProduct';
$routes['admin/product/update'] = 'AdminController@updateProduct';
$routes['admin/product/delete'] = 'AdminController@deleteProduct';
$routes['admin/product/edit'] = 'ProductController@edit';

// ... thêm các routes khác nếu cần

// echo "<pre>";
// print_r($routes);
// echo "</pre>";
