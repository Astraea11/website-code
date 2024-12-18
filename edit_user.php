<?php
    session_start();
    if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1)){
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/includes.css">
    <title>Edit a Record</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <?php include('templates/header_admin.php');?>

<body>
<div class="intro container">
        <img src="https://i.redd.it/zf4z6utfezua1.png" class="intro-bg">
        <h1 class="intro-text introo">Editing Information...</h1><br>

        <?php
        // Checking for valid ID number
        if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
            $id = $_GET['id'];
        } elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
            $id = $_POST['id'];
        } else { // No received valid number
            echo "<p class='intro-text intro-text-p'>You're not supposed to be here. You can head back to the <a href='index.php'>Homepage</a> or <a href='register-page.php'>Register</a>.</p>";
            exit();
        }

        require('mysqli_connect.php');

        // Display details of user before editing
        $q = "SELECT fname, lname, email FROM users WHERE user_id=$id";
        $result = @mysqli_query($dbcon, $q);

        // If form has been submitted with "No"
        if (isset($_POST['sure']) && $_POST['sure'] == 'No') {
            echo '<p class="intro-text intro-text-p">Record was not altered. Head back? <a href="register-view-users.php">Return to View Users.</a></p>';
        } 
        // If form has been submitted with "Yes"
        elseif (isset($_POST['sure']) && $_POST['sure'] == 'Yes') {
            // Get the updated values from the form
            $fname = mysqli_real_escape_string($dbcon, trim($_POST['fname']));
            $lname = mysqli_real_escape_string($dbcon, trim($_POST['lname']));
            $email = mysqli_real_escape_string($dbcon, trim($_POST['email']));

            if ($fname && $lname && $email) {
                // Update the user record
                $q = "UPDATE users SET fname='$fname', lname='$lname', email='$email' WHERE user_id=$id";
                $result = @mysqli_query($dbcon, $q);

                if (mysqli_affected_rows($dbcon) == 1) {
                    echo '<p class="intro-text intro-text-p">Record altered successfully. <a href="register-view-users.php"> Return to View Users.</a></p>';
                } else {
                    echo '<p class="intro-text intro-text-p">No change has been done, and so the data could not be edited. <a href="register-view-users.php">Return to View Users.</a></p>';
                }
            } else {
                echo '<p class="intro-text intro-text-p">Please fill out all fields.</p>';
            }
        } else {
            // Display confirmation message and form with pre-filled values
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                echo "<div class='p-4 text-center form-group formm'>
                        <p class='confirm intro-text mt-1'>Are you sure you want to edit {$row['fname']} {$row['lname']}?</p>
                        <form action='edit_user.php' method='post'>
                                <label class='label' for='fname'>First Name:</label>
                                <input class='input' type='text' id='fname' name='fname' value='" . htmlspecialchars($row['fname']) . "' required>
                                <label class='label' for='lname'>Last Name:</label>
                                <input class='input' type='text' id='lname' name='lname' value='" . htmlspecialchars($row['lname']) . "' required>
                                <label class='label' for='email'>Email:</label>
                                <input class='input' type='email' id='email' name='email' value='" . htmlspecialchars($row['email']) . "' required>
                            <input type='hidden' name='id' value='$id'>
                            <input id='submit-yes' type='submit' name='sure' value='Yes' class='btn btn-secondary btn-lg wide'>
                            <input id='submit-no' type='submit' name='sure' value='No' class='btn btn-secondary btn-lg wide'>
                        </form>
                    </div>";
            }
        }

        mysqli_close($dbcon);
        ?>
    </div>
    <?php include('templates/footer.php');?>
    </body>