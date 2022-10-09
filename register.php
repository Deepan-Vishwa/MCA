<?php 

session_start();
extract($_POST);
include 'config.php';


$query = "INSERT INTO `client`(`trainer_id`, `email`, `name`, `contact`, `dob`, `password`, `gender`, `Address`, `alcohol`, `smoke`, `activity_level`, `goal`, `profession`, `meal_type`, `medical`) VALUES 
                              (".$trainer.",'".$email."','".$name."','".$contact."','".$dob."','".$password."','".$gender."','".$address."','".$alcohol."','".$smoke."',".$activity_level.",'".$goal."','".$profession."','".$meal_type."','".$medical."');";

if($conn->query($query) === TRUE){

    $client_id = $conn->insert_id;

    
    $query2 = "INSERT INTO `checkin`(`client_id`, `height`, `weight`, `waist`, `hip`, `neck`, `cheat_meal`, `fat`, `muscle`, `bmr`, `tdee`, `entry_date`,`status`) VALUES 
                                    (".$client_id.",".$height.",".$weight.",".$waist.",".$hip.",".$neck.",'no',".$bodyfat.",".$leanmass.",".$bmr.",".$tdee.",CURRENT_TIMESTAMP,'pending');";


if($conn->query($query2) === TRUE){

    $due = date('Y-m-d', strtotime($to_date. ' + '.$payment.' months'));

    $query3 = "INSERT INTO `paymet_info`(`client_id`, `date`, `sub_type`, `due`) VALUES (".$client_id.",'".$to_date."',".$payment.",'".$due."');";

    if($conn->query($query3) === TRUE){

        header('Location: '.'index.html');
    }
    else{
        echo  $conn -> error;
    }


}
else{
    echo  $conn -> error;
}
}

else{
    echo  $conn -> error;
}


//  print_r($_POST); 
?>