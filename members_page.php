<?php
    session_start();
    if(!isset($_SESSION['user_level'])){
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/includes.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <?php include('templates/header.php');?>
    
<>
    <div class="intro container">
        <img src="https://i.pinimg.com/736x/38/b7/65/38b7651e3990033fc120a10352d01b4b.jpg" class="intro-bg-half">
        <img src="https://preview.redd.it/what-is-the-font-for-the-hsr-logo-v0-06d75o5cvn3b1.png?width=1290&format=png&auto=webp&s=6f720d993f23ba56cb4ab7931320f091d45c9973" class="header-smol mt-4">
        <h2 class="intro-text intro-header">Welcome to the Honkai: Star Rail Story Archives!</h2><br>
        <p class="intro-text intro-text-p">HSRSA is a website that aims to provide a minimalist archive to read Honkai: Star Rail stories and character lore.</p>
        <p class="intro-text">The images and text used in the website are only for better representation of the game data, and their copyright belongs to © COGNOSPHERE PTE. LTD</p>
        <div class="intro-content-1">
            <h2 class="test small-header mb-4">Updates and Quick Jumps to:</h2>
            <div class="container">
                <div class="row">
                    <?php
                    // Database connection
                    require("mysqli_connect.php");

                    // Query to fetch all characters
                    $q = "SELECT imagedata, name, overview FROM memoir ORDER BY entry_num DESC LIMIT 1"; 
                    $result = @mysqli_query($dbcon, $q);

                    // Check if the query was successful
                    if ($result){
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                            $name = $row['name'];
                            $image = $row['imagedata'];
                            $overview = $row['overview'];

                            // Each character gets its own column
                            echo '
                            <div class="col">
                                <div class="card card-body bg-transparent test border-light mb-4" title="Click on the image beside this to be redirected to the Conventional Memoir page!">
                                <h3 class="test small-header">Latest Conventional Memoir Event:</h3>
                                <h4 class="test small-header">'.$name.'</h4>
                                    '.$overview.'
                                    </div>
                            </div>
                            <div class="col">
                                <a href="memoir.php"><img src="' . $image . '" alt="Latest Memoir Event Image" class="image rounded" title="Click on this to be redirected to the Conventional Memoir page!"></a>
                            </div>';
                        }
                    }
                    mysqli_free_result($result);
                    ?>
                </div>
                <div class="row">
                    <div class="col">
                            <h3 class="test small-header intro-text-p" title="Clicking on an image will not send you to an individual page, but to a page with the entire list.">Latest Character Story List Update:</h3>
                            <div class="row">
                            <?php
                                // Database connection
                                require("mysqli_connect.php");

                                // Query to fetch all characters
                                $q = "SELECT imagedata, name FROM characters ORDER BY entry_num DESC LIMIT 3"; 
                                $result = @mysqli_query($dbcon, $q);

                                // Check if the query was successful
                                if ($result){
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                        $name = $row['name'];
                                        $image = $row['imagedata'];

                                        // Each character gets its own column
                                        echo '
                                        <div class="col mb-4">
                                            <a href="chr_story.php"><img src="' . $image . '" alt="Character Image" class="image-small border border-white rounded" title="Click to be redirected to Character Story page."></a>
                                            <h4 class="test intro-text-p">' . $name . '</h4>
                                        </div>';
                                    }
                                }
                                mysqli_free_result($result);
                                ?>
                                </div>
                        </div>
                    <div class="col ml-5">
                            <h3 class="test small-header intro-text-p" title="Clicking on an image will not send you to an individual page, but to a page with the entire list.">Newly Added Light Cones:</h3>
                            <div class="row">
                            <?php
                                // Database connection
                                require("mysqli_connect.php");

                                // Query to fetch all characters
                                $q = "SELECT imagedata, name FROM l_cones ORDER BY entry_num DESC LIMIT 3"; 
                                $result = @mysqli_query($dbcon, $q);

                                // Check if the query was successful
                                if ($result){
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                        $name = $row['name'];
                                        $image = $row['imagedata'];

                                        // Each lc gets its own column
                                        echo '
                                        <div class="col mb-4">
                                            <a href="l_cones.php"><img src="' . $image . '" alt="Light Cone Image" class="image-small border border-white rounded" title="Click to be redirected to Light Cones page."></a>
                                            <h4 class="test intro-text-p">' . $name . '</h4>
                                        </div>';
                                    }
                                }
                                mysqli_free_result($result);
                                ?>
                            </div>
                    </div>
                </div>
            <!--    <div class="row">
                    <div class="col-md-3 col-lg-2 mb-3">
                    <a href="memoir.php" class="text-decoration-none">
                        <div class="card bg-transparent border-light button_size">
                            <img src="" alt="' . $name . ' Image" class="button_image">
                            <div class="card-body">
                                <h6 class="card-title test text-decoration-none">Conventional Memoir</h6>
                            </div>
                        </div>
                        </a>
                        </div>
                    
                    <div class="col-md-3 col-lg-2 mb-3">
                    <a href="chr_story.php" class="text-decoration-none">
                        <div class="card bg-transparent border-light button_size">
                            <img src="templates/chr_story.jpeg" class="button_image" alt="Character Story Screenshot">
                            <div class="card-body">
                                <h6 class="card-title test text-decoration-none">Character Story</h6>
                            </div>
                        </div>
                        </a>
                    </div>
                    
                    <div class="col-md-3 col-lg-2 mb-3">
                    <a href="l_cones.php" class="text-decoration-none">
                        <div class="card bg-transparent border-light button_size">
                            <img src="templates/l_cones.jpeg" alt="Light Cones Screenshot" class="button_image">
                            <div class="card-body">s
                                <h6 class="card-title test text-decoration-none">Light Cones</h6>
                            </div>
                        </div>
                        </a>
                        </div>
                    
                    <div class="col-md-3 col-lg-2 mb-3">
                    <a href="factions.php" class="text-decoration-none">
                        <div class="card bg-transparent border-light button_size">
                            <img src="" alt="' . $name . ' Image" class="button_image">
                            <div class="card-body">
                                <h6 class="card-title test text-decoration-none">Factions</h6>
                            </div>
                        </div>
                        </a>
                        </div>
                    
                </div>-->                
                <div class="row">
                    <div class="col">
                        <h3 class="test small-header mb-4">Links You May Be Interested In:</h3>
                        <div class="row">
                            <div class="col">
                            <div class="card card-body bg-transparent test border-light mb-4" title="Click this to download the game!"><a href="https://hsr.hoyoverse.com/en-us/" class="btn" target="_blank"><h5 class="test">Honkai: Star Rail Official Website for Download</h5></a></div>
                            </div>
                            <div class="col"> 
                            <div class="card card-body bg-transparent test border-light mb-4" title="Click this to visit their official YouTube channel!"><a href="https://youtube.com/@honkaistarrail?si=UDQhCsLSlk2AWxII" class="btn" target="_blank"><h5 class="test">Honkai: Star Rail Official Youtube Channel</h5></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>

        </div>
                            
</body>
<?php include('templates/footer.php');?>
