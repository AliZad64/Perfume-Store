<?php 
require_once ('../../database.php');

//checks for id
$id = $_POST['id'] ?? null;
if(!$id){
    header('Location: coupon.php');
    exit;
}

$statement = $pdo->prepare('DELETE FROM coupon WHERE id  = :id');
$statement->bindValue(':id', $id);
$statement->execute();

//get back to  brand file
header("Location: coupon.php");

?>