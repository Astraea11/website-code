<?php
    session_start();
    if(!isset($_SESSION['user_level'])){
        header("Location: login.php");
    }
?>
<?php
	session_start();
		session_unset();   
			session_destroy();  
			header('Location:index.php');
			?>