<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "userdb";

// Create connection
$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Simple query (unsafe for production, but fine for lab)
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        $message = "Login successful! Welcome " . htmlspecialchars($username);
    } else {
        $message = "Invalid username or password";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>

<h2>User Login</h2>

<?php if ($message) { echo "<p>$message</p>"; } ?>

<form method="POST" action="">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>

</body>
</html>
