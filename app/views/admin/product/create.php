<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Product</title>
</head>

<body>
  <h1>Create Product</h1>
  <form action="/ecomerce-wd19314/admin/product/create" method="POST">
    <label for="name">Name</label>
    <input type="text" name="name" id="name">
    <label for="price">Price</label>
    <input type="text" name="price" id="price">
    <label for="category_id">Category</label>
    <select name="category_id" id="category_id">
      <option value="0" hidden>Chọn danh mục</option>
      <option value="1">Điện Thoại</option>
      <option value="2">Máy tính</option>
      <option value="3">Laptop</option>
    </select>
    <label for="count">Count</label>
    <input type="count" name="count" id="count">
    <button type="submit">Create</button>
  </form>
  <a href="/ecomerce-wd19314/admin/product">Back to Products</a>
</body>

</html>