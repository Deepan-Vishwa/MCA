<?php 

session_start();
extract($_POST);
include 'config.php';


$query = "INSERT INTO `workout_chart`(`client_id`, `trainer_id`, `workout`, `sets`, `rep`, `day`) VALUES (".$client_id.",".$_SESSION["trainerid"].",'".$workout."','".$sets."','".$rep."','".$idw."');";

if($conn->query($query) === TRUE){
    echo($conn->insert_id);
   
}
else{
    echo ($mysqli -> error);
}



?>