
<?php
session_start();

if (!isset($_SESSION["username"]) and !isset($_SESSION["email"])) {
  header("Location: login.html");
  exit();
}

$servername = "localhost"; //
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "irp"; // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION["username"];

// Fetch user data based on username or email

$sql = "SELECT * FROM users WHERE (username='$username' or email='$username')";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
  $row = $result->fetch_assoc();
  $name = $row["name"];
  $username = $row["username"];
  $email = $row["email"];
  $gender = $row["gender"];
  $dob = $row["dob"];
} else {
  // found (This shouldn't happen if session is properly managed)
  header("Location: login.html");
  exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
  <div class="profile-container">
    <h2>Profile Details</h2>
    <div class="profile-details">
      <label for="name">Name:</label>
      <span><?php echo $name; ?></span>
    </div>
    <div class="profile-details">
      <label for="username">Username:</label>
      <span><?php echo $username; ?></span>
    </div>
    <div class="profile-details">
      <label for="email">Email:</label>
      <span><?php echo $email; ?></span>
    </div>
    <div class="profile-details">
      <label for="gender">Gender:</label>
      <span><?php echo $gender; ?></span>
    </div>
    <div class="profile-details">
      <label for="dob">Date of Birth:</label>
      <span ><?php echo $dob; ?></span>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
  </div>
</body>
</html>
