<?php
include("_config.php");
function getRatingInfo($id)
{
    global $conn;
    $query = "SELECT * FROM rating_info WHERE product_id=" . $id;
    $result = mysqli_query($conn, $query);
    $return =  'Đánh giá<br /><ul id="rating-info">';
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $return .= "<li><strong>5</strong>: " . $row['rate_5'] . "</li>";
        $return .= "<li><strong>4</strong>: " . $row['rate_4'] . "</li>";
        $return .= "<li><strong>3</strong>: " . $row['rate_3'] . "</li>";
        $return .= "<li><strong>2</strong>: " . $row['rate_2'] . "</li>";
        $return .= "<li><strong>1</strong>: " . $row['rate_1'] . "</li>";
    } else {
        for ($i = 1; $i < 6; $i++) {
            $return .= "<li>" . $i . ": 0%</li>";
        }
    }
    $return .= "</ul>";

    return $return;
}
function setRatingInfo($id, $rate)
{
    global $conn;
    $query = "SELECT rate_" . $rate . " FROM rating_info WHERE product_id=" . $id;
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $i = $row['rate_' . $rate];
    $i++;
    $query = "UPDATE rating_info SET rate_" . $rate . "=" . $i . " WHERE product_id=" . $id;
    $result = mysqli_query($conn, $query);
}
function getProduct($id)
{
    global $conn;
    $query = "SELECT * FROM products WHERE id=" . $id;
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    $rating_info = getRatingInfo($id);
    $return = '<div id="product-img">
					<img src="' . $row['img_url'] . '" alt="" title="" />
				</div>' . $rating_info . '
				<div class="clear-fx"></div>
				<h2>' . $row['title'] . '</h2>';

    return $return;
}
function listProduct()
{
    global $conn;
    $query = "SELECT * FROM products";
    $result = mysqli_query($conn, $query);

    $return = "";
    while ($row = mysqli_fetch_array($result)) {
        $rating_info = getRatingInfo($row['id']);
        $return .= '<div class="product-info">
				<div id="product-img">
					<img src="' . $row['img_url'] . '" alt="" title="" />
				</div>' . $rating_info . '
				<div class="clear-fx"></div>
				<h2><a href="index.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h2></div>';
    }

    return $return;
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // UPDATE RATING
    if (isset($_POST['rate_submit'])) {
        if (isset($_POST['rate'])) {
            $rate = $_POST['rate'];
            setRatingInfo($id, $rate);
        }
    }

    $html = getProduct($id);
} else {
    $html = listProduct();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Rating</title>
    <meta charset="utf-8">
</head>

<body>
    <div id="container">
        <header>
            <h1><a href="index.php">COMPUTER ABC</a></h1>
        </header>

        <div id="main-wrapper">
            <div id="product-info">
                <?php echo $html ?>
            </div>
            <?php
            if (isset($_GET['id'])) {
            ?>
                <div id="rating">
                    <form action="" method="POST">
                        <h3>Đánh giá</h3>
                        <input type="radio" name="rate" value="5" checked> 5
                        <input type="radio" name="rate" value="4"> 4
                        <input type="radio" name="rate" value="3"> 3
                        <input type="radio" name="rate" value="2"> 2
                        <input type="radio" name="rate" value="1"> 1<br />
                        <input type="submit" name="rate_submit" value="Rate" id="submit-button">
                    </form>
                </div>
            <?php } ?>
        </div>

        <footer>
        </footer>
    </div>
</body>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        background: #ecf0f1;
    }

    a:link,
    a:visited {
        color: #2980b9;
        text-decoration: none;
    }

    a:hover,
    a:active {
        text-decoration: underline;
        color: #e74c3c;
    }

    #container {
        width: 400px;
        margin: 20px auto;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #7f8c8d;
        background: #fff;
    }

    #product-img {
        float: left;
        width: 70%;
    }

    #rating-info {
        float: left;
        width: 30%;
        padding: 0;
        list-style-type: none;
    }

    .clear-fx {
        clear: both;
    }

    .product-info {
        border-bottom: 1px solid #bdc3c7;
        margin-bottom: 10px;
    }

    #submit-button {
        padding: 5px 20px;
        margin-top: 10px;
    }

    h1 {
        background: #3498db;
        padding: 10px 0;
    }

    h1 a:link,
    h1 a:visited {
        color: #fff;
    }
</style>

</html>