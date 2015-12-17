<?php
  include("../../connectDBModel/db.php");
  session_start(true);
    $qst_name = $_POST["qst_name"];
    $qst_id = $_POST["qst_id"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $reward_pt = $_POST["reward_pt"];
    $stmt = $conn->prepare("UPDATE `questionnaire` SET `qst_name`='$qst_name',`start_date`='$start_date',`end_date`='$end_date',`reward_pt`='$reward_pt' WHERE `qst_id`='$qst_id'");
    $result = $stmt->execute();
    if($result === true){
     echo ("修改成功"); 
    }
    else{
        echo "修改失敗";
    }
?>
