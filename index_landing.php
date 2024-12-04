<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/includes.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <?php include('templates/header_landing.php');?>
    
</html>
<body>
    <div class="intro container">
        <img src="https://upload-os-bbs.hoyolab.com/upload/2021/10/29/172534910/49bfb2bafbce2f65edcdd5908c8c2224_7853250582771087509.jpg" class="intro-bg">
        <img src="https://preview.redd.it/what-is-the-font-for-the-hsr-logo-v0-06d75o5cvn3b1.png?width=1290&format=png&auto=webp&s=6f720d993f23ba56cb4ab7931320f091d45c9973" class="overlay-logo">
        <h1 class="intro-text intro-text-h">Welcome to the Honkai: Star Rail Story Archives</h1><br>
        <p class="intro-text intro-text-p">The images and text used in the website are only for better representation of the game data, and their copyright belongs to © COGNOSPHERE PTE. LTD</p>
        <h2 class="intro-text test small-header">Register or Log in to learn more!:</h2>
        <div class="p-4 text-center form-group formm">
        <form action="delete_user.php" method="post"> 
            <a href="register-page.php"><input id="" type="" value="Register" class="btn btn-secondary btn-lg wide"></a>
            <a href="login.php"><input id="" type="" value="Log In" class="btn btn-secondary btn-lg wide"></a>
            <input type="hidden" name="id" value="'.$id.'">
            </form>
        </div>    
    </div>
</body>
<?php include('templates/footer.php');?>
