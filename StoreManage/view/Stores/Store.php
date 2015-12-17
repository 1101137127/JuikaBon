<?php
session_start();
header("Content-Type:text/html; charset=utf-8");
include("../connectDBModel/db.php");
echo '<a href="../login/model/logout.php">登出</a>  <br><br>';

if($_SESSION['store_id'] != null)
{
	$storeid = $_SESSION['store_id'];
    $stmt = $conn->prepare("SELECT * FROM `store` WHERE `store_id` = $storeid ");
	$stmt->execute();
	$list.='';
	
	/*
	foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
		$list.='<font face="微軟正黑體">
					<ul data-role="listview" data-inset="true">
						<li data-icon="false"><div data-role="fieldcontain">
							<label for="storename">店家名稱:</label><input type="text" style="border:0px;" readonly="true" name="storename" id="storename" value="'.$row['store_name'].'"></div>
						</li>
						<li data-icon="false"><b>店家電話:</b>'.$row['store_phone'].'</li>
						<li data-icon="false"><b>店家地址:</b>'.$row['store_address'].'</li>
						<li data-icon="false"><b>負責人:</b>'.$row['principal_name'].'</li>
						<li data-icon="false"><b>負責人電話:</b>'.$row['principal_phone'].'</li>
					</ul>
				</font>';
	}
	*/
	
	foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
		$list.='<font face="微軟正黑體">
					<ul data-role="listview" data-inset="true">
						<li data-icon="false"><b>店家名稱:</b> <input type="text" data-role="none" style="border:0px;" readonly="true" id="storename" name="storename" value="'.$row['store_name'].'"></li>
						<li data-icon="false"><b>店家電話:</b> <input type="text" data-role="none" style="border:0px;" readonly="true" id="storephone" name="storephone" value="'.$row['store_phone'].'"></li>
						<li data-icon="false"><b>店家地址:</b> <input type="text" data-role="none" style="border:0px;" readonly="true" id="storeaddress" name="storeaddress" value="'.$row['store_address'].'"></li>
						<li data-icon="false"><b>負責人:</b> <input type="text" data-role="none" style="border:0px;" readonly="true" id="principalname" name="principalname" value="'.$row['principal_name'].'"></li>
						<li data-icon="false"><b>負責人電話:</b> <input type="text" data-role="none" style="border:0px;" readonly="true" id="principalphone" name="principalphone" value="'.$row['principal_phone'].'"></li>
						<li data-icon="false"><b>店家介紹:</b> <input type="text" data-role="none" style="border:0px;" readonly="true" id="storeintro" name="storeintro" value="'.$row['store_intro'].'"></li>
					</ul>
				</font>';
	}
	
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
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
  
  <script>
     function back(){document.location.href="home.php";}  
     function abc(e){alert(e.id);}
	 
	 function edit() {
		 document.getElementById('cancel').style.visibility = "visible";
		 document.getElementById('goedit').style.visibility = "visible";
		 document.getElementById('storename').removeAttribute("readonly",0);
		 document.getElementById('storephone').removeAttribute("readonly",0);
		 document.getElementById('storeaddress').removeAttribute("readonly",0);
		 document.getElementById('principalname').removeAttribute("readonly",0);
		 document.getElementById('principalphone').removeAttribute("readonly",0);
		 document.getElementById('storeintro').removeAttribute("readonly",0);
	 }
	 
	 function cancel() {
		 document.getElementById('cancel').style.visibility = "hidden";
		 document.getElementById('goedit').style.visibility = "hidden";
		 document.getElementById('storename').addAttribute("readonly",0);
		 document.getElementById('storephone').addAttribute("readonly",0);
		 document.getElementById('storeaddress').addAttribute("readonly",0);
		 document.getElementById('principalname').addAttribute("readonly",0);
		 document.getElementById('principalphone').addAttribute("readonly",0);
		 document.getElementById('storeintro').addAttribute("readonly",0);
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
			<a href="#" class="ui-btn-left ui-btn ui-icon-back ui-btn-icon-left ui-shadow ui-corner-all" data-rel="back" data-role="button" role="button">返回</a>
			<img src="../../image/logo.png" width="200px" height="80px"> 
			<a href="../home/home.php" target="_self" class="ui-btn-right ui-btn ui-icon-home ui-btn-icon-left ui-shadow ui-corner-all" data-role="button" role="button">首頁</a>
		</div>
	</div>
    <div style="background:#001F33;border:0px;height:70px;">
      <div style="font-size:22px;color:white;text-align:center;">店家管理</div>
    </div>
  <!-- End Pageone header -->
  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:630px;background:white;width:100%;margin-top:-20px">
      <div id='' class='row'>
          <div id='down_menu' class='menu col-lg-12 col-md-12 col-sm-12 col-xs-12'>
          <div id='store' style="margin:0 auto;width:100%">
			<div data-role="main" class="ui-content" >
		  <a href="ShowPasswordEdit.php" style="float:right;" id="editpdBtn" name="editpdBtn" data-role="button"  data-mini="true" data-inline="true"  data-iconpos="right">修改密碼</a>
		  <a style="float:right;" onclick="edit()" id="editBtn" name="editBtn" data-role="button"  data-mini="true" data-inline="true"  data-iconpos="right">編輯</a>
	    <br/>
			 <!--
			 <font face="微軟正黑體">
				<ul data-role="listview" data-inset="true">
				  <li data-icon="false"><b>店家名稱:</b> 丹丹漢堡</li>
				  <li data-icon="false"><b>店家電話:</b> (07)3525289</li>
				  <li data-icon="false"><b>店家地址:</b> 高雄市大社區中山路</li>
				  <li data-icon="false"><b>負責人:</b> 李丹丹</li>
				  <li data-icon="false"><b>負責人電話:</b> 0935588558</li>
				  <li data-icon="false"><b>自我介紹:</b> 你好！歡迎光臨丹丹大社店，很高興為您服務！</li>
				  <li data-icon="false"><b>近期優惠:</b> 凡購買任一定食套餐，可樂+2元升級大杯</li>
				</ul>
			 </font>	-->	
			 <br/>
			 <form action="DoUpdateStore.php" method="post"  data-ajax="false">
				 <?php echo $list ?>
				<button class="ui-btn ui-btn-inline ui-btn-b" type="submit" id="cancel" style="visibility: hidden;" onclick="cancel();">取消</button> 		
				<input type="submit" class="ui-btn ui-btn-inline ui-btn-b" id="goedit" style="visibility: hidden;" value="確認">
			 </form>
			</div>
		  </div>
		  
      </div>
      </div>
  </div><!-- END Pageone main -->
  <div data-role="footer" style="text-align:center;width:100%;height:60px;background:white;border:0px;">
    
  </div> 
</div> <!--end pageone -->

</body>
</html>