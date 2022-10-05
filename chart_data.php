<?php 

session_start();
extract($_POST);
include 'config.php';


$query = "SELECT `weight`,`fat`,`muscle`,DATE_FORMAT(entry_date,'%b %D') as date_lable FROM `checkin` WHERE client_id = ".$_SESSION["clientid"]."";

$query_result = mysqli_query($conn,$query);

$chart_data = array();

while ($row = mysqli_fetch_assoc($query_result))
    $chart_data[] = $row;

echo (json_encode($chart_data));
// else{
//     echo "Invalid values";
// }



?>