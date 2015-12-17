<?php
header("Content-Type:text/html; charset=utf-8");
  $qst_id = $_GET["qst_id"];
  $total_count = $_GET["total_count"];
  $msg = "";
	$msg .= '<input type="hidden"  id="qst_id" value="'.$row['qst_id'].'"  />';
  $show_count="";
  $show_count='<div><h4>目前填寫人數:'.$total_count.'人</h4></div>';
  

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
  .ui-table-columntoggle-btn {
    display: none !important;
}
  </style>
<script>
   $(document).ready(function () {
    getDetail($("#qst_id").val());
    });
   function test(){
    alert("TEST");
   }
    
  function getDetail (qst_id){
    $.ajax({
        url: "./model/getDetail.php", 
        type:"POST",
        data: {
          qst_id:qst_id
        },
        success: function(data){
          if(data =="Null"){
            alert("尚無人填寫此問卷");
            var link = "questionnaireDetail.php?qst_id="+qst_id;
            location.href = link;
          }
          else{
            document.getElementById("detail").tBodies[0].innerHTML = data;
            //document.getElementById("detail").append(data);
            //$('#detail').DataTable();
            //$("#detail").trigger("create");
            $("#detail").table("refresh");
          }
           
            },
            error:function(xhr, ajaxOptions, thrownError){ 
                      document.getElementById("detail").innerHTML = "error";
                   }

          });
  };
  
  
    </script>
</head>
<body >
<div data-role="page" id="pageone" >
   <!-- Pageone header -->
	<div data-role="header"  data-position="fixed"style=" background:#0097A7;border:0px;height:80px;">
    <div id='' class='' style="font-size:28px;color:white;text-align:center;">
      <a data-ajax="false" href="#" class="ui-btn-left ui-btn ui-icon-back ui-btn-icon-left ui-shadow ui-corner-all" data-rel="back" data-role="button" role="button">返回</a>
      <img src="../../image/logo.png" width="200px" height="80px">  
      <a data-ajax="false" href="../home/home.php" target="_self" class="ui-btn-right ui-btn ui-icon-home ui-btn-icon-left ui-shadow ui-corner-all" data-role="button" role="button">首頁</a>
    </div>
  </div>
    <div style="background:#001F33;border:0px;height:50px;">
      <br/>
      <div style="font-size:22px;color:white;text-align:center;">問卷填寫狀況</div>
    </div>
  <!-- End Pageone header -->

  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:650px;background:white;">
	<div id='member-main-downcontent' class='member-main col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div id='' style="margin:0 auto;width:100%">
              <input type="hidden"  id="qst_id" value=<?php  echo $qst_id ?>  />
              <table data-max="30" data-min="11" data-position="fixed" id="detail" data-role="table" data-mode="columntoggle" class="ui-responsive table-stroke" border="1">
                <thead data-position="fixed"><tr><th width=5%>填寫序號</th><th width=5%>會員編號</th><th width=15%>會員姓名</th><th width=15%>填寫日期</th></tr></thead>
                <tbody></tbody>
              </table>
              <?php echo $show_count ?>
            </div>
            </div>
            <!-- 內框div -->
  </div>
  </div><!-- member-main-downcontent -->
  </div><!-- END Pageone main -->
  <div data-role="footer"  data-position="fixed" style="text-align:center;width:100%;height:60px;background:white;border:0px;">

  </div> 
</div>
<!--end pageone -->
</body>
</html>