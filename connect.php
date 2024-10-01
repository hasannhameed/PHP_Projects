<?php
  
  $host = 'localhost';
  $user = "root";
  $password = "";
  $db = "test";

  try{
    $conn = new mysqli($host, $user,$password,$db);
  if($conn->connect_error){
    die(mysqli_error($conn));
  }
 

  }catch( Exception $e){
    echo $e;
  }
  