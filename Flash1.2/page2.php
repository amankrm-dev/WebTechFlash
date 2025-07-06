<?php
session_start();
if(isset($_SESSION['username'])) {
    echo "Hello, " . $_SESSION['username'] . "! Welcome back.";
} else {
    echo "Session not found.";
}
?>
