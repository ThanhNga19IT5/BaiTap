<?php ob_start();
require_once("_config.php");
$idPA=$_GET["idPA"];
$qr1="update binhchon set SoLanChon = SoLanChon+1 where idBC=1";
$qr="update phuongan set SoLanChon = SoLanChon+1 where idBC=1 and idPA=$idPA";

if(mysqli_query($conn,$qr1) && mysqli_query($conn,$qr))
header('location:ketquabinhchon.php');
else echo "That bai!";
?>
