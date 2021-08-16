<?php
//works once we enter the page
//_files
//enctype multipart/formdata
require_once "../../functions.php";
$pdo = require_once '../../database.php';

$statement2 = $pdo->prepare("SELECT brands.brands_title as 'tit',brands.id as 'bid' FROM brands");
$statement2->execute();
$brand = $statement2->fetchAll(PDO::FETCH_ASSOC);

$statement3 = $pdo->prepare("SELECT genders.id as 'gid', genders_title FROM genders");
$statement3->execute();
$gender = $statement3->fetchAll(PDO::FETCH_ASSOC);

$errors = [];

$title = '';
$description = '';
$price = '';
$product = [
    'image' => ''
];
$quantity = '';
$brando = '';
$gendero = '';
$gen1 = '';
$bra1 = '';
$discount = '';
$sale = '';
// this works when we press submit in the form html
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once '../../validate_product.php';

    if (empty($errors)) {
        $statement = $pdo->prepare("INSERT INTO products (title, image, description, price, quantity, 
        gender_id , brand_id, date_time, discount , sale)
                VALUES (:title, :image, :description, :price, :quantity , :gender_id , :brand_id, :date , :discount , :sale)");
        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', $imagePath);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':quantity', $quantity);
        $statement->bindValue(':gender_id', $gendero);
        $statement->bindValue(':brand_id', $brando);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));
        $statement->bindValue(':discount', $discount);
        $statement->bindValue(':sale', $sale);

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
<h1>Create new Product</h1>

<?php require_once '../../views/products/form.php' ?>
<?php require_once '../../views/partials/admin_footer.php'?>
</body>
</html>