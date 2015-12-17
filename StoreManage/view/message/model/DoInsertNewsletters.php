<?php
  include("../../connectDBModel/db.php");
  session_start(true);
    $mess_name = $_POST["mess_name"];
    $mess_text = $_POST["mess_text"];
    $store_id = $_SESSION['store_id'];
    $stmt = $conn->prepare("INSERT INTO message_Test(mess_name,mess_text,store_id) values ('$mess_name','$mess_text','$store_id')");
    $result = $stmt->execute();
    if($result === true){
     echo ("新增成功"); 
    }
    else{
        echo "新增失敗";
    }
?>
