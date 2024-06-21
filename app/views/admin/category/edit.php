<?php
$title = "Chỉnh sửa sản phẩm";
include __DIR__ . '/../../includes/header.php';
?>

<div class="container">
  <form method="post" action="/ecomerce-wd19314/category/update/<?= $category['id'] ?>">
    <label for="name">Id:</label>
    <input type="text" name="id" value="<?= $category['id'] ?>" disabled>
    <br />
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?= $category['name'] ?>">
    <br />

    <button type="submit">Update</button>
  </form>
</div>

<?php
include __DIR__ . '/../../includes/footer.php';
?>