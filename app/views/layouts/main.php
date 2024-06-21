<?php include __DIR__ . '/../includes/header.php'; ?>




<main>

  <?php
  $products = isset($products) ? $products : [];
  include $view;
  ?>
</main>



<?php include __DIR__ . '/../includes/footer.php'; ?>