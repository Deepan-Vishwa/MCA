<?php 

session_start();
extract($_POST);
include 'config.php';


$query = "UPDATE `client` SET `tdc`=$tdc WHERE id=".$clid;

if($conn->query($query) === TRUE){
    echo "1";
}
else{
    echo  $conn -> error;
}



?>