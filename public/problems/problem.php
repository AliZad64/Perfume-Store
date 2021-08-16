<?php

require_once "../../functions.php";
$pdo = require_once '../../database.php';

$keyword = $_GET['search'] ?? null;

if ($keyword) {
    $statement = $pdo->prepare("SELECT * , products.id as kek
       FROM products INNER JOIN
    brands ON brands.id = products.brand_id INNER JOIN 
    genders ON genders.id = products.gender_id WHERE title like :keyword ORDER BY date_time DESC");
    $statement->bindValue(":keyword", "%$keyword%");
} else {
    $statement = $pdo->prepare("SELECT * , products.id as kek FROM products INNER JOIN
    brands ON brands.id= brand_id INNER JOIN 
    genders ON genders.id = gender_id ORDER BY date_time DESC");
}
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);
$product_counter = 0;
$des_counter = 0;
?>

<?php require_once '../../views/partials/admin_header.php'; ?>
<div class="wrapper">
<?php foreach($products as $product) {  
    if ($product['quantity'] <= 3) { $product_counter = $product_counter + 1;}
    if ($product['description'] == '') {$des_counter = $des_counter + 1;}
}
    ?>

    <!-- check quantity-->
    <?php if($product_counter > 0) { ?>
        <h1>out of quantity</h1>
        <table class="content-table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">Title</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Brand</th>
        <th scope="col">Gender</th>
        <th scope="col">Create Date</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <?php foreach ($products as $i => $product) {
        if($product['quantity'] <=3) { ?>
        <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td>
                <?php if ($product['image']): ?>
                    <img src="../<?php echo $product['image'] ?>" alt="<?php echo $product['title'] ?>" class="img-fluid" style="width: 150px;">
                <?php endif; ?>
            </td>
            <td><?php echo $product['title'] ?></td>
            <td><?php echo number_format($product['price']); ?></td>
            <td><?php echo $product['quantity'] ?></td>
            <td><?php echo $product['brands_title'] ?></td>
            <td><?php echo $product['genders_title'] ?></td>
            <td><?php echo $product['date_time'] ?></td>
            <td>
                <a href="/public/problems/problem_update.php?id=<?php echo $product['kek'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                <form method="post" action="/public/products/delete.php" style="display: inline-block">
                    <input  type="hidden" name="id" value="<?php echo $product['kek'] ?>"/>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php } } ?>
</table>
    <?php } ?>

   <!-- check description -->
    <?php if($des_counter > 0) { ?>
        <h1>no description</h1>
        <table class="content-table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">Title</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Brand</th>
        <th scope="col">Gender</th>
        <th scope="col">Create Date</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
        <tbody>
    <?php foreach ($products as $i => $product) {
        if($product['description'] == '') { ?>
        <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td>
                <?php if ($product['image']): ?>
                    <img src="../<?php echo $product['image'] ?>" alt="<?php echo $product['title'] ?>" class="product-img" style="width: 150px">
                <?php endif; ?>
            </td>
            <td><?php echo $product['title'] ?></td>
            <td><?php echo number_format($product['price']); ?></td>
            <td><?php echo $product['quantity'] ?></td>
            <td><?php echo $product['brands_title'] ?></td>
            <td><?php echo $product['genders_title'] ?></td>
            <td><?php echo $product['date_time'] ?></td>
            <td>
                <a href="/public/problems/problem_update.php?id=<?php echo $product['kek'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                <form method="post" action="/public/problems/delete.php" style="display: inline-block">
                    <input  type="hidden" name="id" value="<?php echo $product['kek'] ?>"/>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php } } ?>
    </tbody>
</table>
    <?php } ?>
<?php require_once "../../views/partials/admin_footer.php" ?>