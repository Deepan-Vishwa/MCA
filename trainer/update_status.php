<?php 

session_start();
extract($_POST);
include 'config.php';


$query = "UPDATE `checkin` SET `status`='done' WHERE client_id=".$cid;

if($conn->query($query) === TRUE){
    echo "1";
}
else{
    echo  $conn -> error;
}



?>