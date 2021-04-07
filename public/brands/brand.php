<?php

require_once '../../database.php';

$statement = $pdo->prepare("SELECT * FROM brands");
$statement->execute();
$brand = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require_once "../../views/partials/admin_header.php" ?>
<body>

<h1>brands</h1>

<!-- create brand -->
<p>
    <a href="public/brands/brand_create.php" type="button" class="btn btn-sm btn-success">Add Product</a>
</p>
<form action="" method="get">
    <div class="input-group mb-3">
      <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo $keyword ?>">
      <div class="input-group-append">
        <button class="btn btn-success" type="submit">Search</button>
      </div>
    </div>
</form>
<h2> Brands </h2>
<table  class="table table-bordered table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($brand as $k => $br) { ?>
    <tr>
    <td><?php $k = $k +1; echo $k; ?></td>
    <td><?php echo $br['brands_title']; ?></td>
    <td>
    <!-- edit brand -->
    <a href = "brand_edit.php?id=<?php echo $br['id'] ?>" class="btn btn-outline-primary">Edit</a>
    <!-- delete brand -->
    <form method="post" action="brand_delete.php" style="display: inline-block">
            <input  type="hidden" name="id" value="<?php echo $br['id'] ?>"/>
            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
    </form>
    </td>
    </tr>
    <?php } ?>
    </tbody>
</table>

<?php require_once "../../views/partials/admin_footer.php" ?>