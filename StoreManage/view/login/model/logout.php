<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
session_start();
//將session清空
unset($_SESSION['store_id']);
unset($_SESSION['store_phone']);
unset($_SESSION['store_name']);
echo '登出中......';
echo '<meta http-equiv=REFRESH CONTENT=1;url=../login_home.php>';
?>