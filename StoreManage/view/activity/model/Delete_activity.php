<?php
  include("../../connectDBModel/db.php");
  session_start(true);
    $act_id = $_POST["act_id"];
    $stmt = $conn->prepare("UPDATE `activity` SET `use_flag`='N' WHERE `act_id`='$act_id'");
    $result = $stmt->execute();
    if($result === true){
     echo "刪除成功"; 
    }
    else{
        echo "刪除失敗";
    }
?>