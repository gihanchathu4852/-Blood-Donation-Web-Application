<?php
session_start();

// Include your database connection file
include('db_connection.php');

// Check if the database connection is successful
if (isset($pdo)) {
    // Check if session variables are set
    $user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'N/A';

    // SQL query to fetch messages for the logged-in donor
    $query = "SELECT * FROM messages WHERE donor_name = ?";
    
    // Prepare statement
    $stmt = $pdo->prepare($query);
    
    // Bind parameter
    $stmt->bindParam(1, $user_name);
    
    // Execute statement
    if ($stmt->execute()) {
        // Fetch all matching messages
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Error: Unable to fetch messages.";
    }
} else {
    echo "Failed to connect to the database.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Messages</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h2 class="text-center mb-4">Messages</h2>
  <?php if(isset($messages) && !empty($messages)) { ?>
  <div class="list-group">
    <?php foreach($messages as $message) { ?>
    <a href="#" class="list-group-item list-group-item-action">
      <h5 class="mb-1"><?php echo $message['recipient_name']; ?></h5>
      <p class="mb-1"><?php echo $message['message']; ?></p>
      <small>Sent at <?php echo $message['sent_at']; ?></small>
    </a>
    <?php } ?>
  </div>
  <?php } else { ?>
  <div class="alert alert-info" role="alert">
    No messages found.
  </div>
  <?php } ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
