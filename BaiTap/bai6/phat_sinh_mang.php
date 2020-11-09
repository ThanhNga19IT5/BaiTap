<!DOCTYPE html>
<html>

<head>
    <title>Phát sinh mảng và tính toán</title>
    <meta charset="utf-8">
    <style>
        * {
            font-family: Tahoma;
        }

        table {
            width: 400px;
            margin: 100px auto;
        }

        table th {
            background: #66CCFF;
            padding: 10px;
            font-size: 18px;
        }
    </style>
</head>
<?php
$ket_qua = 0;
foreach ($_POST as $key => $value) {
    $$key = $value; //tự động khai báo biến theo POST key
}
$data = array(0);
$tong = 0;
$so_lan_xuat_hien = [];
if (isset($nhap_sl)) {
    for ($i = 0; $i < $nhap_sl; $i++) {
        $data[$i] = mt_rand(0, 20);
        $tong += $data[$i];
        for ($j = 0; $j < count($so_lan_xuat_hien); $j++) {
            if ($so_lan_xuat_hien[$j]["number"] == $data[$i]) {
                $so_lan_xuat_hien[$j]["times"] += 1;
                break;
            }
            if ($j == count($so_lan_xuat_hien) - 1)
                array_push($so_lan_xuat_hien, array("number" => $data[$i], "times" => 1));
        }
        if (count($so_lan_xuat_hien) == 0)
            array_push($so_lan_xuat_hien, array("number" => $data[$i], "times" => 1));
    }
} else $nhap_sl = 0;
?>

<body>
    <form method="POST" action="">
        <table>
            <thead>
                <tr>
                    <th colspan="2">NHẬP VÀ TÍNH TRÊN DÃY SỐ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nhập số lượng:</td>
                    <td><input type="text" name="nhap_sl" value="<?php echo $nhap_sl; ?>"></td>
                </tr>
                <tr>
                    <td>Tổng dãy số:</td>
                    <td><input type="text" disabled="disabled" value="<?php echo json_encode($data); ?>"></td>
                </tr>
                <tr>
                    <td>Tổng dãy số:</td>
                    <td><input type="text" name="ket_qua" disabled="disabled" value="<?php echo $tong ?>"></td>
                </tr>
                <tr>
                    <td>Min:</td>
                    <td><input type="text" name="ket_qua" disabled="disabled" value="<?php echo min($data) ?>"></td>
                </tr>
                <tr>
                    <td>Max:</td>
                    <td><input type="text" name="ket_qua" disabled="disabled" value="<?php echo max($data) ?>"></td>
                </tr>
                <tr>
                    <td>Số lần xuất hiện:</td>
                    <td><textarea disabled="disabled" rows="5"><?php echo json_encode($so_lan_xuat_hien); ?></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="btn_goi" value="Thực hiện"></td>
                </tr>
            </tbody>
        </table>
    </form>
</body>

</html>