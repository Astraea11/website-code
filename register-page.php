<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/includes.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <?php include('templates/header_landing.php');?>
</head>
<body>
			<div class="intro register">
			<img src="https://motionbgs.com/media/2209/honkai-star-rail.jpg" class="intro-bg ">
				<?php 
					if ($_SERVER['REQUEST_METHOD'] == 'POST'){
						$errors = array(); //set up errors
						if (empty($_POST['fname'])){//if it is empty:
							$errors[] = 'Please enter your first name.';
						}else{//otherwise it places it in variable
							$fn = trim($_POST['fname']);
						//are the lname and emails filled up?
						}
						if (empty($_POST['lname'])){//if it is empty:
							$errors[] = 'Please enter your last name.';
						}else{//otherwise it places it in variable
							$ln = trim($_POST['lname']);
						}
						if (empty($_POST['email'])){//if it is empty:
							$errors[] = 'Please enter your email address.';
						}else{//otherwise it places it in variable
							$e = trim($_POST['email']);
						}
						//are the two password boxes matching?
						if (!empty($_POST['psword1'])){//if theres something inside then it goes inside this nested if
							if($_POST['psword1'] != $_POST['psword2']){//if the passwords are not matching
								$errors[] = 'Passwords are not matching.';
							}else{//if its matching and theres something in it:
								$p = password_hash(trim($_POST['psword1']), PASSWORD_DEFAULT); //password is hashed using an algo that takes up tp 60 chrs for encryption
							}
						}else{//otherwise it goes here and tells you nothing is inside
							$errors[] = 'Please enter your password.';
						}

						//if all the textboxes are filled and no errors are collected:
						if (empty($errors)){
							// Register the user in the database...
							require ('mysqli_connect.php'); // Connect to the db.
							// Make the query:
							$q = "INSERT INTO users (fname, lname, email, psword) VALUES ('$fn', '$ln', '$e', '$p')";		
							$result = @mysqli_query ($dbcon, $q); // Run the query.
							if ($result) { // If it ran OK.
								session_start();
								$_SESSION['user_level'] = '0';
								$_SESSION['user_id'] = mysqli_insert_id($dbcon); 
								header( "Location: register-thanks.php"); 
								exit();	
							} else { // If it did not run OK.
								//Public message:
								echo '<center><h2 class="test">System Error</h2>
								<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p></center>'; 
								// Debugging message:
								echo '<p>' . mysqli_error($dbcon) . '</p>';
							}
							mysqli_close($dbcon); // Close the database connection.
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

				
				<h2 class="intro-text ">Register</h2>
				<p class="intro-text ">Want to be up to date when updates come rolling in? Register now so you'll be the first to know!</p>
				<div class="form-group formm">
					<form action="register-page.php" method="post" class="test">
						<p><label class="label" for="fname">First Name: &nbsp;</label>
						<input class="input" type="text" id="fname" name="fname" size="30" maxlength="40" value="<?php if(isset ($_POST['fname'])) echo  $_POST['fname']?>">
						</p>

						<p><label class="label" for="lname">Last Name: &nbsp;</label>
						<input class="input" type="text" id="lname" name="lname" size="30" maxlength="40" value="<?php if(isset ($_POST['lname'])) echo  $_POST['lname']?>">
						</p>

						<p><label class="label" for="email">Email Address: &nbsp;</label>
						<input class="input" type="text" id="email" name="email" size="30" maxlength="50" value="<?php if(isset ($_POST['email'])) echo  $_POST['email']?>">
						</p>

						<p><label class="label" for="psword1">Password: &nbsp;</label>
						<input class="input" type="password" id="psword1" name="psword1" size="20" maxlength="40" value="<?php if(isset ($_POST['psword1'])) echo  $_POST['psword1']?>">
						</p>

						<p><label class="label" for="psword2">Confirm Password: &nbsp;</label>
						<input class="input" type="password" id="psword2" name="psword2" size="20" maxlength="40" value="<?php if(isset ($_POST['psword2'])) echo  $_POST['psword2']?>">
						</p>

						<p><input class="button"type="submit" id="submit" name="submit" value="Register"></p>
					</form>
			</div>
			</div>
		</div>
	</body>
	<?php include('templates/footer.php');?>