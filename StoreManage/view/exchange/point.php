
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
<script type="text/javascript">

 function Save () {
      var cellphone = $("#Pageone").find("#cellphone").val();
      var total_money = $("#Pageone").find("#total_money").val();
      var coupon_detail_id = $("#Pageone").find("#coupon_detail_id").val();
      var reward_pt = $("#Pageone").find("#reward_pt").val();
      var checkData = checkPageOneData(cellphone,total_money,reward_pt);
      if(checkData == true){
        $.ajax({
        url: "./model/Insert_point.php", 
        type:"POST",
        data: {
          cellphone:cellphone,
          total_money:total_money,
          coupon_detail_id:coupon_detail_id,
          reward_pt:reward_pt
        },
        datatype:"text",//回傳的資料型態
        success: function(data){

           alert(data);
           location.reload();
            },
            error:function(xhr, ajaxOptions, thrownError){ 
                      console.log(xhr.status); 
                      console.log(thrownError);
                   }

          });
      }
      else{
        alert("有欄位未正確填寫，請確認！");
      }
      
    
  };
function checkPageOneData(cellphone,total_money,reward_pt){
      var Empety = false;
      if(cellphone ==""){
        Empety=true;
        document.getElementById("cellphone_errorMsg").style.display="block";
      }
      else if(cellphone!=""){
        document.getElementById("cellphone_errorMsg").style.display="none";
      }
      if(total_money ==""){
        Empety=true;
        document.getElementById("total_money_errorMsg").style.display="block";
      }
      else if(total_money!=""){
        document.getElementById("total_money_errorMsg").style.display="none";
      }
      if(reward_pt ==""){
        Empety=true;
        document.getElementById("reward_pt_errorMsg").style.display="block";
      }
      else if(reward_pt!=""){
        document.getElementById("reward_pt_errorMsg").style.display="none";
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
<div data-role="page" id="Pageone" >
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
      <div style="font-size:22px;color:white;text-align:center;">贈予點數</div>
    </div>
  <!-- End Pageone header -->

  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:650px;background:white;">
  <div id='member-main-downcontent' class='member-main col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div id='' style="margin:0 auto;width:100%">
            <form method="post" action="questionnaire_InsertQList.php">
                <div data-role="fieldcontain" >
                     <label class="Inputlabel" for="cellphone" >顧客電話</label>
                     <input type="text" name="cellphone" id="cellphone" value=""  />
                     <label id="cellphone_errorMsg" style="color:red;display:none;" >電話未填</label>
                </div>
                <div data-role="fieldcontain" >
                     <label class="Inputlabel" for="total_money" >請輸入金額</label>
                     <input type="number" name="total_money" id="total_money" value=""  />
                     <label id="total_money_errorMsg" style="color:red;display:none;" >金額未填</label>
                </div>
                <div data-role="fieldcontain" >
                     <label class="Inputlabel" for="coupon_detail_id" >請輸入禮卷編號</label>
                     <input type="number" name="coupon_detail_id" id="coupon_detail_id" value=""  />
                     <label id="total_money_errorMsg" style="color:red;">有使用禮卷需填寫</label>

                </div>
                <div data-role="fieldcontain" >
                     <label class="Inputlabel" for="reward_pt" >請輸入點數</label>
                     <input type="number" name="reward_pt" id="reward_pt" value=""  />
                     <label id="reward_pt_errorMsg" style="color:red;display:none;" >點數未填</label>
                </div>

                
                
                <a href="../home/home.php" data-ajax="false" data-role="button" data-mini="true" data-inline="true" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" class="ui-btn ui-shadow ui-btn-corner-all ui-btn-inline ui-btn-up-c">取消</a>
                <a onclick="Save()" id="submitBtn" name="submitBtn" data-ajax="false" data-role="button" data-mini="true" data-inline="true" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" class="ui-btn ui-shadow ui-btn-corner-all ui-btn-inline ui-btn-up-c">儲存</a>
            </form>
            </div><!-- 內框div -->
    <div>
    
    </div>
    </div><!-- member-main-downcontent --></div><!-- END Pageone main -->
  <div data-role="footer" style="text-align:center;width:100%;height:60px;background:white;border:0px;">
     
  </div> 
</div>
<!--end pageone -->
</body>
</html>