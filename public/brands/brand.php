<?php

require_once '../../database.php';

$statement = $pdo->prepare("SELECT * FROM brands");
$statement->execute();
$brand = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require_once "../../views/partials/admin_header.php" ?>
<body>
<div class="wrapper">
<!-- create brand -->
<p>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CreateBrand">
  Create Brand
</button>
</p>
<h2> Brands </h2>
		<table class="content-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Brand</th>
                <th>Action</th>
              </tr>
            </thead>
    <tbody>
    <?php foreach($brand as $k => $br) { ?>
    <tr>
    <td><?php $k = $k +1; echo $k; ?></td>
    <td><?php echo $br['brands_title']; ?></td>
    <td>
    <!-- edit brand -->
    <!--<a href = "brand_edit.php?id=<?php echo $br['id'] ?>" class="btn btn-outline-primary">Edit</a>-->
    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#UpdateBrand<?php echo $br['id'] ?>">
    Edit
    </button>
    <!-- delete brand -->
    <form method="post" action="brand_delete.php" style="display: inline-block">
            <input  type="hidden" name="id" value="<?php echo $br['id'] ?>"/>
            <button type="submit" class="btn btn btn-outline-danger">Delete</button>
    </form>
    </td>
    </tr>
    <?php include "../../views/products/brand_update_form.php" ?>
    <?php } ?>
    </tbody>
</table>
</div>
<?php require_once "../../views/products/brand_form.php" ?>
<?php require_once "../../views/partials/admin_footer.php" ?>