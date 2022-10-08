<?php 

session_start();
extract($_POST);
include 'config.php';


$query = "INSERT INTO `diet_chart`(`client_id`, `trainer_id`, `meal`, `item`, `quantity`) VALUES (".$client_id.",".$_SESSION["trainerid"].",".$id.",'".$food."','".$quantity."');";

if($conn->query($query) === TRUE){
    echo($conn->insert_id);
}
// else{
//     echo "Invalid values";
// }



?>