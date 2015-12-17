<?php
include("../connectDBModel/db.php");

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
      <br/>
      <div style="font-size:22px;color:white;text-align:center;">禮品管理</div>
    </div>
  <!-- End Pageone header -->
  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:630px;background:white;width:100%;margin-top:-20px">
      <div id='' class='row'>
		  <font face="微軟正黑體">
          <div id='down_menu' class='menu col-lg-12 col-md-12 col-sm-12 col-xs-12'>
				<form action="DoInsertGift.php" method="post" enctype="multipart/form-data" data-ajax="false">
				  <b>禮品圖片:</b><input type="file" name="file">
				  <input type="text" name="giftname" id="giftname" placeholder="禮品名稱">
				  <input type="text" name="needpt" id="needpt" placeholder="所需點數">				  
				  開始兌換:<input type="date" name="startdate" id="startdate">
				  截止兌換:<input type="date" name="enddate" id="enddate">				  
				  <input type="text" name="Quantity" id="Quantity" placeholder="數量">
				  <!--<button class="ui-btn ui-icon-edit ui-btn-icon-left ui-btn-inline">確定</button> -->
				  <!--<button class="ui-btn ui-icon-edit ui-btn-icon-left ui-btn-inline" type="submit" name="action" value="DoInsertGift.php">儲存</button>-->
				  <input type="submit" class="ui-btn ui-icon-edit ui-btn-icon-left ui-btn-inline" name="submit" id="submit" value="儲存">
				
				</form>
			
          </div>
		  </font>
      </div>
	</div><!-- END Pageone main -->
  <div data-role="footer" style="text-align:center;width:100%;height:60px;background:white;border:0px;">
    
  </div> 
  
</div> <!--end pageone -->

</body>
</html>