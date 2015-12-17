<?php
	include ("check.php");
	header("Content-Type:text/html; charset=utf-8");
	include("../connectDBModel/db.php");
	$stmt = $conn->prepare("SELECT `coupon_id`,`coupon_name` FROM `coupon`");
	$stmt->execute();
	$list.='';
	$link='';
	foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
		$list.='<li class="ui-li-has-thumb ui-first-child">
		<a href="ticketDetail.php?coupon_id='.$row['coupon_id'].'" class="ui-btn ui-btn-icon-right ui-icon-carat-r"><h2>' . $row['coupon_name'] . '</h2></a></li>';
	}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
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



<!--主畫面開始 -->
<div data-role="page" id="page_0" >

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
      <div style="font-size:18px;color:white;text-align:center;">禮卷管理</div>
    </div>
  <!-- End Pageone header -->

	<div data-role="main" class="ui-content">
		
			<form class="ui-filterable">
                <input id="myFilter" data-type="search" placeholder="搜尋禮卷">
              </form>

			</div>
			<ul data-role="listview" data-filter="true" data-input="#myFilter" data-inset="true">
				<?php echo $list;
				
				?>		
			</ul>	
				<a href="ticketInsert.html" class="ui-btn ui-btn-inline ui-shadow">新增</a>		
	</div>

</div>


<!--主畫面結束 -->


<!--page_1開始 -->
<div data-role="page" id="page_1" >

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
      <div style="font-size:18px;color:white;text-align:center;">禮卷詳請</div>
    </div>
  <!-- End Pageone header -->

	<div data-role="main" class="ui-content">
		
		<div data-role="main" class="ui-content">
			<form method="post" action="demoform.asp">
				<div class="ui-field-contain">
					<label for="ticketname">禮卷名稱:</label>
					<input type="text" name="ticketname" id="ticketname">       
					<label for="ticket_date_start">禮卷發放日期:</label>
					<input type="date" name="ticket_date_start" id="ticket_date_start">
					<label for="ticket_date_end">禮卷截止日期:</label>
					<input type="date" name="ticket_date_end" id="ticket_date_end">
					<label for="ticket_other">說明:</label>
					<input type="text" name="ticket_other" id="ticket_other">
					<fieldset data-role="controlgroup">
					<legend>請選擇禮卷種類:</legend>
					  <label for="coupon_percentoff">折價卷</label>
					  <input type="radio" name="coupon_type" id="coupon_percentoff" value="1">
					  <label for="coupon_money">消費卷</label>
					  <input type="radio" name="coupon_type" id="coupon_money" value="2">	
					</fieldset>

				</div>
				
				<input type="submit" data-inline="true" value="新增">
			</form>
		</div>

	</div>

</div>
<!--page_1結束 -->


<!--page_2開始 -->
<div data-role="page" id="page_2" >

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
      <div style="font-size:18px;color:white;text-align:center;">禮卷管理</div>
    </div>
  <!-- End Pageone header -->
	<div data-role="main" class="ui-content">
		
		<div data-role="main" class="ui-content">
			<form method="post" action="demoform.asp">
				<div class="ui-field-contain">
					<label for="ticketname">禮卷名稱:</label>
					<input type="text" name="ticketname" id="ticketname">       
					<label for="ticket_date_start">禮卷發放日期:</label>
					<input type="date" name="ticket_date_start" id="ticket_date_start">
					<label for="ticket_date_end">禮卷截止日期:</label>
					<input type="date" name="ticket_date_end" id="ticket_date_end">
					<label for="ticket_other">說明:</label>
					<input type="text" name="ticket_other" id="ticket_other">
					<fieldset data-role="controlgroup">
					<legend>請選擇禮卷種類:</legend>
					  <label for="coupon_percentoff">折價卷</label>
					  <input type="radio" name="coupon_type" id="coupon_percentoff" value="1">
					  <label for="coupon_money">消費卷</label>
					  <input type="radio" name="coupon_type" id="coupon_money" value="2">	
					</fieldset>
				</div>
				<a href="#ticket_delete_popup" data-rel="popup" data-position-to="window" data-transition="fade" class="ui-btn ui-corner-all ui-shadow ui-btn-inline">刪除</a>
				<div data-role="popup" id="ticket_delete_popup">
				   <div data-role="main" class="ui-content">
					<h2>確認刪除?</h2>
					<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b " data-rel="back">刪除</a>
					<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b " data-rel="back">取消</a>
				  </div>
				</div>
				<a href="#page_3" class="ui-btn ui-btn-inline  ui-shadow">修改</a>
			</form>
		</div>

	</div>
	 

</div>
<!--page_2結束 -->


<!--page_3開始 -->
<div data-role="page" id="page_3" >

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
      <div style="font-size:18px;color:white;text-align:center;">禮卷詳請</div>
    </div>
  <!-- End Pageone header -->

	<div data-role="main" class="ui-content">
		
		<div data-role="main" class="ui-content">
			<form method="post" action="demoform.asp">
				<div class="ui-field-contain">
					<label for="ticketname">禮卷名稱:</label>
					<input type="text" name="ticketname" id="ticketname">       
					<label for="ticket_date_start">禮卷發放日期:</label>
					<input type="date" name="ticket_date_start" id="ticket_date_start">
					<label for="ticket_date_end">禮卷截止日期:</label>
					<input type="date" name="ticket_date_end" id="ticket_date_end">
					<label for="ticket_other">說明:</label>
					<input type="text" name="ticket_other" id="ticket_other">
					<fieldset data-role="controlgroup">
					<legend>請選擇禮卷種類:</legend>
					  <label for="coupon_percentoff">折價卷</label>
					  <input type="radio" name="coupon_type" id="coupon_percentoff" value="1">
					  <label for="coupon_money">消費卷</label>
					  <input type="radio" name="coupon_type" id="coupon_money" value="2">	
					</fieldset>
				</div>
				<a href="#ticket_save_popup" data-rel="popup" data-position-to="window" data-transition="fade" class="ui-btn ui-corner-all ui-shadow ui-btn-inline">儲存</a>
				<div data-role="popup" id="ticket_save_popup">
				   <div data-role="main" class="ui-content">
					<h2>儲存成功!</h2>
					<a href="#page_0" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b ">回到主頁面</a>
				  </div>
				</div>
			</form>
		</div>

	</div>

</div>
<!--page_3結束 -->


<!--page_3_2開始 -->
<div data-role="page" id="page_3_2" >

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
      <div style="font-size:18px;color:white;text-align:center;">禮卷詳請</div>
    </div>
  <!-- End Pageone header -->

	<div data-role="main" class="ui-content">
		
		<div class="ui-grid-a">
			<div class="ui-block-a" style="text-align: center;">
				<img src="http://www.w3schools.com/html/pic_mountain.jpg"  >
				<p>禮卷管理1</p>
			  </div>

			  <div class="ui-block-b" style="text-align: center;">
				<img src="http://www.w3schools.com/html/pic_mountain.jpg"  >
				<p>禮卷管理2</p>
				 
			 </div>
		</div>

	</div>

</div>
<!--page_3_2結束 -->




</body>
</html>