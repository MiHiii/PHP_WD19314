<!DOCTYPE html>
<html>

<head>
  <title>Users</title>
</head>

<body>
  <h1>Users</h1>
  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user) : ?>
        <tr>
          <td><?php echo $user['id']; ?></td>
          <td><?php echo $user['name']; ?></td>
          <td><?php echo $user['email']; ?></td>
          <td><?php echo $user['phone']; ?></td>
          <td><?php echo $user['address']; ?></td>
          <td>
            <!-- <a href="/ecomerce-wd19314/user/edit/<?php echo $user['id']; ?>">Edit</a> -->
            <a href="/ecomerce-wd19314/user/delete/<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <br />
  <a href="/ecomerce-wd19314/user/create-form">Sign in</a>
</body>

</html>