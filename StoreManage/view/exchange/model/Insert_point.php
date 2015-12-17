<?php
  include("../../connectDBModel/db.php");
  session_start(true);
    $cellphone = $_POST["cellphone"];
    $total_money = $_POST["total_money"];
    $coupon_detail_id = $_POST["coupon_detail_id"];
    $reward_pt = $_POST["reward_pt"];
    $store_id = $_SESSION['store_id'];
    $mem_id = "";
    $count = "";
    //stop.1 拿mem_id                      
    $result = $conn->query("SELECT `mem_id` FROM `member` where `cellphone`='$cellphone'");    
    $row = $result->fetch(PDO::FETCH_ASSOC) ;
    $mem_id = $row['mem_id'] ;
    
    //stop.2檢查mem_id
    if($mem_id != null || $mem_id != ""  ){
        //stop.3判斷是否使用禮卷
        if($coupon_detail_id != null || $coupon_detail_id !=""){
            //stop.3.1 看是否有權使用禮卷
            $result2 = $conn->query("SELECT count(1) as `count` FROM `coupon_detail` where `mem_id`='$mem_id' and `use_date` is NULL  and `coupon_detail_id` = '$coupon_detail_id'");  
            $row2 = $result2->fetch(PDO::FETCH_ASSOC) ;
            $count = $row2['count'] ;
            
            //step 3.2 可使用禮卷則新增
            if($count != 0){
                
                $stmt = $conn->prepare("INSERT INTO shopdetail(`mem_id`, `store_id`, `total_money`,`buy_date`,`cou_id`,`reward_pt`) VALUES ('$mem_id','$store_id','$total_money',CURDATE(),'$coupon_detail_id','$reward_pt')");
                $result3 = $stmt->execute();
        
                $stmt2 = $conn->prepare("UPDATE `coupon_detail` SET `use_date`=CURDATE() WHERE `coupon_detail_id`='$coupon_detail_id'");  
                $result4 = $stmt2->execute();
                
            //step 3.2 禮卷無效
            }else{
                echo "禮卷無效";
                return ;
            }

        //stop.3 若無禮卷直接insert    
        }else{

            $stmt = $conn->prepare("INSERT INTO shopdetail(`mem_id`, `store_id`, `total_money`,`buy_date`, `reward_pt`) VALUES ('$mem_id','$store_id','$total_money',CURDATE(),'$reward_pt')");
            $test =  $stmt->execute();
   
        }
         //step.4 新增完禮卷後 加總點數
        $result5 = $conn->query("SELECT count(1) as count , total_pt from point  where `mem_id`='$mem_id' and `store_id` = '$store_id'");  
        $row3 = $result5->fetch(PDO::FETCH_ASSOC) ;
        $count2 = $row3['count'] ;
        $total_pt = $row3['total_pt'];
        if($count2 < 1){
            $stmt3 = $conn->prepare("INSERT INTO `point`( `mem_id`, `store_id`, `total_pt`) VALUES ('$mem_id','$store_id','$reward_pt')");
            $result6 = $stmt3->execute();
        }
        if($count2 ==1){

            $pt = $total_pt + $reward_pt;

            $stmt4 = $conn->prepare("UPDATE `point` SET `total_pt`='$pt' WHERE `mem_id`='$mem_id' AND `store_id` = '$store_id'");  
            $result7 = $stmt4->execute();
        }
        echo "贈點成功";

    //stop.2
    }else{
        echo "電話號碼有誤";
    }
    

?>