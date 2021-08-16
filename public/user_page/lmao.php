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
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require_once '../../views/partials/user_header.php'; ?>
<!-----------full-slider----------------------------->
<ul id="adaptive" class="cs-hidden">
        
    <!--box-1---------------------------->
    <li class="item-a">
        <!---box------------------->
        <!--
<div class="full-slider-box f-slide-1">
    
    <div class="f-slider-text-container">
    <div class="f-slider-text">
        <span>Limited Offer</span>
        <strong>30% Off<br/> With <font>Promo Code</font></strong>
        <a href="#" class="f-slider-btn">Shop Now</a>
    </div>
    </div>

</div>
</li>
-->
 <!--box-2--------------------------->
    <li class="item-b">
        <!---box------------------->
<div class="full-slider-box f-slide-1" style="background-image: url('../images/lmao2.jpg');">
    
    <div class="f-slider-text-container">
    <div class="f-slider-text">
        <span>Limited Offer</span>
        <strong><br/><font>30% Off</font></strong>
        <a href="#" class="f-slider-btn">Shop Now</a>
    </div>
    </div>

</div>
</li>
     <!--box-3--------------------------->
     <li class="item-c">
        <!---box------------------->
<div class="full-slider-box f-slide-1">
    
    <div class="f-slider-text-container">
    <div class="f-slider-text">
        <span>Limited Offer</span>
        <strong>30% Off<br/> With <font>Promo Code</font></strong>
        <a href="#" class="f-slider-btn">Shop Now</a>
    </div>
    </div>

</div>
</li>
 
</ul>
<!--product-categories-slider---------------------->
<div class="arrival-heading">
    <strong>Categories</strong>
    <p></p>
</div>
<ul id="autoWidth" class="container" class="cs-hidden">
    <!--box-1--------------------->
    <!--
    <li class="item">
        <div class="feature-box">
            <a href="#">
                <img src="images/kek.jpg">
            </a>
        </div>
        <span>brand</span>
    </li>
-->
  </ul>
   <!--NEW ARRIVAL-------------------------------->
   <section class="new-arrival">
            
    <!--heading-------->
    <div class="arrival-heading">
        <strong>New Arrival</strong>
        <p>new products</p>
    </div>
      <!--products----------------------->
      <div class="product-container">
      <?php foreach($products as $product) { ?>
        <!--product-box-1---------->
          <div class="product-box">
              <!--product-img------------>
              <div class="product-img">
                  <!--add-cart---->
                  <a href="#" class="add-cart">
                      <i class="fas fa-shopping-cart"></i>
                    </a>
                  <!--img------>
                  <?php if ($product['image']): ?>
                   <a href="/public/user_page/detail.php?id=<?php echo $product['kek'] ?>" > <img src="../<?php echo $product['image'] ?>" alt="<?php echo $product['title'] ?>" class="product-img">
                <?php endif; ?>
              </div>
              <!--product-details-------->
              <div class="product-details">
                  <a href="#" class="p-name"><?php echo $product['title']; ?></a>
                  <span class="p-price"><?php echo $product['price']; ?></span>
              </div>
          </div>
         <?php } ?>
      </div>
  </section>

 <script type="text/javascript">
   /*-----For Search Bar-----------------------------*/
   $(document).on('click','.search',function(){
        $('.search-bar').addClass('search-bar-active')
    });
 
    $(document).on('click','.search-cancel',function(){
        $('.search-bar').removeClass('search-bar-active')
    });
                  /*----Full Page Slider---------------*/
 
                  $(document).ready(function() {
    $('#adaptive').lightSlider({
        adaptiveHeight:true,
        item:1,
        slideMargin:0,
        loop:true
    });
});
      /*--For-Product-SLider----------------*/
      $(document).ready(function() {
    $('#autoWidth').lightSlider({
        autoWidth:true,
        loop:true,
        onSliderLoad: function() {
            $('#autoWidth').removeClass('cS-hidden');
        } 
    });  
  });
  
    </script>
</body>
</html>