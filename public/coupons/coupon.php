<?php

require_once '../../database.php';

$statement = $pdo->prepare("SELECT * FROM coupon");
$statement->execute();
$coupons = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require_once "../../views/partials/admin_header.php" ?>
<body>
<div class="wrapper">
<!-- create brand -->
<p>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CreateBrand">
  Create Coupon
</button>
</p>
<h2> Brands </h2>
		<table class="content-table">
            <thead>
              <tr>
                <th>#</th>
                <th>coupon</th>
                <th>discount</th>
                <th>action</th>
              </tr>
            </thead>
    <tbody>
    <?php foreach($coupons as $k => $br) { ?>
    <tr>
    <td><?php $k = $k +1; echo $k; ?></td>
    <td><?php echo $br['title']; ?></td>
    <td><?php echo $br['discount'] ?></td>
    <td>
    <!-- edit brand -->
    <!--<a href = "brand_edit.php?id=<?php echo $br['id'] ?>" class="btn btn-outline-primary">Edit</a>-->
    <!-- delete brand -->
    <form method="post" action="coupon_delete.php" style="display: inline-block">
            <input  type="hidden" name="id" value="<?php echo $br['id'] ?>"/>
            <button type="submit" class="btn btn btn-outline-danger">Delete</button>
    </form>
    </td>
    </tr>
    <?php } ?>
    </tbody>
</table>
</div>
<?php require_once "../../views/products/coupon_form.php" ?>
<?php require_once "../../views/partials/admin_footer.php" ?>