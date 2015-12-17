<?php
    include("../../connectDBModel/db.php");
    session_start(true);
    $coupon_name = $_POST["coupon_name"];
    $coupon_id = $_POST["coupon_id"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $use_enddate= $_POST["use_enddate"];
    $ps = $_POST["ps"];
    $count = count($QtableData);
    $stmt = $conn->prepare("UPDATE `coupon` SET `coupon_name`='$coupon_name',`start_date`='$start_date',`end_date`='$end_date',`use_enddate`='$use_enddate',`ps`='$ps' WHERE `coupon_id`='$coupon_id'");
    $result = $stmt->execute();
    
    if($result === true) {
        echo "修改成功"; 
    }
    else{
        echo "修改失敗";
    }
?>

