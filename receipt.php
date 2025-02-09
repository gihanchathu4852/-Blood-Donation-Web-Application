<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Recipient Information</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h2 class="text-center mb-4">Update Recipient Information</h2>
  <form>
    <div class="form-group">
      <label for="contact">Contact Information:</label>
      <input type="text" class="form-control" id="contact" placeholder="Enter updated contact information" required>
    </div>
    <div class="form-group">
      <label for="health-status">Current Health Status:</label>
      <textarea class="form-control" id="health-status" rows="3" placeholder="Enter updated health status"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update Information</button>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
