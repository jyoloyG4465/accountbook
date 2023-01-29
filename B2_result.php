<?php
require_once '../DbManager.php';
require_once '../Encode.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset = "UTF-8">
<title>家計簿の表示</title>
<!--link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />-->
<link rel="stylesheet" href="./design/test.css">
</head>
<body>

<h1>今月の内容</h1>
<a href="A1_input.php" style="font-size:20px; float:right;">入力画面はこちら</a><br><br>

<table class = "table" style="font-size:20px" >
<thead>
<tr><th>年月</th><th>商品名</th><th>値段</th></tr>
</thead>

<tbody>
<?php
try{
    $db = getDb();
    $stt = $db->prepare('SELECT entermonth,product,SUM(price)  FROM accountbook where entermonth=:entermonth
    GROUP BY product ORDER BY SUM(price)' );
    $entermonth = $_POST['entermonth'];

    if (strpos($entermonth,'/') !== false){
        $entermonth = str_replace('/', '-', $entermonth);
    }

    $stt->bindValue(':entermonth', $entermonth, PDO::PARAM_STR);
    $stt->execute();
    while($row = $stt->fetch(PDO::FETCH_ASSOC)){
?>
    <tr>
        <td><?=e($row['entermonth']) ?></td>
        <td><?=e($row['product']) ?></td>
        <td><?=e($row['SUM(price)']) ?>円</td>
    </tr>
    <?php
    }
?>
</tbody>
</table>
<br>

<table class = "table2" style="font-size:20px" >
<thead>
<tr>
    <th>年月</th><th>値段</th>
</tr>
</thead>
<tbody>
<?php
    $stt = $db->prepare('SELECT entermonth,SUM(price) FROM accountbook where entermonth=:entermonth');
    $stt->bindValue(':entermonth', $entermonth, PDO::PARAM_STR);
    $stt->execute();
    while($row = $stt->fetch(PDO::FETCH_ASSOC)){
?>
    <tr>        
        <td><?=e($row['entermonth']) ?></td>
        <td><?=e($row['SUM(price)']) ?>円</td>
    </tr>
    <?php
    }

}catch(PDOException $e){
    die("エラーメッセージ：{$e->getmessage()}");
}
?>

</tbody>
</table>

<div class = "footer">

    <div class = "message">mail:xxxxxxxxxxxxxxx@yahoo.co.jp</div>
    <div class = "copyright">2022/copyright<br></div>

</div>

</body>
</html>