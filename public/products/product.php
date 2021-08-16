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

//bringing brands table
$statement2 = $pdo->prepare("SELECT brands.brands_title as 'tit',brands.id as 'bid' FROM brands");
$statement2->execute();
$brand = $statement2->fetchAll(PDO::FETCH_ASSOC);

//bringing genders table
$statement3 = $pdo->prepare("SELECT genders.id as 'gid', genders_title FROM genders");
$statement3->execute();
$gender = $statement3->fetchAll(PDO::FETCH_ASSOC);
//if you press "add product" to make new one
if(ISSET($_POST['update'])) {
   // brings the products table 
    require_once '../../validate_product.php';
     echo $title;
     echo $description;
     echo $price;
    echo $brando;
    echo $quantity;
    echo $gendero;
    echo $imagepath;
    exit;
    //check if image is there
    if (empty($errors)) {
        $statement5 = $pdo->prepare("UPDATE products SET title = :title, 
                                        image = :image, 
                                        description = :description, 
                                        price = :price , brand_id = :brand,
                                         quantity = :quantity,
                                         gender_id = :gender
                                         WHERE id = :id");
        $statement5->bindValue(':title', $title);
        $statement5->bindValue(':image', $imagePath);
        $statement5->bindValue(':description', $description);
        $statement5->bindValue(':price', $price);
        $statement5->bindValue(':brand', $brando);
        $statement5->bindValue(':quantity', $quantity);
        $statement5->bindValue(':gender', $gendero);
        $statement5->bindValue(':id', $id);

        $statement5->execute();
        header('Location: product.php');
    }

}
if(ISSET($_POST['create'])) {

    require_once '../../validate_product.php';

    if (empty($errors)) {
        $statement4 = $pdo->prepare("INSERT INTO products (title, image, description, price, quantity, 
        gender_id , brand_id, date_time)
                VALUES (:title, :image, :description, :price, :quantity , :gender_id , :brand_id, :date)");
        $statement4->bindValue(':title', $title);
        $statement4->bindValue(':image', $imagePath);
        $statement4->bindValue(':description', $description);
        $statement4->bindValue(':price', $price);
        $statement4->bindValue(':quantity', $quantity);
        $statement4->bindValue(':gender_id', $gendero);
        $statement4->bindValue(':brand_id', $brando);
        $statement4->bindValue(':date', date('Y-m-d H:i:s'));

        $statement4->execute();
        header('Location: product.php');
    }

}
?>

<?php require_once '../../views/partials/admin_header.php'; ?>
<div class="wrapper">
    <!-- edit Modal -->
<div class="modal fade" id="kek" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" enctype="multipart/form-data">
      <div class="modal-body">
  
    <form action="../../public/products/update.php" method="post" enctype="multipart/form-data">
      <div class="modal-body">
          <input type="hidden" name="id" id="update_id">
    <div class="form-group">
        <label>Product Image</label><br>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label>Product title</label>
        <input type="text" name="title" id="name" class="form-control">
    </div>
    <div class="form-group">
        <label>Product description</label>
        <textarea class="form-control" name="description"></textarea>
    </div>
    <div class="form-group">
        <label>Product price</label>
        <input type="number" step=".01" name="price" id="price" class="form-control" >
    </div>
    <div class="form-group">
        <label>Product quantity</label>
        <input type="number" step=".01" name="quantity" class="form-control" value="">
    </div>
    <!-- select brand -->
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>

<!--########################################################################3-->
<h1>Perfumes</h1>
<p>
    <a href="/public/products/create.php" type="button" class="btn btn-sm btn-success sogreen">Add Product</a>
<!-- Button trigger modal -->
<!--<form action="" method="get">
    <div class="input-group mb-3">
      <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo $keyword ?>">
      <div class="input-group-append">
        <button class="btn btn-success" type="submit">Search</button>
      </div>
    </div>
</form>-->
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
    <?php foreach ($products as $i => $product) { ?>
        <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td>
                <?php if ($product['image']): ?>
                    <img src="../<?php echo $product['image'] ?>" alt="<?php echo $product['title'] ?>" class="thumb-img">
                <?php endif; ?>
            </td>
            <td><?php echo $product['title'] ?></td>
            <td><span <?php if ($product['sale']){ echo 'style="text-decoration: line-through;"';}?>></span>
            <?php echo number_format($product['price']); ?>
                    if ($product['sale']) {
                        echo '<br>';
                        echo number_format($product['sale']);
                    } ?></td>
            <td><?php echo $product['quantity'] ?></td>
            <td><?php if (empty($product['brand_id']))
            { echo 'none';}  
            else {echo $product['brands_title']; $bra1 = $product['brand_id']; } ?></td>
            <td><?php echo $product['genders_title']; $gen1 = $product['gender_id'];?></td>
            <td><?php echo $product['date_time'] ?></td>
            <td>
            <!--<button class="btn btn-warning" data-toggle="modal" type="button" data-target="#update_modal<?php echo $product['kek']?>">edit </button>-->
                <a href="/public/products/update.php?id=<?php echo $product['kek'] ?>" class="btn btn-sm btn-outline-primary toogreen">Edit</a>
                <form method="post" action="/public/products/delete.php" style="display: inline-block">
                    <input  type="hidden" name="id" value="<?php echo $product['kek'] ?>"/>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
        <?php include '../../views/products/form_update.php'; ?>
    <?php } ?>
    </tbody>
</table>
<?php require_once '../../views/products/form_create.php'?>
<?php require_once '../../views/partials/admin_footer.php'?>