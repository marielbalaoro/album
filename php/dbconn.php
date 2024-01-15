<?php
$host = 'db';
$dbn = 'crud_db';
$user = 'devuser';
$pass = 'devpass';
$conn = new mysqli($host, $user, $pass, $dbn);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>