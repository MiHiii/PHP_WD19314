<!DOCTYPE html>
<html>

<head>
  <title>Products</title>
</head>

<body>
  <h1>Products</h1>
  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Image</th>
        <th>Count</th>
        <th>Description</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product) : ?>
        <tr>
          <td><?php echo $product['id']; ?></td>
          <td><?php echo $product['name']; ?></td>
          <td><?php echo $product['price']; ?></td>
          <td><img src="<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>" width="100"></td>
          <td><?php echo $product['count']; ?></td>
          <td><?php echo $product['des']; ?></td>
          <td>
            <a href="/ecomerce-wd19314/product/edit/<?php echo $product['id']; ?>">Edit</a>
            <a href="/ecomerce-wd19314/product/delete/<?php echo $product['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <br />
  <a href="/ecomerce-wd19314/app/views/admin/product/create.php">Add New Product</a>
</body>

</html>