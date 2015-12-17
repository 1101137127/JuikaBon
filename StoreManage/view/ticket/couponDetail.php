<?php
	header("Content-Type:text/html; charset=utf-8");
	include("../connectDBModel/db.php");
  $coupon_id = $_GET["coupon_id"];
	$stmt = $conn->prepare("SELECT `coupon_id`,`coupon`.`coupon_type_id`,`coupon_type`.`coupon_type_name`,`coupon_name`,`start_date`,`end_date`,`use_enddate`,`ps` FROM `coupon` LEFT JOIN `coupon_type` ON `coupon`.`coupon_type_id` = `coupon_type`.`coupon_type_id` WHERE `coupon_id`='$coupon_id'");
	$stmt->execute();
	$list.='';

	foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
		$list.='
        <div id="mydiv" data-role="fieldcontain" >
					<label class="Inputlabel" for="coupon_name">抽獎名稱</label>
          <input type="text" readonly="readonly" name="coupon_name" id="coupon_name" value="'.$row['coupon_name'].'"  />
          <label id="coupon_name_errorMsg" style="color:red;display:none;" >抽獎名稱未填</label>
				</div>
        <div data-role="fieldcontain" >
          <label class="Inputlabel" for="coupon_type_name" >禮卷類型</label>
          <input type="text" readonly="readonly"  name="coupon_type_name" id="coupon_type_name" value="'.$row['coupon_type_name'].'"  />
        </div>
				<div data-role="fieldcontain">	
					<label class="Inputlabel" for="start_date">開始領取日期</label>
					<input type="date" readonly="readonly" name="start_date" id="start_date" value="'.$row['start_date'].'"  />
          <label id="start_date_errorMsg" style="color:red;display:none;" >開始日期未填</label>
          <label id="start_date_checkMsg" style="color:red;display:none;" >開始日期不能大等於結束日</label>
				</div>
        <div data-role="fieldcontain">  
          <label class="Inputlabel" for="end_date">結束領取日期</label>
          <input type="date" readonly="readonly" name="end_date" id="end_date" value="'.$row['end_date'].'"  />
          <label id="end_date_errorMsg" style="color:red;display:none;" >結束領取日期未填</label>
        </div>
        <div data-role="fieldcontain">  
          <label class="Inputlabel" for="use_enddate">使用截止日期</label>
          <input type="date" readonly="readonly" name="use_enddate" id="use_enddate" value="'.$row['use_enddate'].'"  />
          <label id="use_enddate_errorMsg" style="color:red;display:none;" >使用截止日期未填</label>
        </div>
				<div data-role="fieldcontain">
					<label class="ps" for="ps">說明</label>
          <textarea cols="50" readonly="readonly" rows="5" name="ps" id="ps">'.$row['ps'].'</textarea>
          <label id="ps_errorMsg" style="color:red;display:none;" >說明未填</label>
          <input type="hidden"  id="coupon_id" value="'.$row['coupon_id'].'"  />
				</div>';
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
   $(document).ready(function () {
    function convertToISO(timebit) {
    // remove GMT offset
    timebit.setHours(0, -timebit.getTimezoneOffset(), 0, 0);
    // format convert and take first 10 characters of result
    var isodate = timebit.toISOString().slice(0,10);
    return isodate;
  }
  var start_date = document.getElementById('start_date');
  var end_date = document.getElementById('end_date');
  var currentdate = new Date();
  start_date.min = convertToISO(currentdate);
  start_date.placeholder = start_date.min;
  end_date.min=convertToISO(currentdate);
  end_date.placeholder = end_date.min;
  });

  function Test(){
    document.getElementById("mydiv").style.height = "100px";
    document.getElementById("mydiv").style.backgroundColor="#e0e0eb";
    document.getElementById("submitBtn").style.display="block";
    $("#coupon_name").removeAttr("readonly");
  };

  function display(){
    document.getElementById("editBtn").style.display="none";
    document.getElementById("coupon_type_name").style.backgroundColor="#b3b3cc";
    $("#coupon_name").removeAttr("readonly");
    $("#start_date").removeAttr("readonly");
    $("#end_date").removeAttr("readonly");
    $("#use_enddate").removeAttr("readonly");
    $("#ps").removeAttr("readonly");
    document.getElementById("hide").style.display="block";
  };

  function Cancel () {
        document.getElementById("editBtn").style.display="block";
        document.getElementById("coupon_type_name").style.backgroundColor="";
        $("#coupon_name").attr("readonly","readonly");
        $("#start_date").attr("readonly","readonly");
        $("#end_date").attr("readonly","readonly");
        $("#use_enddate").attr("readonly","readonly");
        $("#ps").attr("readonly","readonly");
        document.getElementById("hide").style.display="none";
  };
  function Update () {
      var coupon_id = $("#pageone").find("#coupon_id").val();
      var coupon_name = $("#pageone").find("#coupon_name").val();
      var start_date = $("#pageone").find("#start_date").val();
      var end_date = $("#pageone").find("#end_date").val();
      var use_enddate = $("#pageone").find("#use_enddate").val();
      var ps = $("#pageone").find("#ps").val();
      var checkData = checkPageOneData(coupon_name,start_date,end_date,use_enddate,ps);
      if(checkData == true){
        $.ajax({
        url: "./model/Update_coupon.php", 
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
           alert("修改成功");
           location.reload() ;
            },
            error:function(xhr, ajaxOptions, thrownError){ 
                      alert("修改失敗");
                      location.reload() ;
                      console.log(xhr.status); 
                      console.log(thrownError);
                   }

          });
      }
      else{
        alert("有欄位未正確填寫，請確認！");
      }
    
    
  };
  function checkPageOneData(coupon_name,start_date,end_date,use_enddate,ps){
      var Empety = false;
      if(coupon_name ==""){
        Empety=true;
        document.getElementById("coupon_name_errorMsg").style.display="block";
      }
      else if(coupon_name!=""){
        document.getElementById("coupon_name_errorMsg").style.display="none";
      }
      if(start_date ==""){
        Empety=true;
        document.getElementById("start_date_errorMsg").style.display="block";
      }
      else if(start_date!=""){
        document.getElementById("start_date_errorMsg").style.display="none";
      }
      if(end_date ==""){
        Empety=true;
        document.getElementById("end_date_errorMsg").style.display="block";
      }
      else if(end_date!=""){
        document.getElementById("end_date_errorMsg").style.display="none";
      }
      if(use_enddate ==""){
        Empety=true;
        document.getElementById("use_enddate_errorMsg").style.display="block";
      }
      else if(use_enddate!=""){
        document.getElementById("use_enddate_errorMsg").style.display="none";
      }
      if(ps ==""){
        Empety=true;
        document.getElementById("ps_errorMsg").style.display="block";
      }
      else if(ps!=""){
        document.getElementById("ps_errorMsg").style.display="none";
      }
      if(start_date!="" && end_date!=""){
        if(start_date>=end_date){
          Empety=true;
          document.getElementById("start_date_checkMsg").style.display="block";
        }
        else{
          document.getElementById("start_date_checkMsg").style.display="none";
        }
      }
      if(Empety==true){
        return false;
      }
      else if(Empety==false){
        return true;
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
      <div style="font-size:22px;color:white;text-align:center;">禮卷詳情
      </div>
    </div>
  <!-- End Pageone header -->

  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:650px;background:white;">
	<div id='member-main-downcontent' class='member-main col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div id='' style="margin:0 auto;width:100%">
      <a style="float:right;" onclick="display()"  id="editBtn" name="editBtn" data-role="button"  data-mini="true" data-inline="true"  data-iconpos="right" style="display:block;">編輯</a>
				      <?php echo $list ?>
              <div id="hide" style="display:none;">
              <a onclick="Cancel()" id="cancelBtn" name="cancelBtn" data-role="button"  data-mini="true" data-inline="true"  data-iconpos="left" >取消</a>
              <a onclick="Update()" id="submitBtn" name="submitBtn" data-role="button"  data-mini="true" data-inline="true"  data-iconpos="left">儲存</a>
            </div>
            <!-- 內框div -->
              </div>
    </div><!-- member-main-downcontent -->
  </div><!-- END Pageone main -->
  <div data-role="footer" style="text-align:center;width:100%;height:60px;background:white;border:0px;">
     
  </div> 
</div>
<!--end pageone -->
</body>
</html>