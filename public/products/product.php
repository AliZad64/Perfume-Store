<?php

require_once "../../functions.php";
$pdo = require_once '../../database.php';

$keyword = $_GET['search'] ?? null;

if ($keyword) {
    $statement = $pdo->prepare("SELECT * , products.id as kek
       FROM products LEFT JOIN
    brands ON brands.id = products.brand_id LEFT JOIN 
    genders ON genders.id = products.gender_id WHERE title like :keyword ORDER BY date_time DESC");
    $statement->bindValue(":keyword", "%$keyword%");
} else {
    $statement = $pdo->prepare("SELECT * , products.id as kek FROM products LEFT JOIN
    brands ON brands.id= brand_id LEFT JOIN 
    genders ON genders.id = gender_id ORDER BY date_time DESC");
}
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);


?>

<?php require_once '../../views/partials/admin_header.php'; ?>
<h1>Products CRUD</h1>

<p>
    <a href="/public/products/create.php" type="button" class="btn btn-sm btn-success">Add Product</a>
</p>
<form action="" method="get">
    <div class="input-group mb-3">
      <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo $keyword ?>">
      <div class="input-group-append">
        <button class="btn btn-success" type="submit">Search</button>
      </div>
    </div>
</form>
<table class="table">
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
    <?php foreach ($products as $i => $product) { ?>
        <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td>
                <?php if ($product['image']): ?>
                    <img src="../<?php echo $product['image'] ?>" alt="<?php echo $product['title'] ?>" class="product-img">
                <?php endif; ?>
            </td>
            <td><?php echo $product['title'] ?></td>
            <td><?php echo number_format($product['price']); ?></td>
            <td><?php echo $product['quantity'] ?></td>
            <td><?php if (empty($product['brand_id']))
            { echo 'none';}  
            else {echo $product['brands_title']; } ?></td>
            <td><?php echo $product['genders_title'] ?></td>
            <td><?php echo $product['date_time'] ?></td>
            <td>
                <a href="/public/products/update.php?id=<?php echo $product['kek'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                <form method="post" action="/public/products/delete.php" style="display: inline-block">
                    <input  type="hidden" name="id" value="<?php echo $product['kek'] ?>"/>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>