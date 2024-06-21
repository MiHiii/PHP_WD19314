<!DOCTYPE html>
<html>

<head>
  <title>Categories</title>
</head>

<body>
  <h1>Categories</h1>
  <ul>
    <?php foreach ($categories as $category) : ?>
      <li>
        <?php echo $category['name']; ?>
        <a href="/ecomerce-wd19314/category/edit/<?php echo $category['id']; ?>">Edit</a>
        <a href="/ecomerce-wd19314/category/delete/<?php echo $category['id']; ?>" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
      </li>
    <?php endforeach; ?>
  </ul>
  <a href="/ecomerce-wd19314/app/views/admin/category/create.php">Add New Category</a>
</body>

</html>