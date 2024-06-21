<?php
$title = "Gợi ý hôm nay";
include __DIR__ . '/../includes/header.php';

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
      <?php endif; ?>
    </div>
  </div>
</div>