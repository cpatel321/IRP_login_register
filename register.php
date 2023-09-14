<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $gender = $_POST["gender"];
  $dob = $_POST["dob"];

  // Prevent SQL injection
  $name = mysqli_real_escape_string($conn, $name);
  $username = mysqli_real_escape_string($conn, $username);
  $email = mysqli_real_escape_string($conn, $email);
  $password = mysqli_real_escape_string($conn, $password);
  $gender = mysqli_real_escape_string($conn, $gender);
  $dob = mysqli_real_escape_string($conn, $dob);

  // Check if username or email already exists
  $checkQuery = "SELECT * FROM users WHERE username='$username' OR email='$email'";
  $checkResult = $conn->query($checkQuery);

  if ($checkResult->num_rows > 0) {
    // Username or email already exists
    header("Location: register.php?error=UsernameOrEmailExists"); // Redirect back to registration page with error message
    exit();
  } else {
    // Insert new user into database
    $insertQuery = "INSERT INTO users (name, username, email, password, gender, dob)
                    VALUES ('$name', '$username', '$email', '$password', '$gender', '$dob')";

    if ($conn->query($insertQuery) === TRUE) {
      // Registration successful
      session_start();
      $_SESSION["username"] = $username;
      header("Location: index.php"); // Redirect to profile page
      exit();
    } else {
      // Error while inserting into database
      echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
  }
}

$conn->close();
?>
