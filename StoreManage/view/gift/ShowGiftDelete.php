<?php

session_start();
header("Content-Type:text/html; charset=utf-8");
include("../connectDBModel/db.php");

echo '<a href="../login/model/logout.php">登出</a>  <br><br>';
if($_SESSION['store_id'] != null)
{
	$storeid = $_SESSION['store_id'];
	$stmt = $conn->prepare("SELECT `gift_id`,`gift_name` FROM `gift` WHERE `store_id` = $storeid ");
	$stmt->execute();
	$list.='';
	foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
		$list.='<label><input type="checkbox" name="del[]" value='.$row['gift_id'].'>'.$row['gift_name'].'</label>';
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
  <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.core.min.js"></script>
  <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.calbox.min.js"></script>
  <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/i18n/jquery.mobile.datebox.i18n.zh-TW.utf8.js"></script>

  <script>
     function back(){document.location.href="home.php";}  
     function abc(e){alert(e.id);}
	 
	 function Delcheck() {
		 document.getElementByName("id").style.visibility = "visible";
		 
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
		<br/>
		<div id='' class='' style="font-size:28px;color:white;text-align:center;">
			<a href="#" class="ui-btn-left ui-btn ui-icon-back ui-btn-icon-left ui-shadow ui-corner-all" data-rel="back" data-role="button" role="button">返回</a>
			揪客通
			<a href="../home/home.php" target="_self" class="ui-btn-right ui-btn ui-icon-home ui-btn-icon-left ui-shadow ui-corner-all" data-role="button" role="button">首頁</a>
		</div>
	</div>
    <div style="background:#001F33;border:0px;height:70px;">
      <br/>
      <div style="font-size:22px;color:white;text-align:center;">禮品管理</div>
    </div>
  <!-- End Pageone header -->
  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:630px;background:white;width:100%;margin-top:-20px">
      <div id='' class='row'>
          <div id='down_menu' class='menu col-lg-12 col-md-12 col-sm-12 col-xs-12'>
          <div id='store' style="margin:0 auto;width:100%">
			 <font face="微軟正黑體">
				<form action="DoGiftDelete.php" method="post" class="ui-filterable">
					<input id="myFilter" data-type="search" style="width:20px">
					<ul data-role="listview" data-filter="true" data-input="#myFilter" data-inset="true">
						<fieldset data-role="controlgroup">
						<?php echo $list; ?>
						</fieldset>
						<button type="submit" class="ui-btn ui-btn-b ui-icon-delete ui-btn-icon-left ui-btn-inline">刪除</button>
					</ul>
					
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