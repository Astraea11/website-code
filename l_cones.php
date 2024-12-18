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

<body>
    <div class="intro d-flex container mt-4">
    <h2 class="intro-text intro-text-p mb-4">Light Cones</h2>
    <p class="intro-text intro-text-p">Click on a light cone to check its story details! <a data-toggle="collapse" href="#info" role="button" aria-expanded="false" aria-controls="info">More Information ↓</a></p>
        <div class="collapse" id="info">
            <div class="card card-body bg-transparent test border-light mb-4">
            Light Cones are Garden of Recollection technology. Created from refined memory fragments, they can contain not only memories, but also experiences and abilities. Because of this, they're under heavy restriction by the Interastral Peace Corporation.
            </div>
        </div>
        <?php
        // Database connection
        require("mysqli_connect.php");

        // Query to fetch all characters
        $q = "SELECT * FROM l_cones ORDER BY entry_num DESC"; 
        $result = @mysqli_query($dbcon, $q);

        // Check if the query was successful
        if ($result){
            echo '<div class="row">';
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $id = $row['entry_num']; // where it bases entries, it'll display in that order
                $name = $row['name'];
                $image = $row['imagedata']; // image URL
                $rarity = $row['rarity']; // rarity url
                $desc =  $row['description']; // description
                $full = $row['full_art']; //png art of lc
                
                echo '
                    <div class="col mb-3">
                        <div class="card bg-transparent border-light" data-toggle="modal" data-target="#modal-' . $id . '">
                            <img src="' . $image . '" class="card-img-top" alt="' . $name . ' Image"  style="width: 120px; margin: 0 auto; display: block;">
                            <div class="text-center pb-2">
                                <h6 class="card-title test">' . $name . '</h6>
                                <img src="' . $rarity . '" class="image-tiny mb-2" alt="Rarity">
                            </div>
                        </div>
                    </div>';

                echo '<div class="modal fade" id="modal-' . $id . '" tabindex="-1" role="dialog" aria-labelledby="modalLabel-' . $id . '" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="row">
                                        <div class="col">
                                            <h4 class="modal-title" id="modalLabel-' . $id . '"><img src="' . $image . '" alt="Character Image"  style="width: 80px; height: auto;"><strong class="padd"> ' . $name . '</strong></h4>
                                        </div>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="test">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center " style="white-space: pre-wrap">
                                    <h3>Light Cone Description: </h3>
                                    <p class="text-justify text-break">' . $desc . '</p>
                                    <hr>
                                    <h3>Full Light Cone Art:</h3>
                                    <center><img src="' . $full . '" class="image-medium" alt="' . $name . ' Image"></center>
                                    ';
                                echo '</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>';

                    }
                    echo '</div>';
                    mysqli_free_result($result);
                } else {
                    echo '<center><h2 class="test">System Error</h2>
                        <p class="error">The character data could not be displayed, please try again.</p></center>'; 
                    // Debugging message:
                    echo '<p>' . mysqli_error($dbcon) . '</p>';			
                }
                mysqli_close($dbcon);
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js"></script> 
</body>
<?php include('templates/footer.php');?>