<?php
  header("Content-Type:text/html; charset=utf-8");
  include("../connectDBModel/db.php");
  $coupon_id = $_GET["coupon_id"];

  $url = "coupon.php";

  echo "window.location.href='$url'";
?>