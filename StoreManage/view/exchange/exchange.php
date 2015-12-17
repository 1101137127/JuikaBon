<?php
  header("Content-Type:text/html; charset=utf-8");
  include ("../base/check.php");
  include("../connectDBModel/db.php");
  session_start(true);
  $store_id = $_SESSION['store_id'];
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
      <div style="font-size:22px;color:white;text-align:center;">點數管理</div>
    </div>
  <!-- End Pageone header -->

  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:650px;background:white;">
	<div id='member-main-downcontent' class='member-main col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div id='' style="margin:0 auto;width:100%">
              <div id="data-content">
                <ul data-role="listview" data-filter="true" data-input="#myFilter"  data-inset="true"  class="primary-menu ui-listview ui-listview-inset ui-corner-all ui-shadow touch">
                    <li>
                        <a href="point.php" id="doConfirm" data-ajax="false"><h2>贈予點數</h2></a>
                    </li>
                    <li>
                        <a href="GiftExchange.php" id="" data-ajax="false"><h2>禮品兌換</h2></a>
                    </li>
                </ul>
              </div>
            </div><!-- 內框div -->

            <div id="confirm" class="ui-content" data-role="popup" data-theme="a">
       

  </div>
    <div>


    </div>
    </div><!-- member-main-downcontent --></div><!-- END Pageone main -->
  <div data-role="footer" style="text-align:center;width:100%;height:60px;background:white;border:0px;">
     
  </div> 
</div>
<!--end pageone -->
</body>
</html>