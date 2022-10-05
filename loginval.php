<?php 


extract($_POST);
include 'config.php';

$stmt = $conn->prepare("SELECT * FROM `client` WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if($result->num_rows == 1)
{
    session_start();
    $_SESSION["clientid"] = $row['id'];
  
  echo "1";
}
else{
  echo "0";
}

?>