<?php
  include("../../connectDBModel/db.php");
  session_start(true);
    $act_name = $_POST["act_name"];
    $act_id = $_POST["act_id"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $ad_words= $_POST["ad_words"];
    $reward_pt = $_POST["reward_pt"];
    $field_file = $_FILES['file'];
    $filename=$_FILES['file']['name'];
    $tmpname=$_FILES['file']['tmp_name'];
    $filetype=$_FILES['file']['type'];
    $filesize=$_FILES['file']['size'];
    $stmt = $conn->prepare("UPDATE `activity` SET `act_name`='$act_name',`start_date`='$start_date',`end_date`='$end_date',`ad_words`='$ad_words',`reward_pt`='$reward_pt' WHERE `act_id`='$act_id'");
    $result = $stmt->execute();
    if($result === true){
        if(isset($field_file)){
            $path = '../../../picture/activity/'.$act_id.'.jpg';
            unlink($path);
            if (move_uploaded_file($_FILES['file']['tmp_name'], '../../../picture/activity/'.$act_id.'.jpg')) {
            echo "修改成功";
            } else {
               echo "修改失敗";
            }
        }
        echo"修改成功";
    }
    else{
        echo "修改失敗";
    }
?>
