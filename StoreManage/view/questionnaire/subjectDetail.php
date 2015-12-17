<?php
	header("Content-Type:text/html; charset=utf-8");
	include("../connectDBModel/db.php");
    $qst_id = $_GET["qst_id"];
	$stmt = $conn->prepare("SELECT `qst_name` FROM `question_bank` WHERE `qst_id`='$qst_id' ");
	$stmt->execute();
  $qCount=1;
	$list.='';
  $countDiv='';
	foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
		$list.='<div data-role="fieldcontain" >
          <label class="Inputlabel" for="qst_name'.$qCount.'" >第'.$qCount.'題：題目</label>
          <input type="text" readonly="readonly" name="qst_name" id="qst_name'.$qCount.'" value="'.$row['qst_name'].'"  />
        </div>';
    $qCount++;
	}
  $countDiv.='<div id="countDiv">
  <input type="hidden" id="qCount" value='.$qCount.'>
  <input type="hidden" id="qst_id" value='.$qst_id.'>
  </div>'

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
  function edit () {
        document.getElementById("editBtn").style.display="none";
        var qCount = $("#qCount").val();
        for(i=1;i<=qCount;i++){
        $("#qst_name"+i+"").removeAttr("readonly");
        }
        document.getElementById("btnDiv").style.display="block";
  };
  function Cancel () {
        document.getElementById("editBtn").style.display="block";
    var qCount = $("#qCount").val();
        for(i=1;i<=qCount;i++){
        $("#qst_name"+i+"").attr("readonly","readonly");
        }
        document.getElementById("btnDiv").style.display="none";
  };
  function Save () {
    var QtableVal=[];
    var qst_id = $("#qst_id").val();
    var qCount = $("#qCount").val();
        for(i=1;i<=qCount;i++){
          QtableVal.push($("#qst_name"+i+"").val());
        }
      var checkData = checkPageOneData(QtableVal,qCount);
      if(checkData == true){
        $.ajax({
        url: "./model/Update_questionnaire.php", 
        type:"POST",
        data: {
          QtableVal:QtableVal,
          qCount:qCount,
          qst_id:qst_id
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
  function checkPageOneData(QtableVal,qCount){
    var empty=false;
      for(i=0;i<qCount;i++){
        if(QtableVal[i]==""){
          empty=true;
        }
    }
    if(empty==true){
      return false;
    }
    else{
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
      <div style="font-size:22px;color:white;text-align:center;">題目詳情</div>
    </div>
  <!-- End Pageone header -->

  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:650px;background:white;">
	<div id='member-main-downcontent' class='member-main col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div id='' style="margin:0 auto;width:100%">
            <a style="float:right;" onclick="edit()" id="editBtn" name="editBtn" data-role="button"  data-mini="true" data-inline="true"  data-iconpos="right">編輯</a>
				      <?php echo $list ?>
              <?php echo $countDiv ?>
            </div><!-- 內框div -->
            <div id="btnDiv" style="display:none;">
              <a onclick="Cancel()" id="cancelBtn" name="cancelBtn" data-role="button"  data-mini="true" data-inline="true"  data-iconpos="left" >取消</a>
              <a onclick="Save()" id="submitBtn" name="submitBtn" data-role="button"  data-mini="true" data-inline="true"  data-iconpos="left">儲存</a>
            </div>
    </div><!-- member-main-downcontent -->
  </div><!-- END Pageone main -->
  <div data-role="footer" style="text-align:center;width:100%;height:60px;background:white;border:0px;">
     
  </div> 
</div>
<!--end pageone -->
</body>
</html>