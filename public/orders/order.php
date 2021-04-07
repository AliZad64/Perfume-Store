<?php 
require_once "../../functions.php";
$pdo = require_once '../../database.php';

$statement = $pdo->prepare("SELECT * FROM orders INNER JOIN users ON users.id = user_id ");
$statement->execute();
$orders = $statement->fetchAll(PDO::FETCH_ASSOC);


?>


<?php require_once '../../views/partials/admin_header.php'; ?>
<h1>orders</h1>

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
        <th scope="col">Name</th>
        <th scope="col">City</th>
        <th scope="col">Address</th>
        <th scope="col">Total Price</th>
        <th scope="col">Phone number</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($orders as $i => $order) { ?>
        <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><?php echo $order['username'] ?></td>
            <td><?php echo $order['city']; ?></td>
            <td><?php echo $order['address'] ?></td>
            <td><?php echo $order['total'] ?></td>
            <td><?php echo $order['phone'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>