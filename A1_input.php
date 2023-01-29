<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<link href="./design/test.css" rel="stylesheet">
<title>サンプル</title>
</head>

<body>
<form method="POST" action = "A2_register.php">
<h1>家計簿</h1>
<p class = "text">  サンプルです．</p>

<div class = "inputbox">
    <u><h2>データ入力</h2></u>
    <div class = "text">

        <label for = "enterday" >日付</label><br>
        <input type="date" name="enterday" id = "enterday" value="<?php echo date('Y-m-d'); ?>" style="font-size:16px; width:165px; height:22px;">
        <br>

        <label for = "product" >商品</label><br>
        <select name="product" id = "product" style="font-size:16px; width:170px; height:22px;">
        <option value="昼食">昼食</option>
        <option value="夕食">夕食</option>
        <option value="スーパー">スーパー</option>
        <option value="投資">投資</option>
        <option value="日用品">日用品</option>
        <option value="固定費">固定費</option>
        <option value="おしゃれ">おしゃれ</option>
        <option value="交通費">交通費</option>
        <option value="勉強">勉強</option>
        </select>
        <br>

        <label for = "price" >値段</label><br>
        <input type="text" name="price" id = "price">

    </div>
    <div class = "button">
        <input type = "submit" value = "登録"  style="font-size:30px; width:200px; height:60px;">
    </div>
    <a href="./A3_result.php" style="font-size:20px; float:right;">家計簿の表示はこちら</a><br>
</div>

<div class = "footer">
    <div class = "message">mail:sriki413213@yahoo.co.jp</div>
    <div class = "copyright">2022/copyright<br></div>
</form>


</body>
</html>
