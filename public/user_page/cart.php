<?php
session_start();
require_once "../../database.php";
if(!empty($_SESSION["shopping_cart"]))
{
  foreach($_SESSION["shopping_cart"] as $keys => $meows)
  {
    $total = 5;
  $total = $total + ($meows["item_quantity"] * $meows["item_price"]);
  }
}
 ?>
 <?php require_once '../../views/partials/front_header.php'?>
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
              <div class="table-responsive mb-4">
                <table class="table">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Product</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Price</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Quantity</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Total</strong></th>
                      <th class="border-0" scope="col"> </th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php 
				  if(!empty($_SESSION["shopping_cart"]))
				  {
            $total = 0;
					  foreach($_SESSION["shopping_cart"] as $keys => $values)
					  {
				  ?>
                    <tr>
                      <th class="pl-0 border-0" scope="row">
                        <div class="media align-items-center"><a class="reset-anchor d-block animsition-link" href="detail.html"><img src="../<?php echo $values["item_image"]?>" alt="..." width="70"/></a>
                          <div class="media-body ml-3"><strong class="h6"><a class="reset-anchor animsition-link" href="detail.html"><?php echo $values["item_name"]; ?></a></strong></div>
                        </div>
                      </th>
                      <td class="align-middle border-0">
                        <p class="mb-0 small"><?php echo number_format($values["item_price"]); ?></p>
                      </td>
                      <td class="align-middle border-0">
                        <p class="mb-0 small"><?php echo $values["item_quantity"]; ?></p>
                      </td>
                      <td class="align-middle border-0">
                        <p class="mb-0 small"> <?php echo number_format($values["item_quantity"] * $values["item_price"]);?></p>
                      </td>
                      <td class="align-middle border-0"><a class="reset-anchor" href="cartsession.php?action=delete&id=<?php echo $values["item_id"]; ?>"><i class="fas fa-trash-alt small text-muted"></i></a></td>
                    </tr>
					<?php
          $total = $total + ($values["item_quantity"] * $values["item_price"]);
            }
					?>
          <?php $_SESSION["total"] = $total; ?>
                  </tbody>
                </table>
              </div>
              <!-- CART NAV-->
              <div class="bg-light px-4 py-3">
                <div class="row align-items-center text-center">
                  <div class="col-md-6 mb-3 mb-md-0 text-md-left"><a class="btn btn-link p-0 text-dark btn-sm" href="shop.html"><i class="fas fa-long-arrow-alt-left mr-2"> </i>Continue shopping</a></div>
                  <div class="col-md-6 text-md-right"><a class="btn btn-outline-dark btn-sm" href="cartsession.php?action=checkout">Procceed to checkout<i class="fas fa-long-arrow-alt-right ml-2"></i></a></div>
                </div>
              </div>
            </div>
            <!-- ORDER TOTAL-->
            <div class="col-lg-4" id="output">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Cart total</h5>
                  <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Subtotal</strong><span class="text-muted small">0</span></li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Shipping</strong><span class="text-muted small"><?php echo $_SESSION['shipping']; ?></span></li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between mb-4"><strong class="text-uppercase small font-weight-bold">Total</strong><span><?php echo $total; ?></span></li>
                    <li>
                      <form action="POST" id="form-po">
                        <div class="form-group mb-0">
                          <input  type="hidden" name="points" value="<?php echo $_SESSION['points'];?>">
                          <input class="btn btn-dark btn-sm btn-block" type="submit" id="pointing" value="Apply Coupon">
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
		  <?php } ?>
        </section>
      </div>
	  <?php require_once '../../views/partials/front_footer.php'?>