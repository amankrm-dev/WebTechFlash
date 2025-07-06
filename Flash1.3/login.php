<?php
session_start();
$conn = new mysqli("localhost", "root", "", "userdb");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Using prepared statements to prevent SQL injection
  $stmt = $conn->prepare("SELECT id FROM users WHERE username=? AND password=?");
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $_SESSION['username'] = $username;
    echo "Login successful. Welcome, $username!";
    // Redirect to dashboard or home
  } else {
    echo "Invalid username or password.";
  }
  $stmt->close();
}
$conn->close();
?>
