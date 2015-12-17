<?php
  include("../../connectDBModel/db.php");
  session_start(true);
    $qst_id = $_POST["qst_id"];
    $QtableVal= $_POST["QtableVal"];
    $count=$_POST["qCount"];
	
    for($i=0;$i<$count;$i++) {
        $values  = $QtableVal[$i];
        $stmt = $conn->prepare("UPDATE `question_bank` SET `qst_name`='$values' WHERE `qst_id`='$qst_id'");
        $result = $stmt->execute();
    }
	  
    if($result === true){
		echo "修改成功"; 
    }
    else{
        echo "修改失敗";
    }
?>
