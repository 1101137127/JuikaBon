<?php
	header("Content-Type:text/html; charset=utf-8");
  include ("../base/check.php");
	include("../connectDBModel/db.php");
  session_start(true);
  $store_id = $_SESSION['store_id'];
	$stmt = $conn->prepare("SELECT `coupon_id`,`coupon_name` FROM `coupon` where use_flag='Y' and `store_id`='$store_id'");
	$stmt->execute();
	$list.='';
  $list1.='';

  //<a onclick="if(!doConfirm())return false;" href="Delete.php?coupon_id='.$row['coupon_id'].'" id="doConfirm" data-ajax="false">Delete</a>
	foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $list.='<li>
    <a href="couponDetail.php?coupon_id='.$row['coupon_id'].'" id="doConfirm" data-ajax="false"><h2>' . $row['coupon_name'] . '</h2></a>
    <a onclick="doConfirm('.$row['coupon_id'].')"  id="doConfirm" data-ajax="false">Delete</a>
    </li>';
  }


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
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
  <style>
    .member-main{
      border:0px solid;
      width:100%;
      height:300px;
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
  <script>
    function search(obj){
      obj.focus();
      //alert(obj.options[obj.selectedIndex].value)
    } 

    function doConfirm(id) {
      var del = confirm("是否確定刪除?");
      if(del==true){
        $.ajax({
        url: "./model/Delete_coupon.php", 
        type:"POST",
        data: {
          coupon_id:id
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
      <div style="font-size:22px;color:white;text-align:center;">禮卷管理</div>
    </div>
  <!-- End Pageone header -->

  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:650px;background:white;">
	<div id='member-main-downcontent' class='member-main col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div id='' style="margin:0 auto;width:100%">
              <form class="ui-filterable">
                <input id="myFilter" data-type="search" placeholder="搜尋禮卷">
              </form>
              <div id="data-content">
                <ul data-role="listview" data-filter="true" data-input="#myFilter"  data-inset="true" data-split-icon="delete" class="primary-menu ui-listview ui-listview-inset ui-corner-all ui-shadow touch">
                <?php echo $list; ?>
                </ul>
              </div>
            </div><!-- 內框div -->

            <div id="confirm" class="ui-content" data-role="popup" data-theme="a">
       

  </div>
    <div>
    <a href="couponInsert.html" data-ajax="false" class="ui-btn ui-btn-b ui-icon-plus ui-btn-icon-left ui-btn-inline ui-mini">新增</a>

    </div>
    </div><!-- member-main-downcontent --></div><!-- END Pageone main -->
  <div data-role="footer" style="text-align:center;width:100%;height:60px;background:white;border:0px;">
     
  </div> 
</div>
<!--end pageone -->
</body>
</html>