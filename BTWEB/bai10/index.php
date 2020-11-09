<?php 
session_start();// khoi dong session
if(!isset($_SESSION['name']))
{
$_SESSION['name']="Ily1606";
$_SESSION['age']=19;
$_SESSION["times"] = 0;
}
$_SESSION["times"]++;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Session</title>
</head>

<body>
<?php
echo "Tên bạn là:". $_SESSION['name']."<br/>";
echo "Số tuổi của bạn:".$_SESSION['age']."<br/>";
echo "Số lần xem trang: ".$_SESSION["times"]."<br/>";;
?>
<a href="">Click here!</a>
<a href="detroy_session.php">Xóa session!</a>
</body>
</html>
