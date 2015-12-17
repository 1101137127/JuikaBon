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
      <div style="font-size:22px;color:white;text-align:center;">修改密碼</div>
    </div>
  <!-- End Pageone header -->
  
  
  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:630px;background:white;width:100%;margin-top:-20px">	 
	<br/>
	<form action="DoPasswordEdit.php" method="post"  data-ajax="false">
		<div class="ui-field-contain">
			<label for="oldpwd">請輸入舊密碼:</label>
			<input type="password" name="oldpwd" id="oldpwd" required>       
			<label for="newpwd">請輸入新密碼:</label>
			<input type="password" name="newpwd" id="newpwd" required>
			<label for="checknewpwd">確認新密碼:</label>
			<input type="password" name="checknewpwd" id="checknewpwd" required>
        </div>	
		<input type="submit" class="ui-btn ui-btn-inline ui-btn-b" id="goedit" value="確認">
	</form>	
  </div>
  <!-- END Pageone main -->
  
  
  <div data-role="footer" style="text-align:center;width:100%;height:60px;background:white;border:0px;">
    
  </div> 
</div> <!--end pageone -->

</body>
</html>