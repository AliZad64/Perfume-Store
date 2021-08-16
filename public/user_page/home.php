<?php 
require_once "../../functions.php";
$pdo = require_once '../../database.php';
session_start();
 if (isset($_SESSION["check"])) {
     header("location: checkouts.php");
     exit;
 }
// Check if the user is logged in, if not then redirect him to login page
$keyword = $_GET['search'] ?? null;
$gen1 = "";
$bra1 = "";
if ($keyword) {
    $statement = $pdo->prepare("SELECT * , products.id as kek
       FROM products INNER JOIN
    brands ON brands.id = products.brand_id INNER JOIN 
    genders ON genders.id = products.gender_id WHERE title like :keyword ORDER BY date_time DESC");
    $statement->bindValue(":keyword", "%$keyword%");
} else {
    $statement = $pdo->prepare("SELECT * , products.id as kek FROM products LEFT JOIN
    brands ON brands.id= brand_id LEFT JOIN 
    genders ON genders.id = gender_id ORDER BY date_time DESC");
}
//bringing brands table
$statement2 = $pdo->prepare("SELECT brands.brands_title as 'tit',brands.id as 'bid' FROM brands");
$statement2->execute();
$brand = $statement2->fetchAll(PDO::FETCH_ASSOC);

//bringing genders table
$statement3 = $pdo->prepare("SELECT genders.id as 'gid', genders_title FROM genders");
$statement3->execute();
$gender = $statement3->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['brand_id']) || isset($_GET['gender_id'])) {
  $bra1 = $_GET['brand_id'];
  $gen1 = $_GET['gender_id'];
  if ($bra1 != ""  && $gen1 != ""){
    $statement = $pdo->prepare("SELECT * , products.id as kek FROM products LEFT JOIN
    brands ON brands.id= brand_id LEFT JOIN 
    genders ON genders.id = gender_id WHERE gender_id = :gendery AND brand_id = :brandy ORDER BY date_time DESC");
    $statement->bindValue(':gendery', $gen1);
    $statement->bindValue(':brandy', $bra1);
  }
  elseif ($bra1 == "" && $gen1 == ""){
    header('Location: home.php');
  }
  elseif($bra1=="")
  {
    $statement = $pdo->prepare("SELECT * , products.id as kek FROM products LEFT JOIN
    brands ON brands.id= brand_id LEFT JOIN 
    genders ON genders.id = gender_id WHERE gender_id = :gendery ORDER BY date_time DESC");
    $statement->bindValue(':gendery', $gen1);
  }
  elseif($gen1=="")
  {
  $statement = $pdo->prepare("SELECT * , products.id as kek FROM products LEFT JOIN
  brands ON brands.id= brand_id LEFT JOIN 
  genders ON genders.id = gender_id WHERE brand_id = :brandy ORDER BY date_time DESC");
  $statement->bindValue(':brandy', $bra1);
  }
}
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<?php  require_once "../../views/partials/front_header.php" ?>
      <div class="container">
        <!-- HERO SECTION-->
       <!-- <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Shop</h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section> -->
        <section class="py-5">
          <div class="container p-0">
            <div class="row">
              <!-- SHOP SIDEBAR-->
              <div class="col-lg-3 order-2 order-lg-1">
                <h5 class="text-uppercase mb-4">Categories</h5>
                <div class="py-2 px-4 bg-dark text-white mb-3"><strong class="small text-uppercase font-weight-bold">Genders</strong></div>
                <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                <li class="mb-2"><a class="reset-anchor" href="home.php?brand_id=">all</a></li>
                <?php foreach($gender as $gen) { ?>
                  <li class="mb-2"><a class="reset-anchor" href="home.php?brand_id=<?php echo $bra1 ?>&gender_id=<?php echo $gen['gid']?>"><?php echo $gen['genders_title'] ?></a></li>
                 <?php } ?>
                </ul>
                <div class="py-2 px-4 bg-dark text-white mb-3"><strong class="small text-uppercase font-weight-bold">Brands</strong></div>
                <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                <li class="mb-2"><a class="reset-anchor" href="home.php?brand_id=">all</a></li>
                <?php foreach($brand as $bra) { ?>
                  <li class="mb-2"><a class="reset-anchor" href="home.php?brand_id=<?php echo $bra['bid'] ?>&gender_id=<?php echo $gen1?>"><?php echo $bra['tit'] ?></a></li>
                 <?php } ?>
                </ul>
                <!--<div class="py-2 px-4 bg-light mb-3"><strong class="small text-uppercase font-weight-bold">Health &amp; Beauty</strong></div>
                <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                  <li class="mb-2"><a class="reset-anchor" href="#">Shavers</a></li>
                  <li class="mb-2"><a class="reset-anchor" href="#">bags</a></li>
                  <li class="mb-2"><a class="reset-anchor" href="#">Cosmetic</a></li>
                  <li class="mb-2"><a class="reset-anchor" href="#">Nail Art</a></li>
                  <li class="mb-2"><a class="reset-anchor" href="#">Skin Masks &amp; Peels</a></li>
                  <li class="mb-2"><a class="reset-anchor" href="#">Korean cosmetics</a></li>
                </ul>
                <div class="py-2 px-4 bg-light mb-3"><strong class="small text-uppercase font-weight-bold">Electronics</strong></div>
                <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal mb-5">
                  <li class="mb-2"><a class="reset-anchor" href="#">Electronics</a></li>
                  <li class="mb-2"><a class="reset-anchor" href="#">USB Flash drives</a></li>
                  <li class="mb-2"><a class="reset-anchor" href="#">Headphones</a></li>
                  <li class="mb-2"><a class="reset-anchor" href="#">Portable speakers</a></li>
                  <li class="mb-2"><a class="reset-anchor" href="#">Cell Phone bluetooth headsets</a></li>
                  <li class="mb-2"><a class="reset-anchor" href="#">Keyboards</a></li>
                </ul>
                <h6 class="text-uppercase mb-4">Price range</h6>
                <div class="price-range pt-4 mb-5">
                  <div id="range"></div>
                  <div class="row pt-2">
                    <div class="col-6"><strong class="small font-weight-bold text-uppercase">From</strong></div>
                    <div class="col-6 text-right"><strong class="small font-weight-bold text-uppercase">To</strong></div>
                  </div>
                </div>
                <h6 class="text-uppercase mb-3">Show only</h6>
                <div class="custom-control custom-checkbox mb-1">
                  <input class="custom-control-input" id="customCheck1" type="checkbox">
                  <label class="custom-control-label text-small" for="customCheck1">Returns Accepted</label>
                </div>
                <div class="custom-control custom-checkbox mb-1">
                  <input class="custom-control-input" id="customCheck2" type="checkbox">
                  <label class="custom-control-label text-small" for="customCheck2">Returns Accepted</label>
                </div>
                <div class="custom-control custom-checkbox mb-1">
                  <input class="custom-control-input" id="customCheck3" type="checkbox">
                  <label class="custom-control-label text-small" for="customCheck3">Completed Items</label>
                </div>
                <div class="custom-control custom-checkbox mb-1">
                  <input class="custom-control-input" id="customCheck4" type="checkbox">
                  <label class="custom-control-label text-small" for="customCheck4">Sold Items</label>
                </div>
                <div class="custom-control custom-checkbox mb-1">
                  <input class="custom-control-input" id="customCheck5" type="checkbox">
                  <label class="custom-control-label text-small" for="customCheck5">Deals &amp; Savings</label>
                </div>
                <div class="custom-control custom-checkbox mb-4">
                  <input class="custom-control-input" id="customCheck6" type="checkbox">
                  <label class="custom-control-label text-small" for="customCheck6">Authorized Seller</label>
                </div>
                <h6 class="text-uppercase mb-3">Buying format</h6>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" id="customRadio1" type="radio" name="customRadio">
                  <label class="custom-control-label text-small" for="customRadio1">All Listings</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" id="customRadio2" type="radio" name="customRadio">
                  <label class="custom-control-label text-small" for="customRadio2">Best Offer</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" id="customRadio3" type="radio" name="customRadio">
                  <label class="custom-control-label text-small" for="customRadio3">Auction</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" id="customRadio4" type="radio" name="customRadio">
                  <label class="custom-control-label text-small" for="customRadio4">Buy It Now</label>
                </div>-->
              </div>
              <!-- SHOP LISTING-->
              <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
                <div class="row mb-3 align-items-center">
                  <div class="col-lg-6 mb-2 mb-lg-0">
                  </div>
                  <div class="col-lg-6">
                    <ul class="list-inline d-flex align-items-center justify-content-lg-end mb-0">
                      <li class="list-inline-item"><input class="form-control" id="search" type="text"></li>
                      <li class="list-inline-item">
                      <form method="GET">
                        <select class="selectpicker ml-auto" name="sorting" data-width="200" data-style="bs-select-form-control" data-title="Default sorting">
                          <option value="default">Default sorting</option>
                          <option value="popularity">Popularity</option>
                          <option value="low-high">Price: Low to High</option>
                          <option value="high-low">Price: High to Low</option>
                        </select>
                      </li>
                    </ul>
                  </div>
                </div>
                </form>
                <div class="row" id="show-list">
                  <?php foreach($products as $product)
                  { ?>
                  <div class="col-lg-4 col-sm-6">
                    <div class="product text-center">
                      <div class="mb-3 position-relative">
                        <div class="badge text-white badge-info"><?php if ($product['sale']) { echo 'sale '.$product['discount'].'%'; }?></div><a class="d-block" href="../../public/user_page/detail.php?id=<?php echo $product['kek'] ?>"><img class="img-fluid w-100" src="../<?php echo $product['image'] ?>" alt="..."></a>
                        <div class="product-overlay">
                          <ul class="mb-0 list-inline">
                            <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="cart.html">Add to cart</a></li>
                          </ul>
                        </div>
                      </div>
                      <h6> <a class="reset-anchor" href="detail.html"> <?php echo $product['title']; ?></a></h6>
                      <?php if (!$product['sale']) {  ?>
                      <p class=" text-muted"><?php echo number_format($product['price']) ?> IQD</p>
                      <?php } else { ?>
                        <p class=" text-muted"><?php echo number_format($product['sale']) ?> IQD</p>
                      <?php } ?>
                    </div>
                  </div>
                  <?php } ?>
                </div>
                <!-- PAGINATION-->
                <!--<nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center justify-content-lg-end">
                    <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                  </ul>-->
                </nav>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php require_once '../../views/partials/front_footer.php' ?>