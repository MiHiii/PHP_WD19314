<?php
$title = "Chỉnh sửa sản phẩm";
include __DIR__ . '/../includes/header.php';
?>

<div class="container">
  <form method="post" action="/ecomerce-wd19314/product/update/<?= $product['id'] ?>">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">

    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?= $product['name'] ?>">
    <br>

    <label for="price">Price:</label>
    <input type="text" name="price" id="price" value="<?= $product['price'] ?>">
    <br>

    <label for="category_id">Category:</label>
    <input type="text" name="category_id" id="category_id" value="<?= $product['category_id'] ?>">
    <br>

    <label for="count">Count:</label>
    <input type="text" name="count" id="count" value="<?= $product['count'] ?>">
    <br>

    <label for="img">Image URL:</label>
    <input type="text" name="img" id="img" value="<?= $product['img'] ?>">
    <br>

    <label for="description">Description:</label>
    <textarea name="description" id="description"></textarea>
    <br>

    <button type="submit">Update</button>
  </form>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>