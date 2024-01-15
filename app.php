<?php
$database_name = "/tmp/" . "album.db";
$db = new SQLite3($database_name);
$query = "CREATE TABLE IF NOT EXISTS songs (id INTEGER PRIMARY KEY, title STRING, artist STRING, lyrics STRING, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
$db->exec($query);

function getSongs($db)
{
    $query = "SELECT * FROM songs";
    $results = $db->query($query);
    return $results;
}

if ($_POST) {
    if ($_POST["action"] == "create") {
        // Insert new book
        $title = $_POST["title"];
        $artist = $_POST["artist"];
        $lyrics = $_POST["lyrics"];
        $stmt = $db->prepare("INSERT INTO songs (title, artist, lyrics) VALUES (:title, :artist, :lyrics)");
        $stmt->bindValue(":title", $title, SQLITE3_TEXT);
        $stmt->bindValue(":artist", $artist, SQLITE3_TEXT);
        $stmt->bindValue(":lyrics", $lyrics, SQLITE3_TEXT);
        $stmt->execute();
    } elseif ($_POST["action"] == "update") {
        $id = $_POST['update_id'];
        $title = $_POST['new_title'];
        $artist = $_POST['new_artist'];
        $lyrics = $_POST['new_lyrics'];
        $stmt = $db->prepare("UPDATE songs SET title=:title, artist=:artist, lyrics=:lyrics WHERE id=:id");
        $stmt->bindValue(':title', $title, SQLITE3_TEXT);
        $stmt->bindValue(':artist', $artist, SQLITE3_TEXT);
        $stmt->bindValue(':lyrics', $lyrics, SQLITE3_TEXT);
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $stmt->execute();
    } elseif ($_POST["action"] == "delete") {
        $id = $_POST['delete_id'];
        $stmt = $db->prepare('DELETE FROM songs WHERE id=:id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $stmt->execute();
    }
}
