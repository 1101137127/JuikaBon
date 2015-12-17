<?php
  include("../../../model/connectDB.php");
    $db=new PDOConfig;
if(isset($username)&&isset($password))
{
    $sql = "SELECT store_name,store_id from store where account =:username and password =:password";
    $query = $db->prepare($sql);
    $query->execute(array(':username' => $username,':password' => $password));
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    if($result!=null)
    {
      session_start(true);
    $_SESSION['store_id'] = $result[0]->store_id;
    $_SESSION['account']=$username;
    $_SESSION['store_name']=$result[0]->name;
    echo true;
    }
    else{
      echo false;
    }

  }
  else {
    echo false;
    
  }
?>
