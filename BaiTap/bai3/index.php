<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Xuất số thành chữ</title>
</head>

<body>
    <?php
    $text = "";
    if (isset($_POST["so"])) {
        if (is_numeric($_POST["so"])) {
            $array = ["Không", "Một", "Hai", "Ba", "Bốn", "Năm", "Sáu", "Bảy", "Tám", "Chín"];
            $so = $_POST["so"];
            if ($so >= count($array)) {
                $text = "Không hợp lệ";
            } else {
                $text = $array[$so];
                if (!$text)
                    $text = "Không hợp lệ";
            }
        }
    }
    ?>
    <form action="" method="POST">
        <table width="519" border="1">
            <tr>
                <td colspan="3">Đọc số</td>
            </tr>
            <tr>
                <td>Nhập số (0-9)</td>
                <td width="69" rowspan="2"><input type="submit" name="button" id="button" value="Submit" /></td>
                <td> Bằng chữ</td>
            </tr>
            <tr>
                <td width="177">
                    <p>
                        <label for="textfield"></label>
                        <input type="text" name="so" id="textfield" />
                    </p>
                </td>
                <td width="232"><label for="textfield2"></label>
                    <input type="text" name="chu" id="textfield2" value="<?php echo $text; ?> " /></td>
            </tr>
        </table>
    </form>
</body>

</html>