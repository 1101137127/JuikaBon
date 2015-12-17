<?php
  include("../../connectDBModel/db.php");
    session_start(true);
    $mess_name = $_POST["mess_name"];
    $mess_id = $_POST["mess_id"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $mess_content= $_POST["mess_content"];
    $stmt = $conn->prepare("UPDATE `message` SET `mess_name`='$mess_name',`mess_content`='$mess_content',`start_date`='$start_date',`end_date`='$end_date' WHERE `mess_id`='$mess_id'");
    $result = $stmt->execute();
    if($result === true){
     echo "修改成功"; 

    }
    else{
        echo "修改失敗";
    }
?>