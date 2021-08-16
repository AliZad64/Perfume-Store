<?php
session_start();
require_once "../../database.php";
//so we can move freely after login
$errors = [];
if (isset($_SESSION["check"])){
unset($_SESSION["check"]);
}
//so we don't need to write total session
$total = $_SESSION["total"];
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $city = $_POST['city'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $total = $_SESSION["total"];
    $user = $_SESSION["id"];
    if (!$city) {
        $errors[] = 'please enter the city';
    }
    if (!$address) {
        $errors[] = 'please enter the address';
    }
    if (!$phone) {
        $errors[] = 'please enter the phone number';
    }
    if (empty($errors)){
        //for the order table
    $statement = $pdo->prepare("INSERT INTO orders (user_id , city , address , total , phone) 
    VALUES (:user , :city , :address , :total , :phone) ");
    $statement->bindValue(':user' , $user);
    $statement->bindValue(':city' , $city);
    $statement->bindValue(':address' , $address);
    $statement->bindValue(':total' , $total);
    $statement->bindValue(':phone' , $phone);
    $statement->execute();

    //get the orders id 
    $statement4 = $pdo->prepare("SELECT orders.id as 'orid' FROM orders ORDER BY orders.id DESC LIMIT 1");
    $statement4->execute();
    $please = $statement4->fetch(PDO::FETCH_ASSOC);
    $answer = $please['orid'];
    //for the order details table
    foreach($_SESSION["shopping_cart"] as $keys => $values)
    {
     // get the quantity
$id = $values["item_id"];
$statement2 = $pdo->prepare('SELECT quantity, sold FROM products WHERE id = :id');
$statement2->bindValue(':id', $id);
$statement2->execute();
$quant = $statement2->fetch(PDO::FETCH_ASSOC);
$q = $quant['quantity'];
$s = $quant['sold'];
    //send that to cart that belogns to that user so the admin can view what he ordered 
        $statement = $pdo->prepare("INSERT INTO cart (usersid , productid , productquantity , order_id) 
        VALUES (:user, :product , :quantity , :order1) ");
        $statement->bindValue(':user' , $user);
        $statement->bindValue(':product' , $values["item_id"]);
        $statement->bindValue(':quantity' , $values["item_quantity"]);
        $statement->bindValue(':order1', $answer);
        $statement->execute();
        unset($_SESSION["shopping_cart"][$keys]);

        // sub the quantity from the original product value
        $q = $q - $values["item_quantity"];
        $s = $s + $values['item_quantity'];
            $statement3 = $pdo->prepare('UPDATE products SET quantity = :quantity , sold = :sold WHERE id = :id');
            $statement3->bindValue(':id', $id);
            $statement3->bindValue(':quantity' , $q);
            $statement3->bindValue(':sold' , $s);
            $statement3->execute();
    }
    header('location: Thanks.php');
    }
}
    
 ?>
<?php require_once '../../views/partials/front_header.php' ?>
<div class="container">
        <!-- HERO SECTION-->
        <!--<section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Cart</h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>-->
        <section class="py-5">
          <h2 class="h5 text-uppercase mb-4">Shopping cart</h2>
          <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">
              <!-- CART TABLE-->
              <form method="POST">
              <fieldset>
                <div class="form-group">
                  <label for="exampleInputEmail">City</label>
                  <input class="form-control" id="exampleInputEmail" name="city" type="text" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Address</label>
                  <input class="form-control" id="exampleInputPassword" name="address" type="text" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Phone Number</label>
                  <input class="form-control" id="exampleInputPassword" name="phone" type="text" placeholder="Password">
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
              </fieldset>
            </form>
            </div>
            <!-- ORDER TOTAL-->
            <div class="col-lg-4" id="output">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Cart total</h5>
                  <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Subtotal</strong><span class="text-muted small">0</span></li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Subtotal</strong><span class="text-muted small">0</span></li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between mb-4"><strong class="text-uppercase small font-weight-bold">Total</strong><span><?php echo $_SESSION['total']; ?></span></li>
                    <li>
                      <form action="POST" id="form-co">
                        <div class="form-group mb-0">
                          <input class="form-control" type="text" name="coupon1" placeholder="Enter your coupon">
                          <input  type="hidden" name="total" value="<?php echo $_SESSION['total'] ?>">
                          <input class="btn btn-dark btn-sm btn-block" type="submit" id="coupon" value="Apply Coupon">
                        </div>
                      </form>
                    </li>
                    <li class="border-bottom my-2"></li>
                    <li>
                      <form action="POST" id="form-co">
                        <div class="form-group mb-0">
                          <input class="form-control" type="text" name="coupon1" placeholder="Enter your coupon">
                          <input  type="hidden" name="total" value="<?php echo $total ?>">
                          <input class="btn btn-dark btn-sm btn-block" type="submit" id="coupon" value="Apply Coupon">
                        </div>
                      </form>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
           </div>
        </section>
      </div>
	  <?php require_once '../../views/partials/front_footer.php'?>