<!DOCTYPE html>
<html>

<head>
  <title>Admin Layout</title>
  <link rel="stylesheet" type="text/css" href="/css/admin.css">
  <style>
    a {
      text-decoration: none;
      color: black;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      text-align: center;
      border-radius: 10px;
    }

    tr:first-child {
      background-color: yellow;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    th,
    td {
      border: 1px solid black;
      padding: 5px;
    }

    .pagination {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 50px;
    }

    .pagination a {
      font-size: 30px;
      color: #8f8f8f;
    }

    .pagination a:hover {
      color: blue;
      text-decoration: underline;
    }

    .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 20px 20px;
    }
  </style>
</head>

<body>
  <?php

  // Check if user is admin
  if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    $req_mess = 'Bạn cần đăng nhập với tài khoản admin. Ấn "ok" để quay về trang chủ.';
    echo "<script>alert('$req_mess'); setTimeout(function(){ window.location.href = '/ecomerce-wd19314/'; }, 1000)</script>";
    exit();
  }

  // Pagination and sorting logic
  function paginateArray($dataArray, $itemsPerPage, $currentPage)
  {
    $offset = ($currentPage - 1) * $itemsPerPage;
    return array_slice($dataArray, $offset, $itemsPerPage);
  }

  // Sorting functions
  function sortByPriceDesc($a, $b)
  {
    return ($a['price'] < $b['price']) ? 1 : -1;
  }

  function sortByPriceAsc($a, $b)
  {
    return ($a['price'] > $b['price']) ? 1 : -1;
  }

  function sortByNameAZ($a, $b)
  {
    return strcmp($a['name'], $b['name']);
  }

  function sortByNameZA($a, $b)
  {
    return strcmp($b['name'], $a['name']);
  }

  $sort = $_GET['sort'] ?? '';
  $keyword = $_GET['keyword'] ?? '';
  $currentPage = $_GET['page'] ?? 1;
  $itemsPerPage = 5;

  // Search and sorting
  if (!empty($keyword)) {
    $matchedProducts = array_filter($products, function ($product) use ($keyword) {
      return stripos($product['name'], $keyword) !== false || stripos($product['description'], $keyword) !== false || stripos($product['brand'], $keyword) !== false;
    });
    $products = $matchedProducts ?: [];
    if (empty($products)) {
      $notFound = 'Không tìm thấy sản phẩm nào phù hợp với từ khóa ' . $keyword;
    }
  }

  if ($sort === 'desc') {
    usort($products, 'sortByPriceDesc');
  } elseif ($sort === 'asc') {
    usort($products, 'sortByPriceAsc');
  } elseif ($sort === 'nameAZ') {
    usort($products, 'sortByNameAZ');
  } elseif ($sort === 'nameZA') {
    usort($products, 'sortByNameZA');
  }

  $currentPageData = paginateArray($products, $itemsPerPage, $currentPage);
  $totalItems = count($products);
  $totalPages = ceil($totalItems / $itemsPerPage);
  ?>

  <header>
    <h1>Admin Dashboard</h1>
    <nav>
      <ul>
        <li><a href="/ecomerce-wd19314/admin/user">Users</a></li>
        <li><a href="/ecomerce-wd19314/admin/category">Categories</a></li>
        <li><a href="/ecomerce-wd19314/admin/product">Products</a></li>
      </ul>
    </nav>
    <nav>
      <?php if (isset($_SESSION['username'])) : ?>
        <a href="/ecomerce-wd19314/logout.php">Logout</a>
      <?php else : ?>
        <a href="/ecomerce-wd19314/login.php">Login</a>
      <?php endif; ?>
    </nav>
  </header>

  <main>
    <div class="container">
      <div class="category">
        <form id="sortForm" action="" method="get">
          <label for="sort">Sắp xếp theo:</label>
          <select name="sort" id="sort" onchange="this.form.submit()">
            <option value="" selected disabled hidden>Chọn</option>
            <option value="desc">Giá từ cao đến thấp</option>
            <option value="asc">Giá từ thấp đến cao</option>
            <option value="nameAZ">Sắp xếp từ A đến Z</option>
            <option value="nameZA">Sắp xếp từ Z đến A</option>
          </select>
        </form>
      </div>
      <div class="search">
        <form action="index.php" method="GET">
          <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm">
          <button class="btn" type="submit">Tìm kiếm</button>
        </form>
      </div>
    </div>

    <?php if (isset($notFound)) : ?>
      <p style="color: red; text-align: center; margin: 20px 0"><?= $notFound ?></p>
    <?php elseif (isset($keyword)) : ?>
      <h2>Kết quả tìm kiếm cho từ khóa '<?= $keyword ?>' có <?= count($products) ?> sản phẩm</h2>
    <?php endif; ?>

    <h1>Products</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Image</th>
          <th>Count</th>
          <th>Price</th>
          <th>Category</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($currentPageData as $product) : ?>
          <tr>
            <td><?= $product['id'] ?></td>
            <td><?= $product['name'] ?></td>
            <td><img src="<?= $product['img'] ?>" alt="<?= $product['name'] ?>" width="100"></td>
            <td><?= $product['count'] ?></td>
            <td><?= $product['price'] ?></td>
            <td><?= $product['category_id'] ?></td>
            <td><?= $product['des'] ?></td>
            <td>
              <a href="/ecomerce-wd19314/product/edit/<?= $product['id'] ?>">Edit</a>
              <a href="/ecomerce-wd19314/product/delete/<?= $product['id'] ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="pagination">
      <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
        <?php $query_string = http_build_query(array_merge($_GET, ['page' => $page])); ?>
        <a class="page-number" href="?<?= $query_string ?>"><?= $page ?></a>
      <?php endfor; ?>
    </div>

    <h1>Users</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user) : ?>
          <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['phone'] ?></td>
            <td><?= $user['address'] ?></td>
            <td>
              <a href="/ecomerce-wd19314/user/delete/<?= $user['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>

  <?php include __DIR__ . '/../includes/footer.php'; ?>

  <script>
    document.querySelectorAll('.page-number')[<?= $currentPage - 1 ?>].style.color = 'black';
  </script>
</body>

</html>