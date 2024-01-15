<?php
// Include config file
require_once "dbconn.php";

// Define variables and initialize with empty values
$title = $artist = $lyrics = "";
$title_err = $artist_err = $lyrics_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    // Validate name
    $input_title = trim($_POST["title"]);
    if (empty($input_title)) {
        $name_err = "Please enter a title.";
    } elseif (!filter_var($input_title, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid title.";
    } else {
        $title = $input_title;
    }

    // Validate address address
    $input_artist = trim($_POST["artist"]);
    if (empty($input_artist)) {
        $artist_err = "Please enter an artist.";
    } else {
        $artist = $input_artist;
    }

    // Validate salary
    $input_lyrics = trim($_POST["lyrics"]);
    if (empty($input_lyrics)) {
        $lyrics_err = "Please enter the salary amount.";
    } else {
        $lyrics = $input_lyrics;
    }

    // Check input errors before inserting in database
    if (empty($title_err) && empty($artist_err) && empty($lyrics_err)) {
        // Prepare an update statement
        $sql = "UPDATE songs SET title=?, artist=?, lyrics=? WHERE id=?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_title, $param_artist, $param_lyrics, $param_id);

            // Set parameters
            $param_title = $title;
            $param_artist = $artist;
            $param_lyrics = $lyrics;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
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
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM songs WHERE id = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $title = $row["title"];
                    $artist = $row["artist"];
                    $lyrics = $row["lyrics"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($conn);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the song record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
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
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>