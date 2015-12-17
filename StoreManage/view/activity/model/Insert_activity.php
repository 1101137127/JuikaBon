<?php
  include("../../connectDBModel/db.php");
  session_start(true);
    $act_name = $_POST["act_name"];
    $type = $_POST["type"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $ad_words= $_POST["ad_words"];
    $reward_pt = $_POST["reward_pt"];
    $store_id = $_SESSION['store_id'];
    $field_file = $_FILES['file'];
    $filename=$_FILES['file']['name'];
    $tmpname=$_FILES['file']['tmp_name'];
    $filetype=$_FILES['file']['type'];
    $filesize=$_FILES['file']['size'];
    $stmt = $conn->prepare("INSERT INTO activity(`act_name`, `type`, `start_date`,`end_date`, `store_id`, `ad_words`, `reward_pt`) VALUES ('$act_name','$type','$start_date','$end_date','$store_id','$ad_words','$reward_pt')");
    $result = $stmt->execute();
    if(isset($field_file)){
    $act_id=$conn->lastInsertId();
    $imgtype = ((string)$act_id +'.jpg');
    $stmt2 = $conn->prepare("UPDATE `activity` SET `imgtype`='$imgtype.jpg' WHERE `act_id`='$act_id'");
    $result2 = $stmt2->execute();
    if (move_uploaded_file($_FILES['file']['tmp_name'], '../../../picture/activity/'.$act_id.'.jpg')) {
        echo "新增成功";
        } else {
           echo "檔案上傳失敗";
        }
    }
    else if ($result === true) {
       echo "新增成功";
    }
?>
