<?php 
require_once ('../../database.php');

//checks for id
$id = $_POST['id'] ?? null;
if(!$id){
    header('Location: brand.php');
    exit;
}

$statement = $pdo->prepare('DELETE FROM brands WHERE id  = :id');
$statement->bindValue(':id', $id);
$statement->execute();

//get back to  brand file
header("Location: brand.php");

?>