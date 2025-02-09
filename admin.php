<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blood Donors</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      margin-top: 50px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2 class="text-center mb-4">Available Blood Donors</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Donor Name</th>
        <th>Contact</th>
        <th>Blood Type</th>
        <th>Age</th>
        <th>Medical History</th>
        <th>Recipient Name</th>
        <th>Blood Type Required</th>
        <th>Medical Condition</th>
        <th>Specific Requirements</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Establish database connection
      $conn = new mysqli("localhost", "root", "", "blood");

      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      // Query to select donors and recipients with matching blood type
      $sql = "SELECT bd.name AS donor_name, bd.contact AS donor_contact, bd.blood_type AS donor_blood_type, bd.age AS donor_age, bd.medical_history AS donor_medical_history,
                     br.name AS recipient_name, br.blood_type_required AS recipient_blood_type_required, br.medical_condition AS recipient_medical_condition, br.specific_requirements AS recipient_specific_requirements
              FROM blooddonors bd
              JOIN bloodrecipients br ON bd.blood_type = br.blood_type_required";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // Output data of each row
          while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row["donor_name"] . "</td>";
              echo "<td>" . $row["donor_contact"] . "</td>";
              echo "<td>" . $row["donor_blood_type"] . "</td>";
              echo "<td>" . $row["donor_age"] . "</td>";
              echo "<td>" . $row["donor_medical_history"] . "</td>";
              echo "<td>" . $row["recipient_name"] . "</td>";
              echo "<td>" . $row["recipient_blood_type_required"] . "</td>";
              echo "<td>" . $row["recipient_medical_condition"] . "</td>";
              echo "<td>" . $row["recipient_specific_requirements"] . "</td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='9'>No matching donors found.</td></tr>";
      }
      $conn->close();
      ?>
    </tbody>
  </table>
</div>

<!-- Bootstrap JS (optional, for some functionalities) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
