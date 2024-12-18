<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/includes.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <?php include('templates/header_landing.php');?>
</head>
<body>
			<div class="intro register mb-4">
			<img src="https://motionbgs.com/media/2209/honkai-star-rail.jpg" class="intro-bg">
			<?php 
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					require('mysqli_connect.php');
					if(empty($_POST['email'])){
						echo '<h2 class="error2">Error.</h2>
							<p class="error">Please input your email address.</p>';
					}else{
						$e = trim($_POST['email']);
					}

					if(empty($_POST['psword'])){
						echo '<h2 class="error2">Error.</h2>
							<p class="error">Please input your password..</p>';
					}else{
						$p = trim($_POST['psword']);
					}
					if($e && $p){
						$q = "SELECT user_id, fname, user_level, psword FROM users WHERE email = '$e'";
						$result = @mysqli_query($dbcon, $q);

						if(@mysqli_num_rows($result) == 1){
							$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
							if (password_verify($p, $row['psword'])){
								session_start();
								$_SESSION = $row;
								$_SESSION['user_level'] = (int) $_SESSION['user_level'];
								$url = ($_SESSION['user_level'] === 1) ? 'admin_page.php' : 'members_page.php';
								header('Location: '.$url);
								mysqli_free_result($result);
								mysqli_close($dbcon);
								exit();
							}else{
								echo '<p class="error">Email or password does not match.</p>';
							}
						}else{
							echo '<h2 class="error2">Error.</h2> <p class="error">Please register instead.</p>';
						}
					}else{
						echo '<p class="error">An error occured. Please try again.</p>';
					}
					mysqli_close($dbcon);
				}
				

			?>	
				<h2 class="intro-text ">Log In</h2>
				<p class="intro-text ">Welcome back! Log in to continue your browsing ^0^</p>
				<div class="form-group formm">
					<form action="login.php" method="post" class="test">
						<p><label class="label" for="email">Email Address: &nbsp;</label>
						<input class="input" type="text" id="email" name="email" size="30" maxlength="50" value="<?php if(isset ($_POST['email'])) echo  $_POST['email']?>">
						</p>

						<p><label class="label" for="psword">Password: &nbsp;</label>
						<input class="input" type="password" id="psword" name="psword" size="20" maxlength="40" value="<?php if(isset ($_POST['psword'])) echo  $_POST['psword']?>">
						</p>

						<p><input class="button"type="submit" id="submit" name="submit" value="Log In"></p>
					</form>
			</div>
			</div>
		</div>
	</body>
	<?php include('templates/footer.php');?>