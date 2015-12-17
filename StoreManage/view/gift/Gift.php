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
		$list.='<li ">
		<a href="GiftDetail.php?id=' . $row['gift_id'] . '" ><h2>' . $row['gift_name'] . '</h2> </a>
		<a onclick="doConfirm('.$row['gift_id'].')"  id="doConfirm" data-ajax="false">Delete</a>
		</li>';
	}
	
	/*
	foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
		$list.='<li class="ui-li-has-thumb ui-first-child">
		<a href="GiftDetail.php?id=' . $row['gift_id'] . '" class="ui-btn ui-btn-icon-right ui-icon-carat-r">
		<input type="checkbox" name="id[]" style="display:none;" value='.$row['gift_id'].'>' . $row['gift_name'] . '
		
		</a></li>';
	}
	*/
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
	 function Delcheck() {		 
		 for (var i=0 ;i < document.getElementsByName("id[]").length; i++ ){
			document.getElementsByName("id[]")[i].style.display = "inline";
		}
		 
	 }
	 
	 function edit() {
		 document.getElementById('cancel').style.visibility = "visible";
		 document.getElementById('goedit').style.visibility = "visible";
		 document.getElementById('file').style.visibility = "visible";
		 document.getElementById('giftname').removeAttribute("readonly",0);
		 document.getElementById('needpt').removeAttribute("readonly",0);
		 document.getElementById('Quantity').removeAttribute("readonly",0);
	
	 }
	function doConfirm(id) {
      var del = confirm("是否確定刪除?");
      if(del==true){
        $.ajax({
        url: "DoGiftDelete.php", 
        type:"POST",
        data: {
          del:id
        },
        datatype:"text",//回傳的資料型態
        success: function(data){
           alert(data);
           location.reload() ;
            },
            error:function(xhr, ajaxOptions, thrownError){ 
                      alert("刪除失敗");
                      location.reload() ;
                      console.log(xhr.status); 
                      console.log(thrownError);
                   }

          });
      }
      else{
        return;
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
          <div id='down_menu' class='menu col-lg-12 col-md-12 col-sm-12 col-xs-12'>
          <div id='store' style="margin:0 auto;width:100%">
			 <font face="微軟正黑體">
				<input id="myFilter" data-type="search" style="width:20px">
				<!--<a href="ShowGiftDelete.php" class="ui-btn ui-btn-b ui-icon-delete ui-btn-icon-left ui-btn-inline">刪除</a>-->
				<form class="ui-filterable"	data-ajax="false">
				  <ul data-role="listview" data-filter="true" data-input="#myFilter" data-inset="true">
				  	<ul data-role="listview" data-filter="true" data-input="#myFilter"  data-inset="true" data-split-icon="delete" class="primary-menu ui-listview ui-listview-inset ui-corner-all ui-shadow">
				  <?php echo $list; ?>
				</ul>
				</form>
			 </font>
		  </div>
      </div>
      </div>
				<a href="GiftInsert.php" class="ui-btn ui-btn-b ui-icon-plus ui-btn-icon-left ui-btn-inline">新增</a>
  </div><!-- END Pageone main -->
  <div data-role="footer" style="text-align:center;width:100%;height:60px;background:white;border:0px;">
    
  </div> 
  
</div> <!--end pageone -->
<div data-role="page" id="pagetwo">

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
		<div style="font-size:22px;color:white;text-align:center;">新增禮品</div>
	</div>
		
    <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:630px;background:white;width:100%;margin-top:-20px">
      <div id='' class='row'>
          <div id='down_menu' class='menu col-lg-12 col-md-12 col-sm-12 col-xs-12'>
		  <ul data-role="listview" data-filter="true" data-input="#myFilter" data-inset="true">
				  <li><b>禮品圖片:</b><button class="ui-btn ui-icon-edit ui-btn-icon-left ui-btn-inline">上傳</button></li>
				  <li><input type="text" name="fname" id="fname" placeholder="禮品名稱"></li>
				  <li><input type="text" name="fname" id="fname" placeholder="所需點數"></li>
          </div>
      </div>
	</div>
	  
	<div data-role="footer" style="text-align:center;width:100%;height:60px;background:white;border:0px;">
    </div> 
	  
</div> 

</body>
</html>