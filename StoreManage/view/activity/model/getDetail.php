<?php
	include("../../connectDBModel/db.php");
  session_start(true);
  $act_id = $_POST["act_id"];
	$stmt = $conn->prepare("SELECT distinct(act.`mem_id`),mem.`name`,act.`join_date`,act.`act_record_id` FROM `act_record` act LEFT JOIN `member` mem ON act.`mem_id` = mem.`mem_id` WHERE `act_id`='$act_id' ORDER BY `act_record_id` ");
	$stmt->execute();
  $tol=$stmt->rowCount();
  $count=0;
  if($tol == 0){
    echo "Null";
  }else {
  $msg = "";
  foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $count++;
      $msg.="<tr><td>" . $count . "</td><td>" . $row['mem_id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['join_date'] . "</td></tr>";
  }
  echo $msg;
  }
  
?>