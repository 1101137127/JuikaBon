<?php
        header("Content-Type:text/html; charset=utf-8");
	include("../connectDBModel/db.php");
  include ("../base/check.php");
  session_start(true);
  $store_id = $_SESSION['store_id'];
	$stmt = $conn->prepare("SELECT * FROM `message_Test` WHERE `store_id`='$store_id'");
	$stmt->execute();
	$list.='';
	foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
		$list.='<li class="ui-li-has-thumb ui-first-child">
		<a href="ShowNewsletters.php?id=' . $row['mess_id'] . '" class="ui-btn ui-btn-icon-right ui-icon-carat-r"><h2>' . $row['mess_name'] . '</h2></a></li>';
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
      <div style="font-size:22px;color:white;text-align:center;">簡訊通知</div>
    </div>
  <!-- End Pageone header -->

  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:650px;background:white;">
	<div id='member-main-downcontent' class='member-main col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div id='' style="margin:0 auto;width:100%">
              <form class="ui-filterable">
                <input id="myFilter" data-type="search" placeholder="搜尋">
              </form>
			  <ul data-role="listview" data-filter="true" data-input="#myFilter"  data-inset="true" class="primary-menu ui-listview ui-listview-inset ui-corner-all ui-shadow">
                          <?php echo $list; ?>

            </div><!-- 內框div -->
            <a href="../message/text.html" data-ajax="false" class="ui-btn ui-btn-b ui-icon-plus ui-btn-icon-left ui-btn-inline ui-mini">新增</a>
          </div><!-- member-main-downcontent -->
  </div><!-- END Pageone main -->
  <div data-role="footer" style="text-align:center;width:100%;height:60px;background:white;border:0px;">
     
  </div> 
</div>
<!--end pageone -->
</body>
</html>

