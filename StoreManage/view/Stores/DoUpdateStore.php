<?php

session_start();
header("Content-Type:text/html; charset=utf-8");
include("../connectDBModel/db.php");

echo '<a href="../login/model/logout.php">登出</a>  <br><br>';
if($_SESSION['store_id'] != null)
{
	$storename=$_POST['storename'];
	$storephone=$_POST['storephone'];
	$storeaddress=$_POST['storeaddress'];
	$principalname=$_POST['principalname'];
	$principalphone=$_POST['principalphone'];
	$storeintro=$_POST['storeintro'];
	$storeid = $_SESSION['store_id'];
	
	$stmt = $conn->prepare("UPDATE `store` 
							SET `store_name`='$storename',`store_phone`='$storephone',`store_address`='$storeaddress',`principal_name`='$principalname',`principal_phone`='$principalphone',`store_intro`='$storeintro' 
							WHERE `store_id` = $storeid ");
	$stmt->execute();
	
	
	/*
	$url="http://140.133.74.58/test/store/StoreManage/view/Stores/Store.php";
	header("Location:".$url);
	exit;
	*/
	
	//document.location.href="Store.php";
	
	header('Location:Store.php');
	
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
	
?>