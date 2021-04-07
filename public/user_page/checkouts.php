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

    //for the order details table
    foreach($_SESSION["shopping_cart"] as $keys => $values)
    {
     // get the quantity
$id = $values["item_id"];
$statement2 = $pdo->prepare('SELECT quantity FROM products WHERE id = :id');
$statement2->bindValue(':id', $id);
$statement2->execute();
$quant = $statement2->fetch(PDO::FETCH_ASSOC);
$q = $quant['quantity'];
    //send that to cart that belogns to that user so the admin can view what he ordered 
        $statement = $pdo->prepare("INSERT INTO cart (usersid , productid , productquantity) 
        VALUES (:user, :product , :quantity) ");
        $statement->bindValue(':user' , $user);
        $statement->bindValue(':product' , $values["item_id"]);
        $statement->bindValue(':quantity' , $values["item_quantity"]);
        $statement->execute();
        unset($_SESSION["shopping_cart"][$keys]);

        // sub the quantity from the original product value
        $q = $q - $values["item_quantity"];
            $statement3 = $pdo->prepare('UPDATE products SET quantity = :quantity WHERE id = :id');
            $statement3->bindValue(':id', $id);
            $statement3->bindValue(':quantity' , $q);
            $statement3->execute();
    }
    header('location: home.php');
    }
}
    
 ?>
<html>
<head>
</head>
<body>
<span class="d-block p-2 bg-dark text-white">total price: <?php echo $total;  ?></span>
<form class="needs-validation" method="POST" novalidate >
<input type="hidden" name="totalPrice" value = "<?php echo $total ?>">
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationTooltip03">City</label>
      <input type="text" class="form-control" id="validationTooltip03" placeholder="City" name = "city" required>
      <div class="invalid-tooltip">
        Please provide a valid city.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationTooltip04">Address</label>
      <input type="text" class="form-control" id="validationTooltip04" placeholder="Address" name = "address" required>
      <div class="invalid-tooltip">
        Please provide a valid Address.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationTooltip04">Address</label>
      <input type="text" class="form-control" id="validationTooltip04" placeholder="phone" name = "phone" required>
      <div class="invalid-tooltip">
        Please provide phone number.
      </div>
    </div>
  </div>
  <button class="btn btn-primary" type="submit">Submit form</button>
</form>
</body>
</html>