<?php
  include("../../connectDBModel/db.php");
  session_start(true);
    $testStr = "";
    $totalcount=0;
    $qst_name = $_POST["qst_name"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $reward_pt = $_POST["reward_pt"];
    $qst_type = $_POST["qst_type"];
    $store_id = $_SESSION['store_id'];
    $QtableData= $_POST["QtableData"];
    $count = count($QtableData);
    $stmt = $conn->prepare("INSERT INTO questionnaire(`qst_name`, `start_date`, `end_date`, `store_id`, `reward_pt`, `qst_type`) VALUES ('$qst_name','$start_date','$end_date','$store_id','$reward_pt','$qst_type')");
    $stmt->execute();
    $qst_id=$conn->lastInsertId();
	
    if($qst_id!=null){
		
      for($i=0;$i<$count;$i++){
        $totalcount++;
        $values  = $QtableData[$i];
        $subjectStmt = $conn->prepare("INSERT INTO `question_bank`(`qst_id`, `qst_name`, `opt_1`, `opt_2`, `opt_3`, `opt_4`) VALUES ('$qst_id','$values','非常滿意','滿意','不滿意','非常不滿意')");
        $subjectStmt->execute();
      }
	  
      if($totalcount==count($QtableData)){
		echo "新增成功"; 
      }
      else{
        echo "新增失敗";
      }
	  
	}

    
?>
