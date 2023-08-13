<?php
if (isset($_GET['data'])) {
  $data = $_GET['data'];

  // echo $data;

  $decodeData = base64_decode($data);

  // echo $jsonData;
  $jsonData = json_decode($decodeData);

  $post_id = $jsonData->post_id;
  $user_id = $jsonData->user_id;
  $package_id = $jsonData->package_id;

  echo $post_id . "</br>";
  echo $user_id . "</br>";
  echo $package_id . "</br>";

  $q = "INSERT INTO compaign(user_id,post_id,pakage_id,start_date,end_date) VALUE ($user_id,$post_id,$package_id,'val','val')";
  echo $q;
} else {
  header("location:dashboard.php");
}
?>