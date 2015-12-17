<?php

session_start();
header("Content-Type:text/html; charset=utf-8");
include("../connectDBModel/db.php");

$uptypes=array(
'jpg',
'jpeg',
'png',
'pjpeg',
'gif',
'bmp',
'x-png'
);


$max_file_size=2000000; //上傳檔案大小限制, 單位BYTE
$destination_folder="gift/"; //上傳檔路徑
	

echo '<a href="../login/model/logout.php">登出</a>  <br><br>';
if($_SESSION['store_id'] != null)
{
	$giftid=$_POST['giftid'];
	$giftname=$_POST['giftname'];
	$needpt=$_POST['needpt'];
	$startdate=$_POST['startdate'];
	$enddate=$_POST['enddate'];
	$Quantity=$_POST['Quantity'];
	
	
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
		
		//刪除原圖	
		$stmt1 = $conn->prepare("SELECT imgtype FROM `gift` WHERE `gift_id`= $giftid");
		$stmt1->execute();
		foreach ($stmt1->fetchAll(PDO::FETCH_ASSOC) as $row) {
			unlink($row['imgtype']);
		}
		
		//上傳新圖
		$field_file = $_FILES['file'];
		$filename=$_FILES['file']['name'];
		$tmpname=$_FILES['file']['tmp_name'];
		$filetype=$_FILES['file']['type'];
		$filesize=$_FILES['file']['size'];
		if (move_uploaded_file($_FILES['file']['tmp_name'], '../../picture/gift/'.$giftid.'.jpg')) {
			echo "Uploaded";
		} else {
		   echo "File was not uploaded";
		}
		
		$stmt = $conn->prepare("UPDATE `gift` SET `gift_name`='$giftname',`need_pt`='$needpt',`start_date`='$startdate',`end_date`='$enddate',`Quantity`='$Quantity',`imgtype`='".$giftid.".jpg' WHERE `gift_id` = $giftid ");
		$stmt->execute();
		
		header('Location: GiftDetail.php?id='.$giftid.'');
		
	}
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
	
?>