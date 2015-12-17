<?php
	include("../../connectDBModel/db.php");
  session_start(true);
  $qst_id = $_POST["qst_id"];
	$stmt = $conn->prepare("SELECT distinct(qst_d.`mem_id`),mem.`name`,qst_d.`qd_date`,qst_d.`qd_id` FROM `question_detail` qst_d LEFT JOIN `member` mem ON qst_d.`mem_id` = mem.`mem_id` WHERE `qst_id`='$qst_id' ORDER BY `qd_id` ");
	$stmt->execute();
  $tol=$stmt->rowCount();
  $count = 0;
  if($tol == 0){
    echo "Null";
  }else {
  $msg = "";
  foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $count ++ ;
      $msg.="<tr><td>" . $count . "</td><td>" . $row['mem_id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['qd_date'] . "</td></tr>";
  }
  echo $msg;
  }
  
?>