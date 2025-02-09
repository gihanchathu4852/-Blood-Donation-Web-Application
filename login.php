<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Database connection
    include('db_connection.php'); // Include database connection file
    
    if (isset($pdo)) {
        // Check if the user is a blood donor
        $sql = "SELECT * FROM BloodDonors WHERE username=? AND password=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $password]);
        $donor = $stmt->fetch();
        
        if ($donor) {
            // Set session variables
            $_SESSION['user_id'] = $donor['id'];
            $_SESSION['user_name'] = $donor['name'];
            
            // Redirect to donor update page
            header("Location: donorupdate.php");
            exit();
        }
        
        // Check if the user is a blood recipient
        $sql = "SELECT * FROM BloodRecipients WHERE username=? AND password=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $password]);
        $recipient = $stmt->fetch();
        
        if ($recipient) {
            // Set session variables if needed
            // $_SESSION['user_id'] = $recipient['id'];
            // $_SESSION['user_name'] = $recipient['name'];
            
            // Redirect to search page
            header("Location: search.php");
            exit();
        }
        
        // If no match found, display error message
        $error_message = "Invalid username or password";
    } else {
        echo "Failed to connect to the database.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blood Donation Platform - Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h2 class="text-center mb-4">Blood Donation Platform - Login</h2>
  <form method="POST" action="">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Login</button>
    <?php if(isset($error_message)) { ?>
        <div class="text-danger mt-3"><?php echo $error_message; ?></div>
    <?php } ?>
  </form>
  <div class="text-center mt-3">
    <p>Don't have an account? <a href="../bloodweb/register.php">Register Blood Donor</a> Or <a href="../bloodweb/register2.php">Blood Recipient</a></p> <br><p>Are you admin? <a href="../bloodweb/adminlog.php">Login here</a></p>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
