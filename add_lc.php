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
							$errors[] = 'Please enter the light cone name.';
						}else{//otherwise it places it in variable
							$n = trim($_POST['name']);
						//are the lname and emails filled up?
						}
						if (empty($_POST['imagedata'])){//if it is empty:
							$errors[] = 'Please enter the link to the light cone image.';
						}else{//otherwise it places it in variable
							$img = trim($_POST['imagedata']);
						}
						if (empty($_POST['rarity'])){//if it is empty:
							$errors[] = 'Please enter the link to the light cone rarity.';
						}else{//otherwise it places it in variable
							$r = trim($_POST['rarity']);
						}
                        if (empty($_POST['description'])){//if it is empty:
							$errors[] = 'Please enter corresponding light cone description.';
						}else{//otherwise it places it in variable
							$d = trim($_POST['description']);
						}
                        if (empty($_POST['full_art'])){//if it is empty:
							$errors[] = 'Please enter corresponding light cone full art image.';
						}else{//otherwise it places it in variable
							$f = trim($_POST['full_art']);
						}
						//if all the textboxes are filled and no errors are collected:
                            if (empty($errors)) {
                                require('mysqli_connect.php'); // Connect to the database
                        
                                // Prepare the query
                                $stmt = $dbcon->prepare(
                                    "INSERT INTO l_cones (name, imagedata, rarity, description, full_art) 
                                     VALUES (?, ?, ?, ?, ?)"
                                );
                        
                                // Bind parameters (4 strings, so use "ssss")
                                $stmt->bind_param("sssss", $n, $img, $r, $d, $f);
                        
                                // Execute the statement
                                if ($stmt->execute()) {
                                    echo '<p class="intro-text-p test">Light cone successfully added. You can check at <a href="l_cones.php" target="_blank">Light Cone page.</a> or add more: <a href="add_lc.php">Add Light Cone.</a></p>';
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

				
				<h2 class="intro-text ">Add Light Cone Data</h2>
				<p class="intro-text ">This is just for adding new light cones to the database.</p>
				<div class="form-group formm">
					<form action="add_lc.php" method="post" class="test">
						<p><label class="label" for="name">Name: &nbsp;</label>
						<input class="input" type="text" id="name" name="name" size="40" maxlength="50" value="<?php if(isset ($_POST['name'])) echo  $_POST['name']?>">
						</p>

						<p><label class="label" for="imagedata">Icon Image Link: &nbsp;</label>
						<textarea class="input" id="imagedata" name="imagedata" rows="3" cols="50"><?php if(isset ($_POST['imagedata'])) echo  $_POST['imagedata']?></textarea>
                        </p>
                        <p><label class="label" for="rarity">Rarity Image Link: &nbsp;</label>
                        <textarea class="input" id="rarity" name="rarity" rows="3" cols="50"><?php if(isset($_POST['rarity'])) echo $_POST['rarity']; ?></textarea>
                        </p>
                        <p><label class="label" for="description">Description: &nbsp;</label>
                        <textarea class="input" id="description" name="description" rows="6" cols="50"><?php if(isset($_POST['description'])) echo $_POST['description']; ?></textarea>
                        </p>
                        <p><label class="label" for="full_art">Full Art Image Link: &nbsp;</label>
                        <textarea class="input" id="full_art" name="full_art" rows="3" cols="50"><?php if(isset($_POST['full_art'])) echo $_POST['full_art']; ?></textarea>
                        </p>

						<p><input class="button"type="submit" id="submit" name="submit" value="Add Data to Database"></p>
					</form>
			</div>
			</div>
		</div>
	</body>
	<?php include('templates/footer.php');?>