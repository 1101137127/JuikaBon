<?php
  include("../../connectDBModel/db.php");
  session_start(true);
    $coupon_id = $_POST["coupon_id"];
    $stmt = $conn->prepare("UPDATE `coupon` SET `use_flag`='N' WHERE `coupon_id`='$coupon_id'");
    $result = $stmt->execute();
    if($result === true){
     echo "刪除成功"; 
    }
    else{
        echo "刪除失敗";
    }
?>