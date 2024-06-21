<?php
$title = "Gợi ý hôm nay";
include __DIR__ . '/../includes/header.php';

// Assume you already have an array of all products
// $allProducts = /* Fetch or define your products array here */;

// Pagination logic
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$totalItems = count($allProducts);
$totalPages = ceil($totalItems / $itemsPerPage);
$offset = ($currentPage - 1) * $itemsPerPage;

// Slice the array to get the current page items
$products = array_slice($allProducts, $offset, $itemsPerPage);
?>

<h2 class="heading text-center mt-5 text-uppercase"><?php echo $title; ?></h2>
<div class="container mt-5">
  <div class="items">
    <div class="item-sort">
      <?php if (empty($products)) : ?>
        <p class="text-center">Không có sản phẩm nào</p>
      <?php else : ?>
        <?php foreach ($products as $index => $product) : ?>
          <div class="item">
            <h3 class="item-header">
              <a href="/ecomerce-wd19314/product/show/<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a>
            </h3>
            <div class="img-item">
              <a href="/ecomerce-wd19314/product/show/<?php echo $product['id']; ?>"><img src="<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>" /></a>
            </div>
            <div class="item--new__price">
              <span><?php echo number_format($product['price'], 0, ',', '.'); ?></span><span style="text-decoration: underline">đ</span>
            </div>
            <p class="card-text">Số lượng còn lại: <?php echo "<span style='color: red;'>" . $product['count'] . "</span>"; ?></p>
            <div class="item-btn">
              <button class="btn btn-buy" type="button">Mua ngay</button>
            </div>
          </div>
          <?php if (($index + 1) % 5 == 0 && $index + 1 != count($products)) : ?>
            <div style="width: 100%;"></div>
          <?php endif; ?>
        <?php endforeach; ?>

        <!-- Pagination -->
        <div class="pagination">
          <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
            <a href="?page=<?php echo $page; ?>" class="page-link<?php echo $page == $currentPage ? ' active' : ''; ?>">
              <?php echo $page; ?>
            </a>
          <?php endfor; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<style>
  .pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
  }

  .page-link {
    margin: 0 5px;
    padding: 10px 15px;
    background-color: #f2f2f2;
    border: 1px solid #ddd;
    text-decoration: none;
    color: #333;
  }

  .page-link.active {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
  }

  .page-link:hover {
    background-color: #0056b3;
    color: white;
    border-color: #0056b3;
  }
</style>

<?php include __DIR__ . '/../includes/footer.php'; ?>