<?php
  header("Content-Type:text/html; charset=utf-8");
	include("../connectDBModel/db.php");
  session_start(true);
  $store_id = $_SESSION['store_id'];
  $id=$_GET['id'];
	$stmt = $conn->prepare("SELECT `member`.`mem_id`, `cellphone`, `name`, `birthday`, `gender`, `address`, `password`, `imgtype`,IFNULL(`total_pt`, 0) AS `total_pt` FROM `member` LEFT JOIN `point`ON `member`.`mem_id` = `point`.`mem_id` WHERE `point`.`store_id` = '$store_id' AND `member`.`mem_id` = '".$id."'" );
	$stmt->execute();

        $msg.='';
//	foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
//		$msg.='
//                <div class="ui-field-contain">
//                <label>姓名:</label>
//                <input type="text" name="text-12" id="text-12"  readonly="readonly" value="' . $row['name'] . '"></div>
//                <div class="ui-field-contain">
//                <label for="text-12" class="ui-btn ui-btn-inline">電話:</label>
//                <input type="text" name="text-12" id="text-12"  readonly="readonly" value="' . $row['cellphone'] . '"></div>
//                <div class="ui-field-contain">
//                <label for="text-12" class="ui-btn ui-btn-inline">密碼:</label>
//                <input type="text" name="text-12" id="text-12"  readonly="readonly" value="' . $row['password'] . '"></div>
//                <div class="ui-field-contain">
//                <label for="text-12" class="ui-btn ui-btn-inline">生日:</label>
//                <input type="text" name="text-12" id="text-12"  readonly="readonly" value="' . $row['birthday'] . '"></div>
//                <div class="ui-field-contain">
//                <label for="text-12" class="ui-btn ui-btn-inline">性別:</label>
//                <input type="text" name="text-12" id="text-12"  readonly="readonly" value="' . $row['gender'] . '"></div>
//                <div class="ui-field-contain">
//                <label for="text-12" class="ui-btn ui-btn-inline">地址:</label>
//                <input type="text" name="text-12" id="text-12"  readonly="readonly" value="' . $row['address'] . '"></div>
//                ';
//	}
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
	      $msg.='
                <div data-role="main" class="ui-content" >
			 <font face="微軟正黑體">
				<ul data-role="listview" data-inset="true">
				  <li data-icon="false"><b>會員姓名:</b><input type="text" data-role="none" style="border:0px;" readonly="true" value="'.$row['name'].'"></li> '; 
          if($row['imgtype']==null||$row['imgtype']==""){
            $msg.='<li data-icon="false"><b>會員照片:</b><div><img src=../../picture/member/Nopic.jpg id="mem_pic"></div></li> ';
          }   
          else{
            $msg.='<li data-icon="false"><b>會員照片:</b><div><img src=../../picture/member/'.$row['imgtype'].' id="mem_pic"></div></li> '; 
          }
                  
          $msg.='<li data-icon="false"><b>會員電話:</b><input type="text" data-role="none" style="border:0px;"  value="'.$row['cellphone'].'"></li>
				  <li data-icon="false"><b>會員密碼:</b><input type="text" data-role="none" style="border:0px;" readonly="true" value="'.$row['password'].'"></li>
				  <li data-icon="false"><b>出生日期:</b><input type="text" data-role="none" style="border:0px;" readonly="true" value="'.$row['birthday'].'"></li>
				  <li data-icon="false"><b>性別:</b><input type="text" data-role="none" style="border:0px;" readonly="true" value="'.$row['gender'].'"></li>
				  <li data-icon="false"><b>地址:</b><input type="text" data-role="none" style="border:0px;" readonly="readonly" value="'.$row['address'].'"></li>
          <li data-icon="false"><b>點數:</b><input type="text" data-role="none" style="border:0px;" readonly="readonly" value="'.$row['total_pt'].'"></li>				  
				</ul>
			 </font>		
			</div>

          
                ';
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
     function abcd(){window.location.href="./member.html#pagetwo"}
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
    #mem_pic {
  width: 70%;
  height : 70%;
  max-height: 100%;
  max-width: 100%;
}
    

  </style>
</head>
<body >
<div data-role="page" id="pageone" >
   <!-- Pageone header -->
	<div data-role="header" style=" background:#0097A7;border:0px;height:80px;">
    <div id='' class='' style="font-size:28px;color:white;text-align:center;">
      <a href="#" data-ajax="false" class="ui-btn-left ui-btn ui-icon-back ui-btn-icon-left ui-shadow ui-corner-all" data-rel="back" data-role="button" role="button">返回</a>
      <img src="../../image/logo.png" width="200px" height="80px">  
      <a href="../home/home.php" target="_self" class="ui-btn-right ui-btn ui-icon-home ui-btn-icon-left ui-shadow ui-corner-all" data-role="button" role="button">首頁</a>
    </div>
  </div>
    <div style="background:#001F33;border:0px;height:50px;">
      <br/>
      <div style="font-size:22px;color:white;text-align:center;">會員管理</div>
    </div>
  <!-- End Pageone header -->

  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:650px;background:white;">
	<div id='member-main-downcontent' class='member-main col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div id='' style="margin:0 auto;width:100%">
              <form class="ui-filterable">
              </form>
<!--			  <ul data-role="listview" data-filter="true" data-input="#myFilter"  data-inset="true" class="primary-menu ui-listview ui-listview-inset ui-corner-all ui-shadow">-->
                          <?php echo $msg; ?>      
                              
                              
                              
                              
                              
                              
                              
                              
            </div><!-- 內框div -->
          </div><!-- member-main-downcontent -->
  </div><!-- END Pageone main -->
  <div data-role="footer" style="text-align:center;width:100%;height:60px;background:white;border:0px;">
     
  </div> 
</div>
<!--end pageone -->
</body>
</html>


