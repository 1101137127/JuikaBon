<?php
        header("Content-Type:text/html; charset=utf-8");
	include("../connectDBModel/db.php");
	$id=$_GET['id'];
	$cellphone = $_POST['cellphone'];
	$stmt = $conn->prepare("SELECT `gd_id`,`name`,`gift`.`gift_id`,`member`.`mem_id`,`cellphone`,`gift_name`,`giftdetail`.`Quantity` as giftdetailq,`gift`.`Quantity` as giftq,`red_point`  
							FROM `giftdetail`  
							JOIN `member` ON `member`.`mem_id` = `giftdetail`.`mem_id` 
							JOIN `gift` ON `gift`.`gift_id` = `giftdetail`.`gift_id` 
							WHERE `gd_id` = '".$id."'");
	$stmt->execute();
	$list.='';
	
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
	$list.='
			 <font face="微軟正黑體">
				<input type="hidden" id="gdid" name="gdid" value="'.$row['gd_id'].'">
				<input type="hidden" id="memid" name="memid" value="'.$row['mem_id'].'">
				<input type="hidden" id="giftid" name="giftid" value="'.$row['gift_id'].'">
				<input type="hidden" id="giftq" name="giftq" value="'.$row['giftq'].'">
				<input type="hidden" id="giftdetailq" name="giftdetailq" value="'.$row['giftdetailq'].'">
				<input type="hidden" id="redpoint" name="redpoint" value="'.$row['red_point'].'">
				<ul data-role="listview" data-inset="true">
				  <li data-icon="false"><b>兌換人:</b>'.$row['name'].'</li>
				  <li data-icon="false"><b>欲兌換禮品:</b>'.$row['gift_name'].'</li>
				  <li data-icon="false"><b>兌換數量:</b>'.$row['giftdetailq'].'</li>
				  <li data-icon="false"><b>剩餘數量:</b>'.$row['giftq'].'</li>
				  <li data-icon="false"><b>所需點數:</b>'.$row['red_point'].'</li>					  
				</ul>
			 </font>'; 
	}
	
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
  <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.core.min.js"></script>
  <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.calbox.min.js"></script>
  <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/i18n/jquery.mobile.datebox.i18n.zh-TW.utf8.js"></script>
  <script type="text/javascript">
     function back(){document.location.href="home.php";}  
	 
	 function gocancel() {
		 var del = confirm("是否確定取消?");
		 if(del==true){
			 $.ajax({
					url: "DoExchangeCancel.php",
					data: {
						   gdid: $("#gdid").val(), 
						   giftdetailq: $("#giftdetailq").val(),
						   giftq: $("#giftq").val(), 
						   redpoint: $("#redpoint").val(), 
						   memid: $("#memid").val(), 
						   giftid: $("#giftid").val()
					},
					type: "POST",
					dataType:'text',

					success: function(data){
						alert(data);
						location.herf="http://140.133.74.58/test/store/StoreManage/view/home/home.php" ;
					},

					 error:function(xhr, ajaxOptions, thrownError){ 
						alert("取消失敗");
						location.reload() ;
						console.log(xhr.status); 
						console.log(thrownError); 
					 }
			});
		 }
		else{
          return;
        }
		/*
		document.getElementById("Detail").method="post";
		document.getElementById("Detail").action="DoExchangeCancel.php";
		document.getElementById("Detail").submit();
		
		document.Detail.action='DoExchangeCancel.php';
		document.Detail.submit(); */
	 }
	 
	 function goexchange() {
		 var del = confirm("是否確定兌換?");
		 if(del==true){
			 $.ajax({
				 
					url: "DoGiftExchange.php",
					data: {
						   gdid: $("#gdid").val()
					},
					type: "POST",
					datatype:"text",//回傳的資料型態
					success: function(data){
						alert(data);
						location.herf="http://140.133.74.58/test/store/StoreManage/view/home/home.php" ;
					},
					error:function(xhr, ajaxOptions, thrownError){ 
						  alert("兌換失敗");
						  location.reload() ;
						  console.log(xhr.status); 
						  console.log(thrownError);
					}
			});
		}
        else{
          return;
        }
		
		/*
		document.getElementById("Detail").method="post";
		document.getElementById("Detail").action="DoGiftExchange.php";
		document.getElementById("Detail").submit();
		
		document.Detail.action='DoGiftExchange.php';
		document.Detail.submit(); */ 
	 }
	 
  </script>
  <style>
    .member-main{
      border:0px solid;
      width:100%;
      height:200px;
    }
    #member-main-personal{
       border-bottom:2px solid #000000;
       height:200px;
    }
    #member-data{
      background: url("../../image/me.jpg");
      background-size: 200px 190px;/*圖片大小*/
      background-repeat: no-repeat;/*圖片不重複*/
      border-radius:60px;/*圖片變圓*/
      background-position: center;/*置中圖片*/
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
</head>
<body>
<div data-role="page" id="pageone" >
   <!-- Pageone header -->
	<div data-role="header" style=" background:#0097A7;border:0px;height:80px;">
    <div id='' class='' style="font-size:28px;color:white;text-align:center;">
      <a href="#" class="ui-btn-left ui-btn ui-icon-back ui-btn-icon-left ui-shadow ui-corner-all" data-rel="back" data-role="button" role="button" data-ajax="false">返回</a>
      <img src="../../image/logo.png" width="200px" height="80px">  
      <a href="../home/home.php" target="_self" class="ui-btn-right ui-btn ui-icon-home ui-btn-icon-left ui-shadow ui-corner-all" data-role="button" role="button">首頁</a>
    </div>
  </div>
    <div style="background:#001F33;border:0px;height:50px;">
      <br/>
      <div style="font-size:22px;color:white;text-align:center;">禮品兌換</div>
    </div>
  <!-- End Pageone header -->

  <!-- Pageone main -->
  <div data-role="main" class="ui-content" id="content" style="margin:0 auto;height:650px;background:white;">
              <br/><br/>
  
		<?php echo $list; ?>
		
		<input type="button" class="ui-btn ui-btn-inline ui-btn-b" name="go" value="取消兌換" onclick="gocancel()"> 
		<input type="button" class="ui-btn ui-btn-inline ui-btn-b" name="gogo" value="確認兌換" onclick="goexchange()">
		
   

  </div><!-- END Pageone main -->
  <div data-role="footer" style="text-align:center;width:100%;height:60px;background:white;border:0px;">
     
  </div> 
</div>
<!--end pageone -->
</body>
</html>


