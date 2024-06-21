<!-- views/auth/login.php -->

<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
</head>

<body>
  <form action="/ecomerce-wd19314/auth/handle-login" method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <button type="submit">Login</button>
  </form>
</body>

</html>