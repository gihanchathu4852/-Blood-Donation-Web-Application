<?php
// Check if form is submitted
if (isset($_POST['login'])) {
    // Check if username and password match
    if ($_POST['username'] === 'admin' && $_POST['password'] === 'admin123') {
        // Redirect to admin.php
        header('Location: admin.php');
        exit;
    } else {
        // If credentials don't match, display error message
        echo '<script>alert("Invalid username or password!");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .login-container {
      max-width: 400px;
      margin: 0 auto;
      margin-top: 100px;
      padding: 40px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>

<div class="container">
  <div class="login-container">
    <h2 class="text-center mb-4">Admin Login</h2>
    <form method="post" action="admin.php">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
    </form>
  </div>
</div>

<!-- Bootstrap JS (optional, for some functionalities) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
