<?php
  include("../connectDBModel/db.php");
  session_start(true);
    $act_name = $_POST["coupon_name"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $use_enddate= $_POST["use_enddate"];
    $ps = $_POST["ps"];
    $coupon_id = $_SESSION['coupon_id'];
    $count = count($QtableData);
    $stmt = $conn->prepare("INSERT INTO coupon(`coupon_id`,`coupon_name`,`start_date`,`end_date`,`use_enddate`,`ps`) VALUES ('$coupon_id','$coupon_name','$start_date','$end_date','$use_enddate','$ps')");
    $result = $stmt->execute();
    if($result === true){
     echo ("新增成功"); 
    }
    else{
        echo "新增失敗";
    }
?>
