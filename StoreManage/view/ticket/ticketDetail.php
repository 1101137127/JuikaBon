<?php
	header("Content-Type:text/html; charset=utf-8");
	include("../connectDBModel/db.php");
  $coupon_id = $_GET["coupon_id"];
	$stmt = $conn->prepare("SELECT `coupon_id`,`coupon`.`coupon_type_id`,`coupon_type`.`coupon_type_name`,`coupon_name`,`start_date`,`end_date`,`use_enddate`,`ps` FROM `coupon` LEFT JOIN `coupon_type` ON `coupon`.`coupon_type_id` = `coupon_type`.`coupon_type_id` WHERE `coupon_id`='$coupon_id'");
	$stmt->execute();
	$list.='';
	$link='';

	foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
		$list.='
        <div data-role="fieldcontain" >
					<label class="Inputlabel" for="coupon_name" >抽獎名稱</label>
					<input type="text"  name="coupon_name" id="coupon_name" value="'.$row['coupon_name'].'"  />
				</div>
        <div data-role="fieldcontain" >
          <label class="Inputlabel" for="coupon_name" >禮卷類型</label>
          <input type="text" readonly="readonly" name="coupon_name" id="coupon_name" value="'.$row['coupon_type_name'].'"  />
        </div>
				<div data-role="fieldcontain">	
					<label class="Inputlabel" for="start_date">開始領取日期</label>
					<input type="date" readonly="readonly" name="start_date" id="start_date" value="'.$row['start_date'].'"  />
				</div>
				<div data-role="fieldcontain">
					<label class="Inputlabel" for="end_date">領取截止日期</label>
					<input type="date" readonly="readonly" name="end_date" id="end_date" value="'.$row['end_date'].'"  />
				</div>
				<div data-role="fieldcontain">
					<label class="Inputlabel" for="use_enddate">使用截止日期</label>
					<input type="date" readonly="readonly" name="use_enddate" id="use_enddate" value="'.$row['use_enddate'].'"  />
				</div>
				<div data-role="fieldcontain">
					<label class="Inputlabel" for="ps">說明</label>
					<input type="text" readonly="readonly" name="ps" id="ps" value="'.$row['ps'].'"  />
				</div>	';
  $link='<a href="ticketUpdate.php?coupon_id='.$row['coupon_id'].'" id="detailBtn" name="detailBtn" data-role="button"  data-mini="true" data-inline="true" data-theme="b" data-iconpos="left" class="ui-btn ui-shadow ui-btn-corner-all ui-btn-inline ui-btn-up-c">修改</a>';
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
  <script type="text/javascript">
  function display(){
    $(#coupon_name).removeAttr("readonly");
    $(#start_date).removeAttr("readonly");
    $(#end_date).removeAttr("readonly");
    $(#use_enddate).removeAttr("readonly";
    $(#ps).removeAttr("readonly");
    document.getElementById("hide").style.display="block";



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
      <a style="float:right;" onclick="display()" id="submitBtn" name="submitBtn" data-role="button"  data-mini="true" data-inline="true"  data-iconpos="right">編輯</a>
    </div>
  <!-- End Pageone header -->

  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:650px;background:white;">
	<div id='member-main-downcontent' class='member-main col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div id='' style="margin:0 auto;width:100%">
				      <?php echo $list ?> 
            <div id="hide" style="display:none;">
              <a onclick="Cancel()" id="cancelBtn" name="cancelBtn" data-role="button"  data-mini="true" data-inline="true"  data-iconpos="left" >取消</a>
              <a onclick="Save()" id="submitBtn" name="submitBtn" data-role="button"  data-mini="true" data-inline="true"  data-iconpos="left">儲存</a>
            </div> 
            </div><!-- 內框div -->
    </div><!-- member-main-downcontent -->
  </div><!-- END Pageone main -->
  <div data-role="footer" style="text-align:center;width:100%;height:60px;background:white;border:0px;">
     
  </div> 
</div>
<!--end pageone -->
</body>
</html>