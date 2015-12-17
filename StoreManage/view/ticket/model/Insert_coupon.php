<?php
    include("../../connectDBModel/db.php");
    session_start(true);
    $coupon_name = $_POST["coupon_name"];
    $coupon_type_id = $_POST["coupon_type_id"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $use_enddate= $_POST["use_enddate"];
    $ps = $_POST["ps"];
    $store_id = $_SESSION['store_id'];
    $count = count($QtableData);
    $stmt = $conn->prepare("INSERT INTO coupon(`coupon_name`, `coupon_type_id`, `start_date`,`end_date`, `store_id`, `use_enddate`, `ps`) VALUES ('$coupon_name','$coupon_type_id','$start_date','$end_date','$store_id','$use_enddate','$ps')");
    $result = $stmt->execute();
    
    if($result === true){
        echo "新增成功"; 
    }
    else{
        echo "新增失敗";
    }
?>
