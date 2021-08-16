<?php 
require_once "../../functions.php";
$pdo = require_once '../../database.php';
if(isset($_POST['query'])){
$stmnt = $pdo->prepare("SELECT * , products.id as kek FROM products LEFT JOIN
brands ON brands.id= brand_id LEFT JOIN 
genders ON genders.id = gender_id WHERE products.title LIKE '%".$_POST['query']."%'");
$stmnt->execute();
$result = $stmnt->fetchAll();
}
else {
    $stmnt = $pdo->prepare("SELECT * , products.id as kek FROM products LEFT JOIN
brands ON brands.id= brand_id LEFT JOIN 
genders ON genders.id = gender_id ORDER BY date_time DESC");
$stmnt->execute();
$result = $stmnt->fetchAll();
}
if ($result) {
    foreach ($result as $product) {
      echo '<div class="col-lg-4 col-sm-6">
      <div class="product text-center">
        <div class="mb-3 position-relative">
          <div class="badge text-white badge-"></div><a class="d-block" href="../../public/user_page/detail.php?id='.$product['kek'].'"><img class="img-fluid w-100" src="../'.$product['image'].'" alt="..."></a>
          <div class="product-overlay">
            <ul class="mb-0 list-inline">
              <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="cart.html">Add to cart</a></li>
            </ul>
          </div>
        </div>
        <h6> <a class="reset-anchor" href="detail.html">'.  $product['title'] .'</a></h6>
        <p class="small text-muted">'. $product['price']. '</p>
      </div>
    </div>';
    }
  } else {
    echo '<p class="list-group-item border-1">No Record</p>';
  }
?>
