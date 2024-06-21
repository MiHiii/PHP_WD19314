<?php
$title = "Chỉnh sửa người dùng";
include __DIR__ . '/../../includes/header.php';
?>

<div class="container">
  <form method="post" action="/ecomerce-wd19314/user/update/<?= $user['id'] ?>">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">

    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?= $user['name'] ?>">
    <br />

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?= $user['email'] ?>">
    <br />

    <label for="phone">Phone:</label>
    <input type="text" name="phone" id="phone" value="<?= $user['phone'] ?>">
    <br />

    <label for="address">Address:</label>
    <input type="text" name="address" id="address" value="<?= $user['address'] ?>">
    <br />

    <label for="current_password">Password:</label>
    <input type="password" name="current_password" id="current_password" required>
    <br />

    <button type="submit">Update</button>
  </form>
</div>

<?php
include __DIR__ . '/../../includes/footer.php';
?>