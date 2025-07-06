<?php
session_start();
$_SESSION['username'] = "AmanKr";
echo "Session is set. Go to <a href='page2.php'>page 2</a> to see it.";
?>
