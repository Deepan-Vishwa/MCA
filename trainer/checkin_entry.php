<?php 

session_start();
extract($_POST);
include 'config.php';
date_default_timezone_set('Asia/Kolkata');
$decoded = json_decode($health, true);
$date = date('Y-m-d');
$query = "INSERT INTO `checkin` (`id`, `client_id`, `height`, `weight`, `waist`, `hip`, `neck`, `cheat_meal`, `fat`, `muscle`,`entry_date`,`status`) VALUES (NULL, ".$_SESSION["trainerid"].", ".$height.", ".$weight.", ".$waist.", ".$hip.", ".$neck.", 'no', ".$decoded['bodyfat'].", ".$decoded['leanmass'].",'".$date."','pending');";

if($conn->query($query) === TRUE){
    echo "1";
}
// else{
//     echo "Invalid values";
// }



?>