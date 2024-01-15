<?php
// Include the database connection file
require_once("dbconn.php");

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $lyrics = $_POST['lyrics'];
    $sql = "INSERT INTO songs (title,artist,lyrics)VALUES    ('$title','$artist','$lyrics')";
    if (mysqli_query($conn, $sql)) {
        echo "New record has been added successfully !";
    } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
