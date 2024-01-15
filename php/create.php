<?php
// Include config file
require_once "dbconn.php";

// Define variables and initialize with empty values
$title = $artist = $lyrics = "";
$title_err = $artist_err = $lyrics_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate title
    $input_title = trim($_POST["title"]);
    if (empty($input_title)) {
        $title_err = "Please enter a title.";
    } elseif (!filter_var($input_title, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $title_err = "Please enter a valid title.";
    } else {
        $title = $input_title;
    }

    // Validate artist
    $input_artist = trim($_POST["artist"]);
    if (empty($input_artist)) {
        $artist_err = "Please enter an artist.";
    } else {
        $artist = $input_artist;
    }

    // Validate lyrics
    $input_lyrics = trim($_POST["lyrics"]);
    if (empty($input_lyrics)) {
        $lyrics_err = "Please enter the lyrics.";
    } else {
        $lyrics = $input_lyrics;
    }

    // Check input errors before inserting in database
    if (empty($title_err) && empty($artist_err) && empty($lyrics_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO songs (title, artist, lyrics) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_title, $param_artist, $param_lyrics);

            // Set parameters
            $param_title = $title;
            $param_artist = $artist;
            $param_lyrics = $lyrics;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Song</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Song</h2>
                    <p>Please fill this form and submit to add song.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                            <span class="invalid-feedback"><?php echo $title_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Artist</label>
                            <input type="text" name="artist" class="form-control <?php echo (!empty($artist_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $artist; ?>">
                            <span class="invalid-feedback"><?php echo $artist_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Lyrics</label>
                            <textarea name="lyrics" cols="10" rows="10" class="form-control <?php echo (!empty($lyrics_err)) ? 'is-invalid' : ''; ?>"><?php echo $lyrics; ?></textarea>
                            <span class="invalid-feedback"><?php echo $lyrics_err; ?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>