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

<body>
			<div class="intro container register">
				<?php 
					if ($_SERVER['REQUEST_METHOD'] == 'POST'){
						$errors = array(); //set up errors
						if (empty($_POST['name'])){//if it is empty:
							$errors[] = 'Please enter the event name.';
						}else{//otherwise it places it in variable
							$n = trim($_POST['name']);
						//are the lname and emails filled up?
						}
						if (empty($_POST['imagedata'])){//if it is empty:
							$errors[] = 'Please enter the link to the event thumbnail.';
						}else{//otherwise it places it in variable
							$img = trim($_POST['imagedata']);
						}
						if (empty($_POST['overview'])){//if it is empty:
							$errors[] = 'Please enter the event overview.';
						}else{//otherwise it places it in variable
							$o = trim($_POST['overview']);
						}
						//if all the textboxes are filled and no errors are collected:
                            if (empty($errors)) {
                                require('mysqli_connect.php'); // Connect to the database
                        
                                // Prepare the query
                                $stmt = $dbcon->prepare(
                                    "INSERT INTO memoir (name, imagedata, overview) 
                                     VALUES (?, ?, ?)"
                                );
                        
                                // Bind parameters (4 strings, so use "ssss")
                                $stmt->bind_param("sss", $n, $img, $o);
                        
                                // Execute the statement
                                if ($stmt->execute()) {
                                    echo '<p class="intro-text-p test">Conventional Memoir entry successfully added. You can check at <a href="memoir.php" target="_blank">Memoir page.</a> or add more: <a href="add_mem.php">Add More Events.</a></p>';
                                } else {
                                    echo '<p>Error: ' . $stmt->error . '</p>';
                                }
                        
                                // Close the statement and connection
                                $stmt->close();
                                $dbcon->close(); // Close the database connection.
							// Include the footer and quit the script:
							include ('templates/footer.php');
							exit();
						}else{//what if theres an error?
							echo '<h2 class="error2">Error.</h2>
							<p class="error">The following error(s) have occured:<br/>
							';
							foreach($errors as $msg){
								echo "> $msg<br/>";
							}
							echo '</p><h4 class="error2">Please try again.</h2><br/><br/>';
						}
					}
				?>

				
				<h2 class="intro-text ">Add Conventional Memoir Data</h2>
				<p class="intro-text ">This is just for adding new events to the database.</p>
				<div class="form-group formm">
					<form action="add_mem.php" method="post" class="test">
						<p><label class="label" for="name">Name: &nbsp;</label>
						<input class="input" type="text" id="name" name="name" size="30" maxlength="40" value="<?php if(isset ($_POST['name'])) echo  $_POST['name']?>">
						</p>

						<p><label class="label" for="imagedata">Thumbnail Link: &nbsp;</label>
						<textarea class="input" id="imagedata" name="imagedata" rows="3" cols="50"><?php if(isset ($_POST['imagedata'])) echo  $_POST['imagedata']?></textarea>
                        </p>
                        <p><label class="label" for="overview">Event Overview: &nbsp;</label>
                        <textarea class="input" id="overview" name="overview" rows="6" cols="50"><?php if(isset($_POST['overview'])) echo $_POST['overview']; ?></textarea>
                        </p>

						<p><input class="button"type="submit" id="submit" name="submit" value="Add Data to Database"></p>
					</form>
			</div>
			</div>
		</div>
	</body>
	<?php include('templates/footer.php');?>