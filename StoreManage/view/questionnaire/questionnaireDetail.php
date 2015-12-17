<?php
	header("Content-Type:text/html; charset=utf-8");
	include("../connectDBModel/db.php");
    $qst_id = $_GET["qst_id"];
	$stmt = $conn->prepare("SELECT qst.`qst_id`,`qst_name`,`start_date`,`end_date`,qst.`reward_pt`
    ,CASE WHEN`qst_type`='store' THEN '店家滿意度問卷' WHEN `qst_type`='act' THEN '活動問卷' WHEN `qst_type`='goods' THEN '商品問卷' END AS qst_type,count(distinct `mem_id`) as total_count FROM `questionnaire` as qst LEFT JOIN `question_detail` as qst_d  ON qst.`qst_id` = qst_d.`qst_id` WHERE qst.`qst_id`='$qst_id' ");
	$stmt->execute();
	$list.='';
  $link='';

	foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
		$list.='<div data-role="fieldcontain" >
					<label class="Inputlabel" for="qst_name" >問卷名稱</label>
					<input type="text" readonly="readonly" name="qst_name" id="qst_name" value="'.$row['qst_name'].'"  />
          <label id="qst_name_errorMsg" style="color:red;display:none;" >問卷名稱未填</label>
				</div>
        <div data-role="fieldcontain" >
          <label class="Inputlabel" for="qst_type" >問卷類型</label>
          <input type="text" readonly="readonly" name="qst_type" id="qst_type" value="'.$row['qst_type'].'"  />
        </div>
				<div data-role="fieldcontain">	
					<label class="Inputlabel" for="start_date">啟用日期</label>
					<input type="date" readonly="readonly" name="start_date" id="start_date" value="'.$row['start_date'].'"  />
          <label id="start_date_errorMsg" style="color:red;display:none;" >啟用日期未填</label>
          <label id="start_date_checkMsg" style="color:red;display:none;" >啟用日期不能大等於結束日</label>
				</div>
				<div data-role="fieldcontain">  
          <label class="Inputlabel" for="end_date">結束日期</label>
          <input type="date" readonly="readonly" name="end_date" id="end_date" value="'.$row['end_date'].'"  />
          <label id="end_date_errorMsg" style="color:red;display:none;" >結束日期未填</label>
        </div>
				<div data-role="fieldcontain">
					<label class="Inputlabel" for="reward_pt">獎勵點數</label>
					<input type="number" readonly="readonly" name="reward_pt" id="reward_pt" value="'.$row['reward_pt'].'"  />
          <label id="reward_pt_errorMsg" style="color:red;display:none;" >獎勵點數未填</label>
          <input type="hidden"  id="qst_id" value="'.$row['qst_id'].'"  />
				</div>
        <div data-role="fieldcontain">
          <label class="Inputlabel" for="total_count">已填寫人數</label>
          <input type="number" readonly="readonly" name="reward_pt" id="reward_pt" value="'.$row['total_count'].'"  />
        </div>';
  $link='<a  data-ajax="false" href="subjectDetail.php?qst_id='.$row['qst_id'].'"  name="detailBtn" id="detailBtn" data-role="button"  data-mini="true" data-inline="true" data-theme="b" data-iconpos="left" class="ui-btn ui-shadow ui-btn-corner-all ui-btn-inline ui-btn-up-c">查看題目詳情</a>
  <a data-ajax="false" href="participate.php?qst_id='.$row['qst_id'].'&&total_count='.$row['total_count'].'"  name="detailBtn" id="detailBtn" data-role="button"  data-mini="true" data-inline="true" data-theme="b" data-iconpos="left" class="ui-btn ui-shadow ui-btn-corner-all ui-btn-inline ui-btn-up-c">查看填寫狀況</a>';
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
  function edit () {
        document.getElementById("editBtn").style.display="none";
        document.getElementById("qst_type").style.backgroundColor="#b3b3cc";
        $("#qst_name").removeAttr("readonly");
        $("#start_date").removeAttr("readonly");
        $("#end_date").removeAttr("readonly");
        $("#reward_pt").removeAttr("readonly");
        document.getElementById("btnDiv").style.display="block";
        document.getElementById("linkDiv").style.display="none";
  };
  function Cancel () {
        document.getElementById("editBtn").style.display="block";
        document.getElementById("qst_type").style.backgroundColor="";
        $("#qst_name").attr("readonly","readonly");
        $("#start_date").attr("readonly","readonly");
        $("#end_date").attr("readonly","readonly");
        $("#reward_pt").attr("readonly","readonly");
        document.getElementById("btnDiv").style.display="none";
        document.getElementById("linkDiv").style.display="block";
  };
  function Save () {
      var qst_id = $("#pageone").find("#qst_id").val();
      var qst_name = $("#pageone").find("#qst_name").val();
      var start_date = $("#pageone").find("#start_date").val();
      var end_date = $("#pageone").find("#end_date").val();
      var reward_pt = $("#pageone").find("#reward_pt").val();
      var checkData = checkPageOneData(qst_name,start_date,end_date,reward_pt);
      if(checkData == true){
        $.ajax({
        url: "./model/Update_questionnaire.php", 
        type:"POST",
        data: {
          qst_name:qst_name,
          qst_id:qst_id,
          start_date:start_date,
          end_date:end_date,
          reward_pt:reward_pt,
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
  function checkPageOneData(qst_name,start_date,end_date,ad_words,reward_pt){
      var Empety = false;
      if(qst_name ==""){
        Empety=true;
        document.getElementById("qst_name_errorMsg").style.display="block";
      }
      else if(qst_name!=""){
        document.getElementById("qst_name_errorMsg").style.display="none";
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
      if(reward_pt ==""){
        Empety=true;
        document.getElementById("reward_pt_errorMsg").style.display="block";
      }
      else if(reward_pt!=""){
        document.getElementById("reward_pt_errorMsg").style.display="none";
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
      <a data-ajax="false" href="#" class="ui-btn-left ui-btn ui-icon-back ui-btn-icon-left ui-shadow ui-corner-all" data-rel="back" data-role="button" role="button">返回</a>
      <img src="../../image/logo.png" width="200px" height="80px">  
      <a data-ajax="false" href="../home/home.php" target="_self" class="ui-btn-right ui-btn ui-icon-home ui-btn-icon-left ui-shadow ui-corner-all" data-role="button" role="button">首頁</a>
    </div>
  </div>
    <div style="background:#001F33;border:0px;height:50px;">
      <br/>
      <div style="font-size:22px;color:white;text-align:center;">問卷詳情
      </div>
    </div>
  <!-- End Pageone header -->

  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:650px;background:white;">
	<div id='member-main-downcontent' class='member-main col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div id='' style="margin:0 auto;width:100%">
              <a style="float:right;" onclick="edit()" id="editBtn" name="editBtn" data-role="button"  data-mini="true" data-inline="true"  data-iconpos="right">編輯</a>
				      <?php echo $list ?>
              <div id="linkDiv">
              <?php echo $link; ?>
              </div>
              <div id="btnDiv" style="display:none;">
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