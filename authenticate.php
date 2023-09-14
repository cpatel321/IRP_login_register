<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "irp"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

   
  $username = mysqli_real_escape_string($conn, $username);
  $password = mysqli_real_escape_string($conn, $password);

  $sql = "SELECT * FROM users WHERE ( username='$username' OR email='$username') AND password='$password'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    
    session_start();
    $_SESSION["username"] = $username;
    $_SESSION["email"] = $username;
    header("Location: index.php");  
  } else {
    
    header("Location: login.html?error=InvalidCredentials"); 
  }
}

$conn->close();


?>
