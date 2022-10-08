<?php

//Clever Cloud Config
$dbhost = 'bs9gwtobw71neuxyxi1r-mysql.services.clever-cloud.com';
$dbuser = 'uhshmh5wq8wi2t1s';
$dbpass = 'RBidVQPJ0E61MouNKBnn';
$dbname = 'bs9gwtobw71neuxyxi1r';
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
         if($conn -> connect_errno ) {
            die("Could not connect: " . $mysqli -> connect_error);
         }

// LocalHost Config

      
         // $dbhost = 'localhost';
         // $dbuser = 'root';
         // $dbpass = '';
         // $dbname = 'examterminator';
         // $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
         //          if(! $conn ) {
         //             die("Could not connect: " . mysqli_error($conn));
         //          } 
               

?>