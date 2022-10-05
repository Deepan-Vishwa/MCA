<?php 

session_start();
extract($_POST);
include 'config.php';
$decoded = json_decode($health, true);

$query = "INSERT INTO `checkin` (`id`, `client_id`, `height`, `weight`, `waist`, `hip`, `neck`, `cheat_meal`, `fat`, `muscle`,`entry_date`) VALUES (NULL, ".$_SESSION["clientid"].", ".$height.", ".$weight.", ".$waist.", ".$hip.", ".$neck.", 'no', ".$decoded['bodyfat'].", ".$decoded['leanmass'].",CURRENT_TIMESTAMP);";

if($conn->query($query) === TRUE){
    echo "1";
}
// else{
//     echo "Invalid values";
// }



?>