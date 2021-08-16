<?php 
session_start();
require_once "../../functions.php";
$pdo = require_once '../../database.php';
if (isset($_POST['coupon1']))
{
    $coupon1 = $_POST['coupon1'];
    $oldTotal = $_POST['total'];
    $statement = $pdo->prepare("SELECT * FROM coupon");
    $statement->execute();
    $coupons = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($coupons as $coupon)
    {
        if ($coupon['title'] == $coupon1)
        {
            $couponPrice = $coupon['discount'];
            $newTotal = $oldTotal - ($oldTotal * ($couponPrice / 100));
        }
    }
    if (isset($newTotal))
    {
         $_SESSION["total"] = $newTotal;
        echo '<div class="card border-0 rounded-0 p-lg-4 bg-light">
        <div class="card-body">
          <h5 class="text-uppercase mb-4">Cart total</h5>
          <ul class="list-unstyled mb-0">
            <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Subtotal</strong><span class="text-muted small">'.$couponPrice.'</span></li>
            <li class="border-bottom my-2"></li>
            <li class="d-flex align-items-center justify-content-between mb-4"><strong class="text-uppercase small font-weight-bold">Total</strong><span>'. $_SESSION["total"] .'</span></li>
            <li>
              <form action="POST" id="form-co">
                <div class="form-group mb-0">
                  <input class="form-control" type="text" name="coupon1" placeholder="Enter your coupon">
                  <input class="btn btn-dark btn-sm btn-block" type="submit" id="coupon" value="Apply Coupon">
                </div>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>';
    }
    else
    {
        echo '<p> nothing </p>';
    }
}