<?php
session_start();
require_once "../../database.php";

 ?>
<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					//check session
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>$ <?php echo $values["item_price"]; ?></td>
						<td>$ <?php echo $values["item_quantity"] * $values["item_price"];?></td>
						<td><a href="cartsession.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
						$_SESSION["total"] = $total;
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">$ <?php echo $total; ?></td>
						<td></td>
					</tr>
					<a href="cartsession.php?action=checkout"> checkout </a> <br>
					<?php
					}
                    else 
                    {
                        echo "its empty";
                    }
					?>
					 <a href = "cartsession.php?action=deleteall" ><span class="text-danger">Remove all</span></a>
				</table>
			</div>