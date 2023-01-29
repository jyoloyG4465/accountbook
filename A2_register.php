<?php
require_once '../DbManager.php';


try {
  $db = getDb();
  $stt = $db->prepare('INSERT INTO accountbook(enterday,entermonth, product, price) VALUES(:enterday,:entermonth, :product, :price)');
  $stt->bindValue(':enterday', $_POST['enterday']);
  $stt->bindValue(':entermonth', date('Y-m',strtotime($_POST['enterday'])));
  $stt->bindValue(':product', $_POST['product']);
  $stt->bindValue(':price', $_POST['price']);

  $stt->execute();
  header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/A3_result.php');
} catch(PDOException $e) {
  die("エラーメッセージ：{$e->getMessage()}");
}
?>
