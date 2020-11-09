<html>

<head>
    <title></title>
</head>

<body>
    <form action="theloai_them_xl.php" method="POST" enctype="multipart/form-data" >
        <div>
            <label for="tentheloai">Tên thể loại</label>
            <input type="text" name="tentheloai" id="tentheloai">
        </div>
        <div>
            <label for="thutu">Thứ tự</label>
            <input type="text" name="thutu" id="thutu">
        </div>
        <div>
            <label for="toogle">An hien</label>
            <select name="toogle" id="toogle">
                <option value="An">An</option>
                <option value="Hien">Hien</option>
            </select>
        </div>
        <div>
            <label for="icon">Icon</label>
            <input type="file" name="icon" id="icon">
        </div>
        <input type="submit" value="Them" />
    </form>
</body>

</html>