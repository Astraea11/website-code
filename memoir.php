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
<?php include('templates/header.php'); ?>

<body>
    <div class="intro d-flex container mt-4">
    <h2 class="intro-text intro-text-p mb-4">Conventional Memoir</h2>
        <p class="intro-text intro-text-p">Click on a quest to see its overview! 
            <a data-toggle="collapse" href="#info" role="button" aria-expanded="false" aria-controls="info"> More Information ↓</a>
        </p>

        <div class="collapse" id="info">
            <div class="card card-body bg-transparent test border-light small-header">
                <p class="text-justify lh-sm">The Conventional Memoir is a gameplay system that allows Trailblazers to experience certain time-limited events after the event period has ended. Events that are recorded in the conventional memoir will have an Icon Conventional Memoir icon shown in the top left of the event image in the Travel Log.
                <br><br>
                Some events have the "Conventional Memoir" icon. When the event finishes, it will be included in Conventional Memoir for Trailblazers to experience the relevant game modes and stories at their own pace.</p>
            </div>
        </div>
        
        <?php
        // Database connection
        require("mysqli_connect.php");

        // Query to fetch all characters
        $q = "SELECT * FROM memoir ORDER BY entry_num DESC"; 
        $result = @mysqli_query($dbcon, $q);

        // Check if the query was successful
        if ($result) {
            echo '<div class="row align-items-start">';
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $id = $row['entry_num']; // entry order
                $name = $row['name']; // quest name
                $image = $row['imagedata']; // link of thumbnail
                $details = $row['overview']; // quest overview

                echo '
                <table class="table table-dark table-hover align-middle">
                    <tbody>
                        <tr data-toggle="collapse" data-target="#overview-' . $id . '" role="button" aria-expanded="false" aria-controls="overview-' . $id . '">
                            <td class="col-2"><img src="' . $image . '" alt="' . $name . ' Image" style="width: 250px"></td>
                            <td class="col-10" style="vertical-align: middle;"><h4 class="test">' . $name . '</h4></td>
                        </tr>
                    </tbody>
                </table> 
                
                <div class="collapse" id="overview-' . $id . '">
                        <div class="card card-body bg-transparent border-light test small-header" style="width: 1100px">
                            <div>
                                <img src="https://static.wikia.nocookie.net/houkai-star-rail/images/2/23/Icon_Map_Adventure_Mission_Step.png" class="icon-tiny"><h5 class="intro-text intro-text-p mb-3">Quest Overview</h5>
                                <p class="text-justify lh-sm">' . $details . '</p>
                            </div>
                        </div>
                </div>
                ';
            }
            echo '</div>';
            mysqli_free_result($result);
        } else {
            echo '<center><h2 class="test">System Error</h2>
                <p class="error">The data could not be displayed. Please try again.</p></center>';
        }

        mysqli_close($dbcon);
        ?>

    </div> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php include('templates/footer.php'); ?>
