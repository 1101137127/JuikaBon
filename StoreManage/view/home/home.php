
<?php 
  include ("../base/check.php");
?>
<!DOCTYPE html>
<html>
<head>
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

  <script>
     function back(){document.location.href="home.php";}  
  </script>
  <style>
    .home-main{
      border:1px solid;border-radius:30px;height:130px;opacity:0.5;text-align:center;
    }
    .home-main-content{
      font-size:18px;font-family:Helvetica Neue;color:black;margin-top:6px;
    }
    .menu{
      margin-left:-16.5px;
    }
    #down_menu{
      margin-left:2px;
    }
  </style>
</head>
<body >
<div data-role="page" id="pageone" >
   <!-- Pageone header -->
  <div data-role="header" style=" text-align:center;background: #0097A7;border:0px;height:80px;">
    <img src="logo.png" width="200px" height="80px">  
    <a href="../login/model/logout.php" target="_self" class="ui-btn-right ui-btn ui-icon-gear ui-btn-icon-left ui-shadow ui-corner-all" data-role="button" role="button">登出</a>
  </div>
  <!-- End Pageone header -->
  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:630px;background:white;width:100%;margin-top:-20px">
      <div id='' class='row'>
          <div id='' class='menu col-lg-12 col-md-12 col-sm-12 col-xs-12' style="height:70px">
          </div>
          <div id='down_menu' class='ui-grid-b menu col-lg-12 col-md-12 col-sm-12 col-xs-12'>
          
  		  <div id='' class=' ui-block-a home-main' >
  			 <a href="../member/member.php" data-ajax="false" target="_self">
            <div id='member' class='row' style="margin-top:10px;" >
              <img src="../../image/member_main.jpg" width="80px" height="80px">  
              <div id='' class='home-main-content col-xs-12' >會員管理</div>
            </div>
  			  </a>
        </div>
  		  
  		  <div id='' class='ui-block-b home-main  ' >
  		    <a href="../ticket/coupon.php" data-ajax="false">
            <div id='ticket' class='row' style="margin-top:10px;" >
                <img src="../../image/ticket_main.jpg" width="80px" height="80px">
                <div id='' class='home-main-content col-xs-12'>禮卷管理</div>
            </div>
  		    </a>
        </div>

        <div class='ui-block-c home-main ' >
          <a href="../message/message.php" data-ajax="false">
  			     <div id='message' class='row' style="margin-top:10px;">
                <img src="../../image/msg_main.jpg" width="80px" height="80px">   
                <div id='' class='home-main-content col-xs-12' >訊息推播</div>
  				  </div>
  			   </a>
        </div>
  		  
        <div id='' class='ui-block-a home-main ' >
    			<a href="../questionnaire/questionnaire.php" data-ajax="false">
    				<div id='love' class='row' style="margin-top:10px;" >
    						  <img src="../../image/question_main.jpg" width="80px" height="80px">   
    					  <div id='' class='home-main-content col-xs-12' >問卷管理</div>
    				</div>
    	     </a>
        </div>
		  
          <div id='' class='ui-block-b home-main' >
		        <a href="../gift/Gift.php" data-ajax="false">
              <div id='gift' class='row' style="margin-top:10px;" >
                    <img src="../../image/gift_main.jpg" width="80px" height="80px">    
                    <div id='' class='home-main-content col-xs-12' >禮品管理</div>
              </div>
		        </a>
          </div>
		  
  		  <div id='' class='ui-block-c home-main ' >
          <a href="../activity/activity.php" data-ajax="false">
    				<div id='circle' class='row' style="margin-top:10px;" >
               <img src="../../image/circle_icon.png" width="80px" height="80px"> 
    					<div id='' class='home-main-content col-xs-12' >活動管理</div>
    				</div>
          </a>
  		  </div>

		  <div id='' class='ui-block-a home-main ' >
  		  <a href="../Stores/Store.php" data-ajax="false">
              <div id='gift' class='row' style="margin-top:10px;" >
                        <img src="../../image/store_main.jpg" width="80px" height="80px">  
                    <div id='' class='home-main-content col-xs-12' >店家管理</div>
                </div>
  		  </a>
      </div>
      <div id='' class='ui-block-c home-main  ' >
        <a href="../../../../crm/index.php" data-ajax="false">
            <div id='custs' class='row' style="margin-top:10px;" >
                    <img src="../../image/mem_icon.png" width="80px" height="80px"> 
                <div id='' class='home-main-content col-xs-12' >顧客關係管理</div>
            </div>
        </a>
      </div>

      <div id='' class='ui-block-b home-main  ' >
        <a href="../exchange/exchange.php" data-ajax="false">
            <div id='gift' class='row' style="margin-top:10px;" >
              <img src="../../image/qrCode.jpg" width="80px" height="80px"> 
            <div id='' class='home-main-content col-xs-12' >點數兌換</div>
        </a>
       </div>

		  
      
      
        
      </div>
      </div>

      </div>
  </div><!-- END Pageone main -->
  <div data-role="footer" style="text-align:center;width:100%;height:60px;background:white;border:0px;">
    
  </div> 
</div> <!--end pageone -->

</body>
</html>