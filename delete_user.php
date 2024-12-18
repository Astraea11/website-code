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
    <title>Delete a Record</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <?php include('templates/header_admin.php');?>
    
<body>
    <div class="intro d-lg-flex justify-content-sm-center">
    <img src="https://i.redd.it/zf4z6utfezua1.png"  class="intro-bg">
        <div class="intro container">
        <h1 class="intro-text intro-text-h">Deleting Record...</h2>
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
                    if($_POST['sure'] == 'Yes'){ //if user said yes
                        $q ="DELETE FROM users WHERE user_id='$id'"; //delete specific user
                        $result = @mysqli_query($dbcon, $q);
                        if(mysqli_affected_rows($dbcon) == 1){
                            echo '<p class="intro-text intro-text-p">Record deleted successfully. Do you wish to <a href="register-view-users.php"> delete more?</a></p>';
                        }else{
                            echo '<p class="intro-text intro-text-p">There was something wrong, the data could not be deleted.</p>';
                        }
                    }else{//user pressed no
                        echo '<p class="intro-text intro-text-p">Record was not deleted. Head back?<a href="register-view-users.php"> View Users</a></p>';
                    }

                }else{//display details of user before deletion
                    $q = "SELECT CONCAT(fname,' ',lname) from users where user_id=$id";
                    $result = @mysqli_query($dbcon, $q);
                    if(mysqli_num_rows($result) == 1){
                        $row = mysqli_fetch_array($result, MYSQLI_NUM);
                        echo "<div class='p-4 text-center form-group formm'> <p class='confirm' intro-text intro-text-p>Are you sure you want to delete $row[0]?</h2>";
                        echo '
                            <form action="delete_user.php" method="post"> 
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
    </div>
</body>
<?php include('templates/footer.php');?>
