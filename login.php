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
				<h2 class="intro-text ">Log In</h2>
				<p class="intro-text ">Welcome back! Log in to continue your browsing ^0^</p>
				<div class="form-group formm">
					<form action="register-page.php" method="post" class="test">
						<p><label class="label" for="fname">Email Address: &nbsp;</label>
						<input class="input" type="text" id="fname" name="fname" size="30" maxlength="40" value="<?php if(isset ($_POST['fname'])) echo  $_POST['fname']?>">
						</p>

						<p><label class="label" for="psword1">Password: &nbsp;</label>
						<input class="input" type="password" id="psword1" name="psword1" size="20" maxlength="40" value="<?php if(isset ($_POST['psword1'])) echo  $_POST['psword1']?>">
						</p>

						<p><input class="button"type="submit" id="submit" name="submit" value="Log In"></p>
					</form>
			</div>
			</div>
		</div>
	</body>
	<?php include('templates/footer.php');?>