<?php
session_start();

header("Content-Type:text/html; charset=utf-8");
include("../connectDBModel/db.php");


$uptypes=array(
'image/jpg',
'image/jpeg',
'image/png',
'image/pjpeg',
'image/gif',
'image/bmp',
'application/vnd.openxmlformats-officedocument.word</a>processingml.document',
'application/pdf',
'application/msword</a>',
'image/x-png'
);


$max_file_size=2000000; //上傳檔案大小限制, 單位BYTE
$destination_folder="gift/"; //上傳檔路徑
	
	
$giftname=$_POST['giftname'];
$needpt=$_POST['needpt'];
$startdate=$_POST['startdate'];
$enddate=$_POST['enddate'];
$Quantity=$_POST['Quantity']; 
$storeid = $_SESSION['store_id'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$file = $_FILES["file"];
	if($max_file_size < $file["size"])
	//檢查檔案大小
	{
		echo "您選擇的檔太大了!";
		exit;
	}

/*
	if(!in_array($file["type"], $uptypes))
	//檢查檔案類型
	{
		echo "檔案類型不符!".$file["type"];
		exit;
	}
*/

	$field_file = $_FILES['file'];
	$filename=$_FILES['file']['name'];
	$tmpname=$_FILES['file']['tmp_name'];
	$filetype=$_FILES['file']['type'];
	$filesize=$_FILES['file']['size'];


	$stmt = $conn->prepare("INSERT INTO `gift`(`gift_name`,`store_id`,`need_pt`,`Quantity`,`start_date`,`end_date`,`imgtype`) values ('$giftname','$storeid','$needpt','$Quantity','$startdate','$enddate','".$filename."')");
	$stmt->execute();

	$stmt2 = $conn->prepare("SELECT MAX(gift_id) FROM `gift`");
	$stmt2->execute();
	foreach ($stmt2->fetchAll(PDO::FETCH_ASSOC) as $row) {
			$giftid = $row['MAX(gift_id)'];
	}
		
	$stmt3 = $conn->prepare("UPDATE `gift` SET `imgtype`='".$giftid.".jpg' WHERE `gift_id` = $giftid ");
	$stmt3->execute();

	if (move_uploaded_file($_FILES['file']['tmp_name'], '../../picture/gift/'.$giftid.'.jpg')) {
		echo "Uploaded";
	} else {
	   echo "File was not uploaded";
	}
}

header('Location: Gift.php');



?>
