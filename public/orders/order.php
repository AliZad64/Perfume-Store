<?php 
require_once "../../functions.php";
$pdo = require_once '../../database.php';

$statement = $pdo->prepare("SELECT * , orders.id as orid FROM orders LEFT JOIN users ON users.id = user_id ");
$statement->execute();
$orders = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement2 = $pdo->prepare("SELECT * FROM cart INNER JOIN products ON cart.productid = products.id INNER JOIN orders WHERE cart.order_id = orders.id");
$statement2->execute();
$carts = $statement2->fetchAll(PDO::FETCH_ASSOC);

//INNER JOIN orders
//ON orders.id = order_id INNER JOIN users 
//ON users.id = usersid INNER JOIN products 
//ON products.id = productid
?>


<?php require_once '../../views/partials/admin_header.php'; ?>
<div class="wrapper">
<h1>orders</h1>
<table class="content-table">
    <thead>
    <tr>
        <th scope="col">Order No.</th>
        <th scope="col">Name</th>
        <th scope="col">City</th>
        <th scope="col">Address</th>
        <th scope="col">Total Price</th>
        <th scope="col">Phone number</th>
        <th scope="col">Action</th>
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
            <td>
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#UpdateBrand<?php echo $order['orid'] ?>">
            view </button>
            <form method="post" action="order_delete.php" style="display: inline-block">
            <input  type="hidden" name="id" value="<?php echo $order['orid'] ?>"/>
            <button type="submit" class="btn btn btn-outline-danger">Complete</button>
    </form>
    </td>
        </tr>
    <?php include '../../views/products/order_form.php' ?>
    <?php } ?>
    </tbody>
</table>

<?php require_once '../../views/partials/admin_footer.php' ?>