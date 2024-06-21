<?php
$title = $product['name'];
include __DIR__ . '/../includes/header.php';

?>


<!-- Show product detail -->

<div class="container">
  <div class="product-detail">
    <div class="product-detail__img">
      <img src="<?php echo $product['img']; ?>" alt="" />
    </div>
    <div class="product-detail__info">
      <h2 class="product-detail__name"><?php echo $product['name']; ?></h2>
      <div class="product-detail__text">
        <p>Số lượng còn: <?php echo "<span style='font-weight: 600;'>" . $product['count'] . "</span>"; ?></p>
      </div>
      <p class="product-detail__desc"><?php echo $product['des']; ?></p>
      <div class="item--new__price">
        <span><?php echo number_format($product['price'], 0, ',', '.'); ?></span><span style="text-decoration: underline">đ</span>
      </div>
      <button class="btn btn-buy" type="button">Mua ngay</button>
    </div>
  </div>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>