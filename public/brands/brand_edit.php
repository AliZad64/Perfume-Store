<?php
require_once '../../database.php';
// check id
$id = $_POST['id'] ?? null;
if(!$id){
    echo "hiiii";
    exit;
}
// for showing old records
$statement = $pdo->prepare("SELECT * FROM brands WHERE id = :id");
$statement->bindValue(':id', $id);
$statement->execute();
$brand = $statement->fetch(PDO::FETCH_ASSOC);

$title = $brand['brands_title'];
//create new record from here
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
$title = $_POST['title'];

if (!$title) {
    $errors[] = 'please enter the title';
}
if (empty($errors)){
$statement = $pdo->prepare("UPDATE brands SET brands_title = :title WHERE id = :id ");
$statement->bindValue(':title' , $title);
$statement->bindValue(':id', $id);
$statement->execute();
header('location: brand.php');
}
}

?>

<?php require_once "../../views/partials/admin_header.php" ?>

<?php if (!empty($errors)) { ?>
<div class="alert alert-danger">
    <?php foreach($errors as $error) { ?>
        <div><?php echo $error ?></div>
    <?php } ?>
</div>
<?php } ?>

<form action="" method="get">
    <div class="input-group mb-3">
      <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo $keyword ?>">
      <div class="input-group-append">
        <button class="btn btn-success" type="submit">Search</button>
      </div>
    </div>
</form>
<h2>Create new Brand </h2>
<form method="post" action="">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Brand name</label>
    <input type="text" class="form-control" name = "title" value="<?php echo $brand['brands_title'] ?> ">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php require_once "../../views/partials/admin_footer.php" ?>