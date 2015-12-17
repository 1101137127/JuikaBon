<?php

session_start();
header("Content-Type:text/html; charset=utf-8");
include("../connectDBModel/db.php");

echo '<a href="../login/model/logout.php">登出</a>  <br><br>';
if($_SESSION['store_id'] != null) {
	$oldpwd=$_POST['oldpwd'];
	$newpwd=$_POST['newpwd'];
	$checknewpwd=$_POST['checknewpwd'];
	$storeid = $_SESSION['store_id'];
	
	$stmt1 = $conn->prepare("SELECT password FROM `store` WHERE `store_id` = $storeid ");
	$stmt1->execute();
	
	foreach($stmt1->fetchAll(PDO::FETCH_ASSOC) as $row) {
		$password = $row['password'];
	}
	
	if($oldpwd == $password) {
		if($newpwd != $oldpwd) {
			if($newpwd == $checknewpwd) {
				$stmt = $conn->prepare("UPDATE `store` 
								SET `password`='$newpwd'  
								WHERE `store_id` = $storeid ");
				$stmt->execute();

				echo '修改成功!<br/>';
				echo '請等待畫面跳轉..';
				header("refresh:2;url=Store.php");
			}
			else {
				echo '新密碼輸入不一致!';
				header("refresh:2;url=ShowPasswordEdit.php");
			}
		}
		else {
			echo '新密碼與舊密碼相同!';
			header("refresh:2;url=ShowPasswordEdit.php");
		}
	}
	else {
		echo '舊密碼輸入錯誤!';
		header("refresh:2;url=ShowPasswordEdit.php");
	}
}
else {
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
	
?>