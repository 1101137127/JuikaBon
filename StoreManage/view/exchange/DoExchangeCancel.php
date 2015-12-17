<?php

session_start();
header("Content-Type:text/html; charset=utf-8");
include("../connectDBModel/db.php");

$gdid = $_POST['gdid'];
$memid = $_POST['memid'];
$giftid = $_POST['giftid'];
$giftdetailq = $_POST['giftdetailq'];
$giftq = $_POST['giftq'];
$redpoint = $_POST['redpoint'];

$stmt1 = $conn->prepare("SELECT `total_pt`  
							FROM `point` 
							WHERE `mem_id` = '".$memid."'");
$stmt1->execute();
foreach ($stmt1->fetchAll(PDO::FETCH_ASSOC) as $row) {
	$totalpt = $row['total_pt'];
}

$totalpt = $totalpt-$redpoint;
$giftq = $giftdetailq+$giftq;

$stmt2 = $conn->prepare("UPDATE `gift` SET `Quantity`=$giftq WHERE `gift_id` = $giftid ");
$stmt2->execute();
$stmt3 = $conn->prepare("UPDATE `point` SET `total_pt`=$totalpt WHERE `mem_id` = $memid ");
$stmt3->execute();
$stmt4 = $conn->prepare("DELETE FROM `giftdetail` WHERE `gd_id` = $gdid ");
$stmt4->execute();

echo '成功取消!'
		

?>