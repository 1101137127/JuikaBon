<!DOCTYPE html>
<html>
<head>
  <!-- Include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  <!-- Include jQuery Mobile stylesheets -->
  <link rel="stylesheet" href="../../jquery-mobile-css/jquery.mobile-1.4.5.min.css">
  <!-- Include the jQuery library -->
  <script src="../../jquery-mobile-js/jquery-2.1.4.min.js"></script>
  <!-- Include the jQuery Mobile library -->
  <script src="../../jquery-mobile-js/jquery.mobile-1.4.5.min.js"></script>
  <script src="./js/login.js"></script>
  
</head>
<body>

<div data-role="page" id="pageone" style=" background:#0099h7;">
  <div data-role="header" style=" text-align:center;background:#0097A7;border:0px;height:80px;">
    <img src="../../image/logo.png" width="200px" height="80px"> 
  </div>

  <div data-role="main" class="ui-content" id="main" style="width:90%;height:250px;text-align:center;margin:0 auto;">
          <div class="container" style="width:80%;text-align:center;margin:0 auto;">
          <form method="post" id='login_form'>
            <label for="usrnm" class="ui-hidden-accessible">帳號:</label>
            <input type="text" name="username" id="username" placeholder="帳號" data-clear-btn="true">
            <label for="pswd" class="ui-hidden-accessible">密碼:</label>
            <input type="password" name="password" id="password" placeholder="密碼" data-clear-btn="true">
            <button type="button"   onclick="LoginData.login()" style="width:110px;float:right">登入</button>
          </form>
          </div>
  </div>
</div>
<div data-role="page" id="pagetwo" style=" background:#CCEEFF;">
  <div data-role="header"  style=" background:#CCEEFF;">
  </div>
    <div data-role="main" class="ui-content" id="two" style="width:90%;height:300px;text-align:center;margin:0 auto;">
      </div>
</div>

<div data-role="page" id="pagethree" style=" background:#CCEEFF;">
<div data-role="header" style=" background:#CCEEFF;height:120px;">
  </div>
<div data-role="main" class="ui-content" id="three" style="width:90%;height:300px;text-align:center;margin:0 auto;">
        <div class="container" style="width:80%;text-align:center;margin:0 auto;">
          <label for="setuser" class="ui-hidden-accessible">cellphone:</label>
          <input type="text" name="user" id="setuser" placeholder="cellphone">
          <label for="passwd" class="ui-hidden-accessible">Password:</label>
          <input type="password" name="passwd" id="passwd" placeholder="Password">
          <label for="username" class="ui-hidden-accessible">Username:</label>
          <input type="text" name="username" id="username" placeholder="username">
          <label for="gender" class="ui-hidden-accessible">gender:</label>

        <a href="#pageone" data-transition="slide" data-direction="reverse" class="ui-btn ui-btn-inline ui-corner-all ">back</a>
          <input type="button" data-inline="true" value="Set ok" onclick="insert()">
        </div>
    </div>
</div>
</body>
</html>
