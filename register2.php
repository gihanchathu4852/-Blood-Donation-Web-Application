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
        $blood_type_required = $_POST['blood_type_required'];
        $medical_condition = $_POST['medical_condition'];
        $specific_requirements = $_POST['specific_requirements'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // SQL query to insert data into BloodRecipients table
        $query = "INSERT INTO BloodRecipients (name, contact, blood_type_required, medical_condition, specific_requirements, username, password) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        // Prepare statement
        $stmt = $pdo->prepare($query);
        
        // Bind parameters
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $contact);
        $stmt->bindParam(3, $blood_type_required);
        $stmt->bindParam(4, $medical_condition);
        $stmt->bindParam(5, $specific_requirements);
        $stmt->bindParam(6, $username);
        $stmt->bindParam(7, $password);
        
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
  <title>Blood Recipient Registration</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h2 class="text-center mb-4">Blood Recipient Registration</h2>
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
      <label for="blood-type-required">Blood Type Required:</label>
      <select class="form-control" id="blood-type-required" name="blood_type_required" required>
        <option value="">Select the required blood type</option>
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
      <label for="medical-condition">Medical Condition:</label>
      <textarea class="form-control" id="medical-condition" name="medical_condition" rows="3" placeholder="Enter your medical condition"></textarea>
    </div>
    <div class="form-group">
      <label for="specific-requirements">Specific Requirements:</label>
      <textarea class="form-control" id="specific-requirements" name="specific_requirements" rows="3" placeholder="Enter any specific requirements"></textarea>
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
