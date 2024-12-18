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
    <h2 class="intro-text intro-text-p mb-4">Character Story List</h2>
    <p class="intro-text intro-text-p">Click on a character to check their story details!<a data-toggle="collapse" href="#info" role="button" aria-expanded="false" aria-controls="info"> More Information ↓</a></p>
        <div class="collapse" id="info">
            <div class="card card-body bg-transparent test border-light small-header">
            Characters are obtainable units in Honkai: Star Rail. They follow a specific Path, are aligned with an Element, and are able to be equipped with Relics and a Light Cone that aligns with their Path.
            </div>
        </div>
        <?php
        // Database connection
        require("mysqli_connect.php");

        // Query to fetch all characters
        $q = "SELECT * FROM characters ORDER BY entry_num DESC"; 
        $result = @mysqli_query($dbcon, $q);

        // Check if the query was successful
        if ($result){
            echo '<div class="row align-items-start">';
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $id = $row['entry_num']; // where it bases entries, it'll display in that order
                $name = $row['name'];
                $image = $row['imagedata']; // image URL
                $details = $row['details']; // character details
                $part1 =  $row['part1']; // stories
                $part2 =  $row['part2'];
                $part3 =  $row['part3'];
                $part4 =  $row['part4'];
                
                echo '
                    <div class="col mb-3">
                        <div class="card bg-transparent border-light" data-toggle="modal" data-target="#modal-' . $id . '">
                            <img src="' . $image . '" class="card-img-top" alt="' . $name . ' Image" style="width: 110px; margin: 0 auto; display: block;">
                            <div class="text-center">
                                <h6 class="card-title test">' . $name . '</h6>
                            </div>
                        </div>
                    </div>';

                echo '<div class="modal fade" id="modal-' . $id . '" tabindex="-1" role="dialog" aria-labelledby="modalLabel-' . $id . '" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modalLabel-' . $id . '"><img src="' . $image . '" alt="Character Image"  style="width: 80px"><strong class="padd"> ' . $name . '</strong></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="test">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="white-space: pre-wrap">
                                    <h3>Character Details</h3>
                                    <p class="text-justify text-break">' . $details . '</p>
                                    <hr>
                                    <h3>Character Story: Part I</h3>
                                    <p>• Unlocked at Character Level 20</p>
                                    <p class="text-justify text-break">'.$part1.'</p>
                                    <hr>
                                    <h3>Character Story: Part II</h3>
                                    <p>• Unlocked at Character Level 40</p>
                                    <p class="text-justify text-break">'.$part2.'</p>
                                    <hr>
                                    <h3>Character Story: Part III</h3>
                                    <p>• Unlocked at Character Level 60</p>
                                    <p class="text-justify text-break">'.$part3.'</p>
                                    <hr>
                                    <h3>Character Story: Part IV</h3>
                                    <p>• Unlocked at Character Level 80</p>
                                    <p class="text-justify text-break">'.$part4.'</p>
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