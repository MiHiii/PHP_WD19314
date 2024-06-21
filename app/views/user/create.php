<!-- views/user/create.php -->
<!DOCTYPE html>
<html>

<head>
  <title>Create User</title>
</head>

<body>
  <h1>Create New User</h1>
  <form action="/ecomerce-wd19314/user/create" method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <button type="submit">Create</button>
  </form>
</body>

</html>