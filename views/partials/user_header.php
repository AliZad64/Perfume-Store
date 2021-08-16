
<html>
<head>
<meta charset="utf-8">
<meta content="IE-edge" http-equiv="X-UA-Compatible">
<meta content="width=device-width, intial-scale=1.0" name="viewport">
<title>Shopping Website</title>
<!--fav-icon---------------->
<link rel= "stylesheet" type="text/css" href="../../css/style.css"/>
<link rel="shortcut icon" href="images/kek.jpg"/>
<link rel="stylesheet"  href="../../css/lightslider.css">

  <!--using FontAwesome--------------->
  <script crossorigin="anonymous" src="https://kit.fontawesome.com/c8e4d183c2.js"></script>
  <script src= "../../js/JQuery.js"></script>
  <script src="../../js/lightslider.js"></script>
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
             <!--lable---->
            <!-- <span class="sale-lable"></span> -->
         </li>
         <li><a href="#">Women</a></li>
     </ul>
     <!--right-menu----------->
     <div class="right-menu">
         <a href="javascript:void(0);" class="search">
             <i class="fas fa-search"></i>
         </a>
         <div class="dropdown">
            <button class="dropbtn"><?php if (isset($_SESSION["username"]))  echo htmlspecialchars($_SESSION["username"]); else echo 'guest';  ?></button>
            <div class="dropdown-content">
              <a href="../../logout.php">Log out</a> 
            </div>
          </div>
         <a href="cart.php">
             <i class="fas fa-shopping-cart">
                 <span class="num-cart-product">0</span>
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