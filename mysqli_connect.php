<?php 
$dbcon = @mysqli_connect('localhost','marsolamo','marsolamo', 'members_solamo')
OR die('Could not to the MySQL Server: '. mysqli_connect_error());
mysqli_set_charset($dbcon, 'utf8');
