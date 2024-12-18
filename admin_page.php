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
    <h1 class="intro-text d-flex justify-content-around intro-text-p">Admin Dashboard</h1><br>
    <div class="container d-flex justify-content-center">
        <img src="https://images.klipfolio.com/website/public/4f49d6ee-0646-4efc-8eb0-e7135e5ee64a/marketing%20dashboard%20example.png" class="rounded mx-auto d-block">
        </div>
    </div>
</body>
<?php include('templates/footer.php');?>
