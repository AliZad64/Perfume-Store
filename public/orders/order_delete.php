<?php 
require_once ('../../database.php');

//checks for id
$id = $_POST['id'] ?? null;
if(!$id){
    header('Location: order.php');
    exit;
}

$statement = $pdo->prepare('DELETE FROM orders WHERE id  = :id');
$statement->bindValue(':id', $id);
$statement->execute();

//get back to  brand file
header("Location: order.php");

?>