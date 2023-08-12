<?php
include "./connection.php";
session_start();

$user_id = $_SESSION["user_id"];
$post_id = $_GET["post_id"];

$q = "INSERT INTO likes(post_id,user_id) VALUES($post_id,$user_id)";
$rq = mysqli_query($conn, $q);

if ($rq) {

  $q = "SELECT like_count FROM blog_posts WHERE post_id=$post_id";
  $rq = mysqli_query($conn, $q);

  if (mysqli_num_rows($rq) == 1) {
    $row = mysqli_fetch_assoc($rq);

    // print_r($row);
    $like_count = $row["like_count"];

    if ($like_count == null) {
      $like_count = 1;
    } else {
      $like_count += 1;
    }

    $q = "UPDATE blog_posts SET like_count=$like_count WHERE post_id=$post_id";
    $rq = mysqli_query($conn, $q);

    if ($rq) {
      header("location:dashboard.php");
    } else {
      header("location:dashboard.php");
    }
  }
}

?>