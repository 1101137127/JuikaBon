<?php
  include("../../connectDBModel/db.php");
  session_start(true);
    $mess_id = $_POST["mess_id"];
    $stmt = $conn->prepare("UPDATE `message` SET `use_flag`='N' WHERE `mess_id`='$mess_id'");
    $result = $stmt->execute();
    if($result === true){
     echo "刪除成功"; 
    }
    else{
        echo "刪除失敗";
    }
?>