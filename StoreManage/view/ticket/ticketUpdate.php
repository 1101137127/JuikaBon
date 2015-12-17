<?php
	header("Content-Type:text/html; charset=utf-8");
	include("../connectDBModel/db.php");
    $coupon_id = $_GET["coupon_id"];
	$stmt = $conn->prepare("SELECT * FROM `coupon` WHERE `coupon_id`='$coupon_id' ");
	$stmt->execute();
	$list.='';
	$link='';

	foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
		$list.='<div data-role="fieldcontain" >
					<label class="Inputlabel" for="coupon_name" >抽獎名稱</label>
					<input type="text" name="coupon_name" id="coupon_name" value="'.$row['coupon_name'].'"  />
				</div>
				<div data-role="fieldcontain">	
					<label class="Inputlabel" for="start_date">開始領取日期</label>
					<input type="date" name="start_date" id="start_date" value="'.$row['start_date'].'"  />
				</div>
				<div data-role="fieldcontain">
					<label class="Inputlabel" for="end_date">領取截止日期</label>
					<input type="date" name="end_date" id="end_date" value="'.$row['end_date'].'"  />
				</div>
				<div data-role="fieldcontain">
					<label class="Inputlabel" for="use_enddate">使用截止日期</label>
					<input type="date" name="use_enddate" id="use_enddate" value="'.$row['use_enddate'].'"  />
				</div>
				<div data-role="fieldcontain">
					<label class="Inputlabel" for="ps">說明</label>
					<input type="text" name="ps" id="ps" value="'.$row['ps'].'"  />
				</div>
				<input type="hidden"  id="coupon_id" value="'.$row['coupon_id'].'"  />				';
  $link='<a onclick="Save()" name="detailBtn" data-role="button"  data-mini="true" data-inline="true" data-theme="b" data-iconpos="left" class="ui-btn ui-shadow ui-btn-corner-all ui-btn-inline ui-btn-up-c">儲存</a>';
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
      height:200px;
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
	tr {
    border: 1px solid lightgray;
	}
  </style>
  <script>
    function Save () 
	{
		  var coupon_id = $("#pageone").find("#coupon_id").val();
		  var coupon_name = $("#pageone").find("#coupon_name").val();
		  var start_date = $("#pageone").find("#start_date").val();
		  var end_date = $("#pageone").find("#end_date").val();
		  var use_enddate = $("#pageone").find("#use_enddate").val();
		  var ps = $("#pageone").find("#ps").val();
		  console.log($("#pageone").find("#coupon_id").val());
		  console.log($("#pageone").find("#coupon_name").val());
		  console.log($("#pageone").find("#start_date").val());
		  console.log($("#pageone").find("#end_date").val());
		  console.log($("#pageone").find("#use_enddate").val());
		  console.log($("#pageone").find("#ps").val());
      
		$.ajax({
		url: "Update_ticket.php", 
		type:"POST",
		data: {
		  coupon_name:coupon_name,
		  coupon_id:coupon_id,
		  start_date:start_date,
		  end_date:end_date,
		  use_enddate:use_enddate,
		  ps:ps,
		},
		datatype:"text",//回傳的資料型態
		success: function(data){
		   alert(data);
		   window.history.go(-1) ;
			},
			error:function(xhr, ajaxOptions, thrownError){ 
					  console.log(xhr.status); 
					  console.log(thrownError);
				   }

		  });
    };
  </script>

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
    <div style="background:#001F33;border:0px;height:50px;">
      <br/>
      <div style="font-size:22px;color:white;text-align:center;">抽獎詳情</div>
    </div>
  <!-- End Pageone header -->

  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:650px;background:white;">
	<div id='member-main-downcontent' class='member-main col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div id='' style="margin:0 auto;width:100%">
				      <?php echo $list ?>
				      <?php echo $link; ?>
            </div><!-- 內框div -->
    </div><!-- member-main-downcontent -->
  </div><!-- END Pageone main -->
  <div data-role="footer" style="text-align:center;width:100%;height:60px;background:white;border:0px;">
     
  </div> 
</div>
<!--end pageone -->
</body>
</html>