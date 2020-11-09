<?php
include("../_config.php");
if(isset($_GET["idTL"]))
{
	$id=$_GET["idTL"];

}
if(mysqli_query($conn,"DELETE FROM theloai WHERE id= $id"))
{
	echo "<script language='javascript'>alert('Xoa thanh cong');";
		echo "location.href='theloai.php';</script>";
}
else{
    die("Lỗi: ".mysqli_error($conn));
}
