<?php 
  $conn = mysqli_connect("localhost","root","","blog");

  if($conn){
    // echo "connection success!";
  }else{
    echo "unable to connect!";
  }
?>