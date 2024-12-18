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
    <h2 class="intro-text intro-text-p mb-4">Factions</h2>
    <p class="intro-text intro-text-p">Click on a faction to check their details! <a data-toggle="collapse" href="#info" role="button" aria-expanded="false" aria-controls="info">Description ↓</a></p>
        <div class="collapse" id="info">
            <div class="card card-body bg-transparent test border-light mb-4" style="white-space: pre-wrap">
                <h4 class="intro-text intro-text-p mb-4">Description</h4>
                <p class="text-justify lh-sm">The mortal beings' speculation of divine intent is a futile endeavor, akin to the irrelevance of a mayfly against the enormity of the cosmos. However, when individuals harbor a shared misconception, they gather as a crowd, giving rise to an added value: the formation of consensus, the transmutation of misconception into a generally accepted solution, and the attraction of the collective... Subsequently, factions naturally emerge.

                Regardless of the size of factions, they all believe that their faith bears the will of the Aeons. Countless factions even claim to be the emissaries of a certain Aeon. Most of the Aeons have found no interest in the ways of these factions. Some, however, find it extremely amusing to watch these ants in their fervent labor. THEY may provide careful guidance, or create mysticism to alter the progress of the faction. This is THEIR way of influencing the world.</p>
            </div>
        </div>
    <table class="table table-dark table-hover">
        <tbody>
        <tr>
            <td>'.$row['lname'].', '.$row['fname'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['regdat'].'</td>
            <td><a href="edit_user.php?id='.$row['user_id'].'"><img src="https://www.clker.com/cliparts/F/P/v/S/q/1/pencil-gray-thick.svg.hi.png" class="but"> </a><a href="delete_user.php?id='.$row['user_id'].'"><img src="https://icons.veryicon.com/png/o/miscellaneous/xboard/delete-203.png" class="but"></a></td>
            <td></td>
        </tr>
        <tr>
            <td>'.$row['lname'].', '.$row['fname'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['regdat'].'</td>
            <td><a href="edit_user.php?id='.$row['user_id'].'"><img src="https://www.clker.com/cliparts/F/P/v/S/q/1/pencil-gray-thick.svg.hi.png" class="but"> </a><a href="delete_user.php?id='.$row['user_id'].'"><img src="https://icons.veryicon.com/png/o/miscellaneous/xboard/delete-203.png" class="but"></a></td>
            <td></td>
        </tr>
        </tbody>
    </table>
</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js"></script> 
</body>
<?php include('templates/footer.php');?>