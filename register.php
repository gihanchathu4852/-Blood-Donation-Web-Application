<?php
// Include your database connection file
include('db_connection.php');

// Check if the database connection is successful
if (isset($pdo)) {
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Get form data
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $blood_type = $_POST['blood_type'];
        $age = $_POST['age'];
        $medical_history = $_POST['medical_history'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Hash the password using SHA-256
        $hashed_password = hash('sha256', $password);
        
        // SQL query to insert data into BloodDonors table
        $query = "INSERT INTO BloodDonors (name, contact, blood_type, age, medical_history, username, password) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        // Prepare statement
        $stmt = $pdo->prepare($query);
        
        // Bind parameters
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $contact);
        $stmt->bindParam(3, $blood_type);
        $stmt->bindParam(4, $age);
        $stmt->bindParam(5, $medical_history);
        $stmt->bindParam(6, $username);
        $stmt->bindParam(7, $hashed_password); // Use hashed password
        
        // Execute statement
        if ($stmt->execute()) {
            echo "Registration successful!";
            // Redirect to a confirmation page or any other page
            // header("Location: confirmation.php");
            exit;
        } else {
            echo "Error: Unable to execute the query.";
        }
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
  <title>Blood Donor Registration</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h2 class="text-center mb-4">Blood Donor Registration</h2>
  <form method="POST" action="">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
    </div>
    <div class="form-group">
      <label for="contact">Contact Information:</label>
      <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter your contact information" required>
    </div>
    <div class="form-group">
      <label for="blood-type">Blood Type:</label>
      <select class="form-control" id="blood-type" name="blood_type" required>
        <option value="">Select your blood type</option>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
      </select>
    </div>
    <div class="form-group">
      <label for="age">Age:</label>
      <input type="number" class="form-control" id="age" name="age" placeholder="Enter your age" required>
    </div>
    <div class="form-group">
      <label for="medical-history">Medical History:</label>
      <textarea class="form-control" id="medical-history" name="medical_history" rows="3" placeholder="Enter any relevant medical history"></textarea>
    </div>
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Choose a username" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Choose a password" required>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
