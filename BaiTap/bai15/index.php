<?php
include("_config.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>BÌNH CHỌN</p>
    <div id="binhchon">
        <form id="form1" name="form1" method="get" action="xulybinhchon.php">
            Bạn nghĩ sao về chất lượng của trang web ute.udn.vn
            <p>
                <?php   
                $kq = mysqli_query($conn, "select * from phuongan where idBC=1");
                $i = 0;
                while ($row = mysqli_fetch_array($kq)) {
                ?>
                    <label>
                        <input id="radio" type="radio" value="<?php echo $row['idPA']; ?>" name="idPA" <?php if ($i == 0) {
                                                                                                            echo " checked='checked' ";
                                                                                                            $i++;
                                                                                                        } ?> />
                    </label>
                    <?php echo $row['Mota']; ?><br /><?php } ?></p>
            <p>
                <label>
                    <input id="button" type="submit" value="Xem kết quả" name="Submit" />
                </label>
            </p>
        </form>
    </div>


</body>

</html>