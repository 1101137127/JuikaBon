<?php
  include("../../connectDBModel/db.php");
  session_start(true);
    $qst_id = $_POST["qst_id"];
    $stmt = $conn->prepare("UPDATE `questionnaire` SET `use_flag`='N' WHERE `qst_id`='$qst_id'");
    $result = $stmt->execute();
    if($result === true){
     echo "刪除成功"; 
    }
    else{
        echo "刪除失敗";
    }
?>