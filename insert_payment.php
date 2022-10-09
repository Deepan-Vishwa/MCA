<?php 

session_start();
extract($_POST);
include 'config.php';

$date = date('Y-m-d');

$due = date('Y-m-d', strtotime($date. ' + '.$sub_type.' months'));

$query3 = "INSERT INTO `paymet_info`(`client_id`, `date`, `sub_type`, `due`) VALUES (".$_SESSION["clientid"].",'".$date."','".$sub_type."','".$due."');";

if($conn->query($query3) === TRUE){

   echo "1";
}
else{
    echo  $conn -> error;
}
?>