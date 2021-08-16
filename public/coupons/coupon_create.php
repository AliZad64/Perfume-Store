<?php
require_once '../../database.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
$discount = $_POST['discount'];

if (!$discount) {
    $errors[] = 'please enter the title';
}
$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$res = "";
for ($i = 0; $i < 10; $i++) {
    $res .= $chars[mt_rand(0, strlen($chars)-1)];
}
if (empty($errors)){
$statement = $pdo->prepare("INSERT INTO coupon (title , discount) VALUES (:title , :discount) ");
$statement->bindValue(':title' , $res);
$statement->bindValue(':discount' , $discount);
$statement->execute();
header('location: coupon.php');
}
}

?>