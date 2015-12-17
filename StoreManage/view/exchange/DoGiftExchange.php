<?php

session_start();
header("Content-Type:text/html; charset=utf-8");
include("../connectDBModel/db.php");

		$gdid = $_POST['gdid'];
		$date = date("Y-m-d");


		$stmt = $conn->prepare("UPDATE `giftdetail` SET `changedate`='$date',`change_flag`='Y' WHERE `gd_id` = $gdid ");
		$stmt->execute();


echo '兌換成功!';		

//header('Location: http://140.133.74.58/test/store/StoreManage/view/home/home.php');
		

?>