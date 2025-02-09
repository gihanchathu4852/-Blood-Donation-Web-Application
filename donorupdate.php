<?php
session_start();

// Include your database connection file
include('db_connection.php');

// Check if the database connection is successful
if (isset($pdo)) {
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $contact = $_POST['contact'];
        $medical_history = $_POST['medical_history'];
        
        // Get donor's id from session
        $donor_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'N/A'; // Update to 'donor_id' if necessary

        // Update query
        $query = "UPDATE BloodDonors SET contact = ?, medical_history = ? WHERE id = ?";

        // Prepare statement
        $stmt = $pdo->prepare($query);
        
        // Bind parameters
        $stmt->bindParam(1, $contact);
        $stmt->bindParam(2, $medical_history);
        $stmt->bindParam(3, $donor_id);
        
        // Execute statement
        if ($stmt->execute()) {
            echo "Information updated successfully!";
            // Redirect to donor profile page or any other page
            // header("Location: profile.php");
            exit;
        } else {
            echo "Error: Unable to update information.";
        }
    }

    // Check if session variables are set
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'N/A';
    $user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'N/A';
} else {
    echo "Failed to connect to the database.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Donor Information</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <style type="text/css">
      .messaging{
        background-color: black;
        width: 140px;
        height: 45px;
        color: white;
        border-radius: 8px;
        text-align: center;
        padding: 10px;
      }

      a:hover {
          background-color: black;
          color: whitesmoke;
          
      }

  </style>

</head>
<body>

<div class="container mt-5">
  <h2 class="text-center mb-4">Update Donor Information</h2>
  <!-- Display logged-in user's ID and name -->
  <div class="row">
    <div class="col-md-6">
      <p>Logged-in User ID: <?php echo $user_id; ?></p>
      <p>Logged-in User Name: <?php echo $user_name; ?></p>
      <form method="POST" action="">
        <div class="form-group">
          <label for="contact">Contact Information:</label>
          <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter updated contact information" required>
        </div>
        <div class="form-group">
          <label for="medical-history">Medical History:</label>
          <textarea class="form-control" id="medical-history" name="medical_history" rows="3" placeholder="Enter updated medical history"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Information</button>
      </form>
    </div>
    <div class="col-md-6 d-flex justify-content-end">
      <a href="donormessage.php" class="messaging">Go to Messages</a>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
