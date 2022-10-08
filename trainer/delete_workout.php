<?php 

session_start();
extract($_POST);
include 'config.php';


$query = "DELETE from workout_chart WHERE id =".$id.";";

if($conn->query($query) === TRUE){
    echo "1";
}
// else{
//     echo "Invalid values";
// }



?>