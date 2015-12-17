<?php

session_start();
header("Content-Type:text/html; charset=utf-8");
include("../connectDBModel/db.php");

	$cellphone = $_POST['cellphone'];
	$stmt = $conn->prepare("SELECT `gd_id`,`name`,`cellphone`,`gift_name` 
							FROM `giftdetail`  
							JOIN `member` ON `member`.`mem_id` = `giftdetail`.`mem_id` 
							JOIN `gift` ON `gift`.`gift_id` = `giftdetail`.`gift_id` 
							WHERE `cellphone` = $cellphone AND `change_flag` = 'N' ");
	$stmt->execute();
	
	$stmt1 = $conn->prepare("SELECT `name` 
							FROM `giftdetail`  
							JOIN `member` ON `member`.`mem_id` = `giftdetail`.`mem_id` 
							JOIN `gift` ON `gift`.`gift_id` = `giftdetail`.`gift_id` 
							WHERE `cellphone` = $cellphone AND `change_flag` = 'N' ");
	$stmt1->execute();
	foreach ($stmt1->fetchAll(PDO::FETCH_ASSOC) as $row1) {
		$memname=$row1['name'];
	}
	$list.='兌換人：' . $memname . '<br/><br/> 欲兌換禮品：<br/>';

	foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
		$list.='
		<li>
		<a href="GiftExchangeDetail.php?id=' . $row['gd_id'] . '" data-ajax="false"><h2>'.$row['gift_name'].'</h2> </a>
		</li>';	
		
	}
	
	if($list=='') {
		echo "<script>alert('無申請記錄');</script>"; 
		echo "<meta http-equiv='Refresh' content='0;URL=GiftExchange.php'>"; 
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../../jquery-mobile-css/bootstrap.min.css" rel="stylesheet">
<link href="../../jquery-mobile-css/carousel.css" rel="stylesheet">
  <link rel="stylesheet" href="../../jquery-mobile-css/jquery.mobile-1.4.5.min.css">
  <!-- Include the jQuery library -->
  <script src="../../jquery-mobile-js/jquery-2.1.4.min.js"></script>
  <!-- Include the jQuery Mobile library -->
  <script src="../../jquery-mobile-js/jquery.mobile-1.4.5.min.js"></script>
  <script src="../../jquery-mobile-js/bootstrap.min.js"></script>
  <script src="../../jquery-mobile-js/jssor.js"></script>
  <script src="../../jquery-mobile-js/jssor.slider.js"></script>
  <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.core.min.js"></script>
  <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.calbox.min.js"></script>
  <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/i18n/jquery.mobile.datebox.i18n.zh-TW.utf8.js"></script>

  <script type="text/javascript">
     function back(){document.location.href="home.php";} 	 
	 function Delcheck() {		 
		 for (var i=0 ;i < document.getElementsByName("id[]").length; i++ ){
			document.getElementsByName("id[]")[i].style.display = "inline";
		}
		 
	 }
	 
  </script>
  <style>
    .home-main{
      border:1px solid;border-radius:30px;height:130px;opacity:0.5;text-align:center;
    }
    .home-main-content{
      font-size:18px;font-family:Helvetica Neue;color:black;margin-top:6px;
    }
    .menu{
      margin-left:-16.5px;
    }
    #down_menu{
      margin-left:2px;
    }
  </style>
</head>
<body >
<div data-role="page" id="pageone" >
   <!-- Pageone header -->
  <div data-role="header" style=" background:#0097A7;border:0px;height:80px;">
    <div id='' class='' style="font-size:28px;color:white;text-align:center;">
      <a href="#" class="ui-btn-left ui-btn ui-icon-back ui-btn-icon-left ui-shadow ui-corner-all" data-rel="back" data-role="button" role="button" data-ajax="false">返回</a>
      <img src="../../image/logo.png" width="200px" height="80px">  
      <a href="../home/home.php" target="_self" class="ui-btn-right ui-btn ui-icon-home ui-btn-icon-left ui-shadow ui-corner-all" data-role="button" role="button">首頁</a>
    </div>
  </div>
    <div style="background:#001F33;border:0px;height:70px;">
      <br/>
      <div style="font-size:22px;color:white;text-align:center;">禮品兌換</div>
    </div>
  <!-- End Pageone header -->
  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:630px;background:white;width:100%;margin-top:-20px">
      <div id='' class='row'>
        <div id='down_menu' class='menu col-lg-12 col-md-12 col-sm-12 col-xs-12'>
          <div id='store' style="margin:0 auto;width:100%">
			 <font face="微軟正黑體">
				<!--<a href="ShowGiftDelete.php" class="ui-btn ui-btn-b ui-icon-delete ui-btn-icon-left ui-btn-inline">刪除</a>-->
				<form class="ui-filterable" data-ajax="false">
				  	<ol data-role="listview" data-filter="true" data-input="#myFilter"  data-inset="true" data-split-icon="delete" class="primary-menu ui-listview ui-listview-inset ui-corner-all ui-shadow">
						<?php echo $list; ?>
				    </ol>
				</form>
			 </font>
		  </div>
        </div>
      </div>
  </div><!-- END Pageone main -->
  <div data-role="footer" style="text-align:center;width:100%;height:60px;background:white;border:0px;">
    
  </div> 
  
</div> <!--end pageone -->

</body>
</html>