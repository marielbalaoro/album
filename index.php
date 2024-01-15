<!DOCTYPE html>
<html lang="en">
<?php
include "app.php";
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Albums</title>
    <link rel="stylesheet" href="https://fonts.xz.style/serve/inter.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@exampledev/new.css@1.1.2/new.min.css" />
</head>

<script>
    function update_song(id, title, artist, lyrics) {
        let new_title = prompt("Please enter new title:", title);
        if (new_title == null || new_title == "") {
            return;
        }
        let new_artist = prompt("Please enter new artist:", artist);
        if (new_artist == null || new_artist == "") {
            return;
        }
        document.getElementById("new_title").value = new_title;
        document.getElementById("new_artist").value = new_artist;
        document.getElementById("new_lyrics").value = new_lyrics;
        document.getElementById("update_id").value = id;
        document.getElementById("updateForm").submit();
    }

    function delete_song(id, title, artist) {
        let is_sure = "Deleting song '" + title + "' by '" + artist + "'. Are you sure?";
        if (confirm(is_sure) == true) {
            document.getElementById("delete_id").value = id;
            document.getElementById("deleteForm").submit();
        }
    }
</script>

<body>
    <form id="updateForm" method="POST">
        <input type="hidden" name="update_id" id="update_id">
        <input type="hidden" name="new_title" id="new_title">
        <input type="hidden" name="new_artist" id="new_artist">
        <input type="hidden" name="new_lyrics" id="new_lyrics">
        <input type="hidden" name="action" value="update">
    </form>

    <form id="deleteForm" method="POST">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="delete_id" id="delete_id">
    </form>

    <header>
        <h1>List of Songs</h1>
    </header>
    <h2>Add Song</h2>
    <form method="POST">
        <label for="title">Song Title</label> <br>
        <input type="text" name="title"><br>

        <label for="artist">Artist</label> <br>
        <input type="text" name="artist"><br>

        <label for="lyrics">Lyrics</label> <br>
        <textarea name="lyrics" rows="10" cols="50"></textarea><br>

        <input type="hidden" name="action" value="create"><br>
        <button type="submit" name="save">Save</button><br>
    </form>
    <h2>Songs</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Date</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <?php
        $results = getSongs($db);
        while ($row = $results->fetchArray()) :
        ?>
            <tr>
                <td><?php echo $row["title"]; ?></td>
                <td><?php echo $row["artist"]; ?></td>
                <td><?php echo $row["created_at"]; ?></td>
                <td>
                    <button onclick="update_song(
                    '<?php echo $row["id"] ?>',
                    '<?php echo $row["title"] ?>',
                    '<?php echo $row["artist"] ?>',
                    '<?php echo $row["lyrics"] ?>'
                )">Edit</button>
                </td>
                <td>
                    <button onclick="delete_song(
                    '<?php echo $row["id"] ?>',
                    '<?php echo $row["title"] ?>',
                    '<?php echo $row["artist"] ?>',
                    '<?php echo $row["lyrics"] ?>'
                )">Delete</button>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>