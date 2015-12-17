<?php
        header("Content-Type:text/html; charset=utf-8");
	include("../connectDBModel/db.php");
        $id=$_GET['id'];
	$stmt = $conn->prepare("SELECT * FROM `gift` WHERE `gift_id`='".$id."'");
	$stmt->execute();
        $msg.='';
		
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
	$msg.='
			 <font face="微軟正黑體">
				<input type="hidden" id="giftid" name="giftid" value="'.$row['gift_id'].'">
				<ul data-role="listview" data-inset="true">
				  <li style="padding-left: 1em;" data-icon="false"><b>禮品照片:</b><img src=../../picture/gift/' . $row['imgtype'] . ' width=30%"><input id="file" data-role="none" style="padding-top:30px;visibility: hidden;" type="file" name="file" /></li>
				  <li data-icon="false"><b>禮品名稱:</b><input type="text" data-role="none" style="border:0px;" readonly="true" id="giftname" name="giftname" value="'.$row['gift_name'].'"></li>
				  <li data-icon="false"><b>所需點數:</b><input type="text" data-role="none" style="border:0px;" readonly="true" id="needpt" name="needpt" value="'.$row['need_pt'].'"></li>
				  <li data-icon="false"><b>開始兌換:</b><input type="date" data-role="none" style="border:0px;" readonly="true" id="startdate" name="startdate" value="'.$row['start_date'].'"></li>
				  <li data-icon="false"><b>截止兌換:</b><input type="date" data-role="none" style="border:0px;" readonly="true" id="enddate" name="enddate" value="'.$row['end_date'].'"></li>
				  <li data-icon="false"><b>數量:</b><input type="text" data-role="none" style="border:0px;" readonly="true" id="Quantity" name="Quantity" value="'.$row['Quantity'].'"></li>					  
				</ul>
			 </font>'; 
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
	 
	 function edit() {
		 document.getElementById('cancel').style.visibility = "visible";
		 document.getElementById('goedit').style.visibility = "visible";
		 document.getElementById('file').style.visibility = "visible";
		 document.getElementById('giftname').removeAttribute("readonly",0);
		 document.getElementById('needpt').removeAttribute("readonly",0);
		 document.getElementById('startdate').removeAttribute("readonly",0);
		 document.getElementById('enddate').removeAttribute("readonly",0);
		 document.getElementById('Quantity').removeAttribute("readonly",0);
	
	 }
	 
	 function cancel() {
		 document.getElementById('cancel').style.visibility = "hidden";
		 document.getElementById('goedit').style.visibility = "hidden";
		 document.getElementById('file').style.visibility = "hidden";
		 document.getElementById('giftname').addAttribute("readonly",0);
		 document.getElementById('needpt').addAttribute("readonly",0);
		 document.getElementById('startdate').addAttribute("readonly",0);
		 document.getElementById('enddate').addAttribute("readonly",0);
		 document.getElementById('Quantity').addAttribute("readonly",0);
	 }
	 
  </script>
  <style>
    .member-main{
      border:0px solid;
      width:100%;
      height:200px;
    }
    #member-main-personal{
       border-bottom:2px solid #000000;
       height:200px;
    }
    #member-data{
      background: url("../../image/me.jpg");
      background-size: 200px 190px;/*圖片大小*/
      background-repeat: no-repeat;/*圖片不重複*/
      border-radius:60px;/*圖片變圓*/
      background-position: center;/*置中圖片*/
    }
    .dimg{height:200px;}
    ul.primary-menu {
    border-top:none;
    }
    ul.primary-menu li a{
    background: green ;
    font-size:18px;
    color:#ffffff ;
    font-family: 'ramblabold', Arial, sans-serif;
    border-bottom:1px solid #f2e3ea;
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
    <div style="background:#001F33;border:0px;height:50px;">
      <br/>
      <div style="font-size:22px;color:white;text-align:center;">禮品資料</div>
    </div>
  <!-- End Pageone header -->

  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:650px;background:white;">
	<div id='member-main-downcontent' class='member-main col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div id='' style="margin:0 auto;width:100%">
              <a style="float:right;" onclick="edit()" id="editBtn" name="editBtn" data-role="button"  data-mini="true" data-inline="true"  data-iconpos="right">編輯</a>
              <br/><br/>
              <form action="DoUpdateGift.php" enctype="multipart/form-data" method="post" data-ajax="false">
			  
				<?php echo $msg; ?>
					
                <button class="ui-btn ui-btn-inline ui-btn-b" id="cancel" style="visibility: hidden;" onclick="cancel();">取消</button> 
				<input type="submit" class="ui-btn ui-btn-inline ui-btn-b" id="goedit" style="visibility: hidden;" value="確認"> 
              </form>
            </div><!-- 內框div -->
          </div><!-- member-main-downcontent -->
  </div><!-- END Pageone main -->
  <div data-role="footer" style="text-align:center;width:100%;height:60px;background:white;border:0px;">
     
  </div> 
</div>
<!--end pageone -->
</body>
</html>


