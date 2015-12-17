<?php
  include("../../connectDBModel/db.php");
  session_start(true);
    $mess_name = $_POST["mess_name"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $mess_content= $_POST["mess_content"];
    $store_id = $_SESSION['store_id'];
    $count = count($QtableData);
    $stmt = $conn->prepare("INSERT INTO message(`mess_name`, `mess_content`, `start_date`,`end_date`, `store_id`) VALUES ('$mess_name','$mess_content','$start_date','$end_date','$store_id')");
    $result = $stmt->execute();
    if($result === true){
     echo ("新增成功"); 
    }
    else{
        echo "新增失敗";
    }
?>