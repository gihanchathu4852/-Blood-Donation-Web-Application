<?php
// Include your database connection file
include('db_connection.php');

// Check if the database connection is successful
if (isset($pdo)) {
    // Check if blood type is selected and form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['blood_type'])) {
        $blood_type = $_POST['blood_type'];
        
        // SQL query to fetch donors with the selected blood type
        $query = "SELECT name, contact, blood_type, age, medical_history FROM BloodDonors WHERE blood_type = ?";
        
        // Prepare statement
        $stmt = $pdo->prepare($query);
        
        // Bind parameter
        $stmt->bindParam(1, $blood_type);
        
        // Execute statement
        if ($stmt->execute()) {
            // Fetch all matching donors
            $donors = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "Error: Unable to execute the query.";
            exit;
        }
    }

    // Check if form for sending message is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message']) && isset($_POST['recipient_name'])) {
        $recipient_name = $_POST['recipient_name'];
        $message = $_POST['message'];
        $donor_name = $_POST['donor_name']; // Added donor's name

        // Insert message into database
        $insertQuery = "INSERT INTO messages (donor_name, recipient_name, message) VALUES (?, ?, ?)"; // Added donor's name field
        $insertStmt = $pdo->prepare($insertQuery);
        $insertStmt->execute([$donor_name, $recipient_name, $message]); // Added donor's name parameter
    }
} else {
    echo "Failed to connect to the database.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blood Donor Search</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h2 class="text-center mb-4">Blood Donor Search</h2>
  <form method="POST" action="">
    <div class="form-group">
      <label for="blood-type">Select Your Blood Type:</label>
      <select class="form-control" id="blood-type" name="blood_type">
        <option value="">Select blood type</option>
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
    <button type="submit" class="btn btn-primary">Search Donors</button>
  </form>

  <!-- Display search results here -->
  <?php if(isset($donors) && count($donors) > 0) { ?>
  <div class="mt-4">
    <h4>Matching Donors:</h4>
    <ul class="list-group">
      <?php foreach($donors as $donor) { ?>
      <li class="list-group-item">
        <strong>Name:</strong> <?php echo $donor['name']; ?><br>
        <strong>Contact:</strong> <?php echo $donor['contact']; ?><br>
        <strong>Blood Type:</strong> <?php echo $donor['blood_type']; ?><br>
        <strong>Age:</strong> <?php echo $donor['age']; ?><br>
        <strong>Medical History:</strong> <?php echo $donor['medical_history']; ?><br>
        <!-- Form for sending message -->
        <!-- Form for sending message -->
          <form method="POST" action="">
            <input type="hidden" name="recipient_name" value="<?php echo $donor['name']; ?>">
            <input type="hidden" name="donor_name" value="<?php echo $donor['name']; ?>"> <!-- Hidden field for donor's name -->
            <div class="form-group mt-2">
              <label for="message">Send Message:</label>
              <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
          </form>

      </li>
      <?php } ?>
    </ul>
  </div>
  <?php } ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
