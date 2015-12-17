<?php

session_start();
include("../connectDBModel/db.php");
if($_SESSION['store_id'] != null) {
    $id=$_POST['del'];
    foreach((array)$id as $giftid){
	$sql1 = "SELECT imgtype FROM `gift` WHERE `gift_id`= $giftid";
	$stmt1 = $conn->prepare($sql1);
	$stmt1->execute();
		
	foreach ($stmt1->fetchAll(PDO::FETCH_ASSOC) as $row) {
            unlink($row['imgtype']);
	}
		
	$sql2 = "DELETE FROM `gift` WHERE `gift_id`= $giftid";
	$stmt2 = $conn->prepare($sql2);
	$stmt2->execute();	
    }
    echo "刪除成功";	
}
else {
        echo '刪除失敗!';
}
	
?>