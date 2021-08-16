<?php

require_once "../../functions.php";
$pdo = require_once '../../database.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: product.php');
    exit;
}
// brings the products table 
$statement = $pdo->prepare('SELECT * FROM products WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);

//brings the brands table
$statement2 = $pdo->prepare("SELECT brands.brands_title as 'tit',brands.id as 'bid' FROM brands");
$statement2->execute();
$brand = $statement2->fetchAll(PDO::FETCH_ASSOC);

//brings the genders table
$statement3 = $pdo->prepare("SELECT genders.id as 'gid', genders_title FROM genders");
$statement3->execute();
$gender = $statement3->fetchAll(PDO::FETCH_ASSOC);

$title = $product['title'];
$description = $product['description'];
$price = $product['price'];
$quantity = $product['quantity'];
$gen1 = $product['gender_id'];
$bra1 = $product['brand_id'];
$discount = $product['discount'];
$sale = $product['sale'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    require_once '../../validate_product.php';

    if (empty($errors)) {
        $statement = $pdo->prepare("UPDATE products SET title = :title, 
                                        image = :image, 
                                        description = :description, 
                                        price = :price , brand_id = :brand,
                                         quantity = :quantity,
                                         gender_id = :gender,
                                         discount = :discount,
                                         sale = :sale
                                         WHERE id = :id");
        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', $imagePath);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':brand', $brando);
        $statement->bindValue(':quantity', $quantity);
        $statement->bindValue(':gender', $gendero);
        $statement->bindValue(':discount', $discount);
        $statement->bindValue(':sale', $sale);
        $statement->bindValue(':id', $id);

        $statement->execute();
        header('Location: product.php');
    }

}

?>
<?php require_once '../../views/partials/admin_header.php'; ?>
<div class="wrapper">
<p>
    <a href="product.php" class="btn btn-secondary">Back to products</a>
</p>
<h1>Update Product: <b><?php echo $product['title'] ?></b></h1>


<?php require_once '../../views/products/form.php' ?>
<?php require_once '../../views/partials/admin_footer.php'?>
</body>
</html>