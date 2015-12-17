<?php
	header("Content-Type:text/html; charset=utf-8");
	include("../connectDBModel/db.php");
  $mess_id = $_GET["mess_id"];
	$stmt = $conn->prepare("SELECT `mess_id`,`mess_name`,`start_date`,`end_date`,`mess_content` FROM `message`  WHERE `mess_id`='$mess_id'");
	$stmt->execute();
	$list.='';

	foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
		$list.='
                <div id="mydiv" data-role="fieldcontain" >
                     <label class="Inputlabel" for="mess_name" >訊息名稱</label>
                     <input type="text" readonly="readonly" name="mess_name" id="mess_name" value="'.$row['mess_name'].'"  />
                     <label id="mess_name_errorMsg" style="color:red;display:none;" >訊息名稱未填</label>
                </div>
                <div data-role="fieldcontain">  
                     <label class="Inputlabel" for="start_date">開始推播日期</label>
                     <input type="date" readonly="readonly" name="start_date" id="start_date" value="'.$row['start_date'].'"  />
                     <label id="start_date_errorMsg" style="color:red;display:none;" >開始推播未填</label>
                     <label id="start_date_checkMsg" style="color:red;display:none;" >開始日期不能大等於結束日</label>
                </div>
                <div data-role="fieldcontain">  
                     <label class="Inputlabel" for="end_date">結束推播日期</label>
                     <input type="date" readonly="readonly" name="end_date" id="end_date" value="'.$row['end_date'].'"  />
                     <label id="end_date_errorMsg" style="color:red;display:none;" >結束推播日期未填</label>
                </div>
                <div data-role="fieldcontain">  
                     <label class="Inputlabel" for="mess_content">訊息內容</label>
                     <textarea cols="50" rows="5" name="mess_content" id="mess_content">'.$row['mess_content'].'</textarea>
                     <label id="mess_content_errorMsg" style="color:red;display:none;" >訊息內容未填</label>
                     <input type="hidden"  id="mess_id" value="'.$row['mess_id'].'"  />
                </div>
				';
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

  function display(){
    document.getElementById("editBtn").style.display="none";
    $("#mess_name").removeAttr("readonly");
    $("#start_date").removeAttr("readonly");
    $("#end_date").removeAttr("readonly");
    $("#mess_content").removeAttr("readonly");
    document.getElementById("hide").style.display="block";
  };

  function Cancel () {
        document.getElementById("editBtn").style.display="block";
        $("#mess_name").attr("readonly","readonly");
        $("#start_date").attr("readonly","readonly");
        $("#end_date").attr("readonly","readonly");
        $("#mess_content").attr("readonly","readonly");
        document.getElementById("hide").style.display="none";
  };
  function Update () {
      var mess_id = $("#pageone").find("#mess_id").val();
      var mess_name = $("#pageone").find("#mess_name").val();
      var mess_content = $("#pageone").find("#mess_content").val();
      var start_date = $("#pageone").find("#start_date").val();
      var end_date = $("#pageone").find("#end_date").val();
      var checkData = checkPageOneData(mess_name,start_date,end_date,mess_content);
      if(checkData == true){
        $.ajax({
        url: "./model/Update_message.php", 
        type:"POST",
        data: {
          mess_id:mess_id,
          mess_name:mess_name,
          start_date:start_date,
          end_date:end_date,
          mess_content:mess_content
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
  function checkPageOneData(mess_name,start_date,end_date,mess_content){
      var Empety = false;
      if(mess_name ==""){
        Empety=true;
        document.getElementById("mess_name_errorMsg").style.display="block";
      }
      else if(mess_name!=""){
        document.getElementById("mess_name_errorMsg").style.display="none";
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
      if(mess_content ==""){
        Empety=true;
        document.getElementById("mess_content_errorMsg").style.display="block";
      }
      else if(mess_content!=""){
        document.getElementById("mess_content_errorMsg").style.display="none";
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
      <div style="font-size:22px;color:white;text-align:center;">訊息詳情
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