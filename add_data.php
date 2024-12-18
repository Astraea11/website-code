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
							$errors[] = 'Please enter the character name.';
						}else{//otherwise it places it in variable
							$n = trim($_POST['name']);
						//are the lname and emails filled up?
						}
						if (empty($_POST['imagedata'])){//if it is empty:
							$errors[] = 'Please enter the link to the character image.';
						}else{//otherwise it places it in variable
							$img = trim($_POST['imagedata']);
						}
						if (empty($_POST['details'])){//if it is empty:
							$errors[] = 'Please enter character details.';
						}else{//otherwise it places it in variable
							$d = trim($_POST['details']);
						}
                        if (empty($_POST['part1'])){//if it is empty:
							$errors[] = 'Please enter corresponding character story.';
						}else{//otherwise it places it in variable
							$p1 = trim($_POST['part1']);
						}
                        if (empty($_POST['part2'])){//if it is empty:
							$errors[] = 'Please enter corresponding character story.';
						}else{//otherwise it places it in variable
							$p2 = trim($_POST['part2']);
						}                        
                        if (empty($_POST['part3'])){//if it is empty:
							$errors[] = 'Please enter corresponding character story.';
						}else{//otherwise it places it in variable
							$p3 = trim($_POST['part3']);
						}                        
                        if (empty($_POST['part4'])){//if it is empty:
							$errors[] = 'Please enter corresponding character story.';
						}else{//otherwise it places it in variable
							$p4 = trim($_POST['part4']);
						}
						//if all the textboxes are filled and no errors are collected:
                            if (empty($errors)) {
                                require('mysqli_connect.php'); // Connect to the database
                        
                                // Prepare the query
                                $stmt = $dbcon->prepare(
                                    "INSERT INTO characters (name, imagedata, details, part1, part2, part3, part4) 
                                     VALUES (?, ?, ?, ?, ?, ?, ?)"
                                );
                        
                                // Bind parameters (7 strings, so use "sssssss")
                                $stmt->bind_param("sssssss", $n, $img, $d, $p1, $p2, $p3, $p4);
                        
                                // Execute the statement
                                if ($stmt->execute()) {
                                    echo '<p class="intro-text-p test">Character successfully added. You can check at <a href="chr_story.php" target="_blank">Character Story page.</a> or add more: <a href="add_data.php">Add Character.</a></p>';
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

				
				<h2 class="intro-text ">Add Character Data</h2>
				<p class="intro-text ">This is just for adding new characters to the database.</p>
				<div class="form-group formm">
					<form action="add_data.php" method="post" class="test">
						<p><label class="label" for="name">Name: &nbsp;</label>
						<input class="input" type="text" id="name" name="name" size="30" maxlength="40" value="<?php if(isset ($_POST['name'])) echo  $_POST['name']?>">
						</p>

						<p><label class="label" for="imagedata">Image Link: &nbsp;</label>
						<textarea class="input" id="imagedata" name="imagedata" rows="3" cols="50"><?php if(isset ($_POST['imagedata'])) echo  $_POST['imagedata']?></textarea>
                        </p>
                        <p><label class="label" for="details">Character Details: &nbsp;</label>
                        <textarea class="input" id="details" name="details" rows="6" cols="50"><?php if(isset($_POST['details'])) echo $_POST['details']; ?></textarea>
                        </p>
                        <p><label class="label" for="part1">Character Story Part 1: &nbsp;</label>
                        <textarea class="input" id="part1" name="part1" rows="6" cols="50"><?php if(isset($_POST['part1'])) echo $_POST['part1']; ?></textarea>
                        </p>
                        <p><label class="label" for="part2">Character Story Part 2: &nbsp;</label>
                        <textarea class="input" id="part2" name="part2" rows="6" cols="50"><?php if(isset($_POST['part2'])) echo $_POST['part2']; ?></textarea>
                        </p>
                        <p><label class="label" for="part3">Character Story Part 3: &nbsp;</label>
                        <textarea class="input" id="part3" name="part3" rows="6" cols="50"><?php if(isset($_POST['part3'])) echo $_POST['part3']; ?></textarea>
                        </p>
                        <p><label class="label" for="part4">Character Story Part 4: &nbsp;</label>
                        <textarea class="input" id="part4" name="part4" rows="6" cols="50"><?php if(isset($_POST['part4'])) echo $_POST['part4']; ?></textarea>
                        </p>

						<p><input class="button"type="submit" id="submit" name="submit" value="Add Data to Database"></p>
					</form>
			</div>
			</div>
		</div>
	</body>
	<?php include('templates/footer.php');?>