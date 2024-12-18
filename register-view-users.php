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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <?php include('templates/header_admin.php');?>
    
</html>
<body>
    <div class="intro container">
       <h2 class="intro-text intro-text-p">List of Registered Users</h2>
       <p class="test">
       <?php 
       //require db connection
            require("mysqli_connect.php");
            $q = "SELECT fname, lname, email, DATE_FORMAT(registration_date, '%M %d, %Y') AS regdat, user_id from users ORDER BY user_id ASC";
            $result = @mysqli_query($dbcon, $q);
        //if query is successful
            if ($result) { 
                echo '<table class="table table-hover table-dark test">
                <thead>
                    <tr>
                    <th scope="col"><strong>Name</strong></th>
                    <th scope="col"><strong>Email</strong></th>
                    <th scope="col"><strong>Date Registered</strong></th>
                    <th scope="col"><strong>Actions</strong></th>
                    </tr>
                </thead>
                ';
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo '
                    <tbody>
                        <tr>
                        <td>'.$row['lname'].', '.$row['fname'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['regdat'].'</td>
                        <td><a href="edit_user.php?id='.$row['user_id'].'"><img src="https://www.clker.com/cliparts/F/P/v/S/q/1/pencil-gray-thick.svg.hi.png" class="but"> </a><a href="delete_user.php?id='.$row['user_id'].'"><img src="https://icons.veryicon.com/png/o/miscellaneous/xboard/delete-203.png" class="but"></a></td>
                        <td></td>
                        </tr>
                    </tbody>
                    ';
                    
                
                }
                echo '</table>';
                mysqli_free_result($result);
            } else {
                echo '<center><h2 class="test">System Error</h2>
					<p class="error">The current registered users could not be retrieved due to a system error. Please contact the system administrator.</p></center>'; 
				// Debugging message:
				echo '<p>' . mysqli_error($dbcon) . '</p>';			
            }
            mysqli_close($dbcon);
       ?>
       </p>
    </div>
</body>
<?php include('templates/footer.php');?>
</html>
