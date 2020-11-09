<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
</head>

<body>
    <?php
    include("../_config.php");

    if (isset($_GET["idTL"])) {
        $idTL = $_GET["idTL"];
        echo "SELECT * FROM theloai WHERE id = $idTL";
        $results = mysqli_query($conn, "SELECT * FROM theloai WHERE id = $idTL");
        if (mysqli_num_rows($results)) {
            $d = mysqli_fetch_array($results);
    ?>
            <form action="" method="post" enctype="multipart/form-data" name="form1">
                <table align="left" width="400">
                    <tr>
                        <td align="right">
                            Ten The Loai
                        </td>
                        <td>
                            <input type="text" name="tentheloai" value="<?php echo $d['ten']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            Thu Tu
                        </td>
                        <td>
                            <input type="text" name="thutu" value="<?php echo $d['thutu']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            An Hien
                        </td>
                        <td>
                            <select name="toogle">
                                <option value="An" <?php if ($d['AnHien'] == "An") echo "selected"; ?>>An</option>
                                <option value="Hien" <?php if ($d['AnHien'] == "Hien") echo "selected"; ?>>Hien</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">icon</td>
                        <td> <img src="..<?php echo $d['icon'] ?>" width="40" height="40" /></td>

                    </tr>
                    <tr>
                        <td align="right">&nbsp;</td>
                        <td> <input type="file" name="icon" id="image" /> </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <input type="hidden" name="id" value="<?php echo $d['id']; ?>" />
                            <input type="submit" name="Sua" value="Sua" />
                        </td>
                        <td>
                            <input type="reset" name="Huy" value="Huy" />
                        </td>
                    </tr>
                </table>
            </form>
    <?php
            include("../connect.php");
            if(isset($_POST["Sua"])){
            foreach ($_POST as $key => $value) {
                $$key = htmlspecialchars(mysqli_real_escape_string($conn, $value));
            }
            $key_required = array("tentheloai", "thutu", "toogle");
            foreach ($key_required as $required) {
                if (!isset($_POST[$required])) {
                    die("Thiếu dữ liệu!");
                }
            }
            // upload hinh anh
            if (($_FILES["icon"]["error"] == 0)) {
                $ext = pathinfo($_FILES["icon"]["name"], PATHINFO_EXTENSION);
                $real_path = "\/image/" . getdate()[0] . "_cache_image.$ext";
                $full_path = "..$real_path";
                $anhminhhoa_tmp = $_FILES['icon']['tmp_name'];
                move_uploaded_file($anhminhhoa_tmp, $full_path);
                unlink(".." . $d["icon"]);
            }
            if (!isset($real_path)) {
                $real_path = "null";
            }
            if (mysqli_query($conn, "UPDATE theloai SET `ten` = '$tentheloai', `thutu` = '$thutu', `AnHien` = '$toogle',`icon` = '$real_path'")) {
                echo "<script language='javascript'>alert('sua thanh cong');";
                echo "location.href='theloai.php';</script>";
            } else {
                echo "Lỗi: " . mysqli_error($conn);
            }
        }
        } else {
            echo "No record";
        }
    }
    ?>

</body>

</html>