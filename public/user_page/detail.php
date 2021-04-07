<?php
session_start();
require_once "../../functions.php";
$pdo = require_once '../../database.php';
// Check if the user is logged in, if not then redirect him to login page
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: home.php');
    exit;
}
$counter = 0;
$statement = $pdo->prepare('SELECT * FROM products WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tutorial</title>
    <link rel="stylesheet"  href="../../css/lightslider.css">
    <link rel= "stylesheet" type="text/css" href="../../css/style.css"/>
    <!--using FontAwesome--------------->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/c8e4d183c2.js"></script>
    <script src= "../../js/JQuery.js"></script>
    <script src="../../js/lightslider.js"></script>
    <!-- CSS -->
    <link href="../../css/styleinfo.css" rel="stylesheet">
    <meta name="robots" content="noindex,follow" />
    <!--style----->
	<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    
		body{
			font-family:poppins;
		}
	</style>

  </head>

  <body>
    <nav> 
      <!--menu-bar----------------------------------------->
      <div class="navigation">
          <!--logo------------>
          <a href="#" class="logo">Perfume Store</a>
          <!--menu-icon------------->
          <div class="toggle"></div>
          <!--menu----------------->
          <ul class="menu">
              <li><a href="#">Home</a></li>
              <li  class="shop"><a href="#" >Shop</a></li>
              <li><a href="#">Men</a>
                  <!--lable
                  <span class="sale-lable">Sale</span> -->
              </li>
              <li><a href="#">Women</a></li>
          </ul>
          <!--right-menu----------->
          <div class="right-menu">
              <a href="javascript:void(0);" class="search">
                  <i class="fas fa-search"></i>
              </a>
              <div class="dropdown">
                 <button class="dropbtn">Admin</button>
                 <div class="dropdown-content">
                   <a href="#">Log out</a>
                 </div>
               </div>
              <a href="cart.php">
                  <i class="fas fa-shopping-cart">
                      <span class="num-cart-product"><?php if(isset($_SESSION["shopping_cart"])){
                        foreach ($_SESSION["shopping_cart"] as $countotal)
                        {
                          $counter = $counter++;
                        }
                          echo $counter;
                      }
                      else 
                      {
                          echo "0";
                      }
                          

                      ?>
                    </span>
                  </i>
              </a>
          </div>
          </div>
      </nav>
      <!--search-bar----------------------------------->
      <div class="search-bar">
         
         <!--search-input------->
         <div class="search-input">
         <input type="text" placeholder="Search For Product" name="search" />
         <!--cancel-btn--->
         <a href="javascript:void(0);" class="search-cancel">
             <i class="fas fa-times"></i>
         </a>
     
     </div>
     </div>
     <!-- THE FORM -->
     <form method="POST" action="/public/user_page/cartsession.php?id=<?php echo $product['id'] ?>">
    <main class="container">
      <!-- Left Column / Headphones Image -->
      <div class="left-column">
        <img data-image="black" src="images/black.png" alt="">
        <img data-image="blue" src="images/blue.png" alt="">
        <img data-image="red" class="active" src="../<?php echo $product['image'] ?>" alt="ass">
      </div>


      <!-- Right Column -->
      <div class="right-column">

        <!-- Product Description -->
        <div class="product-description">
          <h1><?php echo $product['title'] ?></h1>
          <p><?php echo $product['description']?> </p>
        </div>

        <!-- Product Configuration -->
        <div class="product-configuration">

          <!-- Product Color -->
          <div class="product-color">

          </div>

          <!-- Cable Configuration -->
          <input type="text" name="quantity" value="1" class="form-control" />

<input type="hidden" name="hidden_name" value="<?php echo $product["title"]; ?>" />

<input type="hidden" name="hidden_price" value="<?php echo $product["price"]; ?>" />

        <!-- Product Pricing -->
        <div class="product-price">
          <span>IQD <?php echo $product['price'] ?></span>
          <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
        </div>
      </div>
    </main>
     </form>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
    <script src="script.js" charset="utf-8"></script>
  </body>
</html>