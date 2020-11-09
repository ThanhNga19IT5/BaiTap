<?php
include_once("../_config.php");
foreach($_POST as $key => $value){
    $$key = htmlspecialchars(mysqli_real_escape_string($conn,$value));
}
$key_required = array("tentheloai","thutu","toogle");
foreach($key_required as $required){
    if(!isset($_POST[$required])){
        die("Thiếu dữ liệu!");
    }
}
if(($_FILES["icon"]["error"] == 0)){
    $ext = pathinfo($_FILES["icon"]["name"], PATHINFO_EXTENSION);
    $real_path = "\/image/".getdate()[0]."_cache_image.$ext";
    $full_path = "..$real_path";
    $icon=$_FILES['icon']['name'];
    $anhminhhoa_tmp=$_FILES['icon']['tmp_name'];
    move_uploaded_file($anhminhhoa_tmp,$full_path);
}
if(!isset($real_path)){
    $real_path = "null";
}
if(mysqli_query($conn,"INSERT INTO theloai (`ten`,`thutu`,`AnHien`,`icon`) VALUES ('$tentheloai','$thutu','$toogle','$real_path')")){
    echo "Thêm thàn công!";
    echo '<script>setTimeout(function(){window.location.href = "/bai7/admin/theloai_them.php"},3000);</script>';
}
else{
    echo "Lỗi: ".mysqli_error($conn);
}
?>