<?php
  header("Content-Type:text/html; charset=utf-8");
  include("../connectDBModel/db.php");
  $coupon_id = $_GET["coupon_id"];
  //$stmt = $conn->prepare("UPDATE `coupon` SET `use_flag`='N' WHERE `coupon_id`='$coupon_id'");
  //$result = $stmt->execute();

  $url = "coupon.php";

  //echo "<script type='text/javascript'>";
  echo "window.location.href='$url'";
  //echo "</script>";  
?>