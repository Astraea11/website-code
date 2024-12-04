<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/includes.css">
    <title>Edit a Record</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <?php include('templates/header_admin.php');?>
    
</html>
<body>
    <div class="intro">
    <img src="https://i.redd.it/zf4z6utfezua1.png" class="intro-bg">
        <h1 class="intro-text intro-text-h">Editing Information...</h1><br>
        <?php
            //checking for valid id number
                if((isset($_GET['id'])) && (is_numeric($_GET['id']))){
                    $id = $_GET['id'];
                }elseif((isset($_POST['id'])) && (is_numeric($_POST['id']))){
                    $id = $_POST['id'];
                }else{ //no received valid number
                    echo "<p class='intro-text intro-text-p'>You're not supposed to be here. You can head back to the<a href='index.php'> Homepage</a> or <a href='register-page.php'>Register</a>. :>";
                    exit();
                }
                require('mysqli_connect.php');
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    if($_POST['sure'] == 'Update'){ //if user said yes
                        ?>
                        <form action="edit_user.php" method="post">
                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($fname); ?>">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name:</label>
                            <input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($lname); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                        </div>
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                        <button type="submit" name="sure" value="Update" class="btn btn-secondary btn-lg">Update</button>
                
                    </form>   
                    <?php
                        $q ="UPDATE users SET 
                        fname = '".mysqli_real_escape_string($dbcon, $_POST['fname'])."', lname = '" . mysqli_real_escape_string($dbcon, $_POST['lname']) . "', email = '" . mysqli_real_escape_string($dbcon, $_POST['email']) . "' WHERE user_id = '$id'"; //edit details

                        $result = @mysqli_query($dbcon, $q);
                        if(mysqli_affected_rows($dbcon) == 1){
                            echo '<p class="intro-text intro-text-p">Record altered successfully. Do you wish to <a href="register-view-users.php"> edit some more?</a></p>';
                        }else{
                            echo '<p class="intro-text intro-text-p">There was something wrong, the data could not be edited.</p>';
                        }
                    }else{//user pressed no
                        echo '<p class="intro-text intro-text-p">Record was not altered. Head back?<a href="register-view-users.php"> View Users</a></p>';
                    }

                }else{//display details of user before editing
                    $q = "SELECT CONCAT(fname,' ',lname) from users where user_id=$id";
                    $result = @mysqli_query($dbcon, $q);
                    if(mysqli_num_rows($result) == 1){
                        $row = mysqli_fetch_array($result, MYSQLI_NUM);
                        echo "<div class='p-4 text-center form-group formm'><p class='confirm' intro-text intro-text-p>Are you sure you want to edit $row[0]?</h2>";
                        echo '
                            <form action="edit_user.php" method="post">
                            <input id="submit-yes" type="submit" name="sure" value="Yes" class="btn btn-secondary btn-lg wide">
                            <input id="submit-yes" type="submit" name="sure" value="No" class="btn btn-secondary btn-lg wide">
                            <input type="hidden" name="id" value="'.$id.'">
                            </div>
                            </form>
                        ';
                    }else{ //not valid id
                        echo '<p class="intro-text intro-text-p">User not found, do you wish to register?<a href="register-page.php"> Register here</a></p>';
                    }
                }
                mysqli_close($dbcon);
            ?>   
    </div>
    <?php include('templates/footer.php');?>
    </body>