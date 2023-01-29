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

<u><h2>日付別の家計簿</h2></u>

<table class = "table" style="font-size:20px" >
<thead>
<tr>
    <th>日付</th><th>値段</th>
</tr>
</thead>
<tbody>
<?php
try{
    $db = getDb();
    $stt = $db->prepare('SELECT enterday,SUM(price)  FROM accountbook where enterday>=:first_date AND enterday<=:last_date
    GROUP BY enterday ');
    $first_date = date('Y-m-01');
    $last_date = date('Y-m-t');

    $stt->bindValue(':first_date', $first_date, PDO::PARAM_STR);
    $stt->bindValue(':last_date', $last_date, PDO::PARAM_STR);
    $stt->execute();
    while($row = $stt->fetch(PDO::FETCH_ASSOC)){
?>
    <tr>
        <td><?=e($row['enterday']) ?></td>
        <td><?=e($row['SUM(price)']) ?>円</td>
    </tr>
<?php
    }
?>
</tbody>
</table>

<br>

<u><h2>商品別の家計簿</h2></u>

<table class = "table2" style="font-size:20px" >
<thead>
<tr>
    <th>年月</th><th>商品名</th><th>値段</th>
</tr>
</thead>
<tbody>

<?php
    $stt = $db->prepare('SELECT entermonth,product,SUM(price) FROM accountbook where enterday>=:first_date 
    AND enterday<=:last_date GROUP BY product ORDER BY SUM(price)');
    $stt->bindValue(':first_date', $first_date, PDO::PARAM_STR);
    $stt->bindValue(':last_date', $last_date, PDO::PARAM_STR);
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

<u><h2>今月の合計</h2></u>
    
    <table class = "table3" style="font-size:20px" >
    <thead>
    <tr>
        <th>年月</th><th>合計の値段</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $stt = $db->prepare('SELECT entermonth,SUM(price) FROM accountbook where enterday>=:first_date 
        AND enterday<=:last_date');
        $stt->bindValue(':first_date', $first_date, PDO::PARAM_STR);
        $stt->bindValue(':last_date', $last_date, PDO::PARAM_STR);
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

    <div class = "message">mail:sriki413213@yahoo.co.jp</div>
    <div class = "copyright">2022/copyright<br></div>

</div>
</body>
</html>

