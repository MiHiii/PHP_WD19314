<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/ecomerce-wd19314/public/css/style.css">
  <title><?php echo $title ?? 'My Website'; ?></title>
</head>

<body>
  <!-- Navigation bar -->
  <div class="nav-bar bg-warning">
    <nav class="pt-2 navbar navbar-expand-lg navbar-light  navbar-custom">
      <a class="navbar-brand" href="/ecomerce-wd19314/">
        <img width="210" height="70" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Shopee.svg/1200px-Shopee.svg.png" alt="logo">
      </a>

      <div class="collapse d-flex flex-column justify-content-between align-items-center navbar-collapse" id="navbarNav">
        <div class="search">
          <form action="">
            <input type="text" class="search-input" placeholder="Tìm sản phẩm, thương hiệu, và tên shop">
            <button type="submit" class="search-btn">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search text-red" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
              </svg>
            </button>
          </form>
        </div>
        <ul class="navbar-nav ml-auto text-justify">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Giới thiệu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Giỏ hàng</a>
          </li>
          <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
              <a class="nav-link" href="/ecomerce-wd19314/auth/logout">Logout</a>
            <?php else : ?>
              <a class="nav-link" href="/ecomerce-wd19314/auth/login">Login</a>
            <?php endif; ?>
          </li>
        </ul>
      </div>

    </nav>
  </div>
  <div class="container mt-5 min-vh-100">
    <!-- greting -->
    <?php
    echo isset($_SESSION['username']) ? "<h1>Hello, <span style='color:red; '>" . $_SESSION['username'] . "</span>" : "";
    ?>