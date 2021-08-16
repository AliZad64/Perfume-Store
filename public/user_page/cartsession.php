<?php 
session_start();
require_once '../../database.php';

//check if there is cart
if(isset($_POST["add_to_cart"]))
{
$_SESSION['alert'] = true;
// get the quantity
$id = $_GET["id"];
$statement2 = $pdo->prepare('SELECT quantity FROM products WHERE id = :id');
$statement2->bindValue(':id', $id);
$statement2->execute();
$quant = $statement2->fetch(PDO::FETCH_ASSOC);
$q = $quant['quantity'];
//make session
	if(isset($_SESSION["shopping_cart"]))
	{
		$_SESSION["shipping"] = 10000;
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"],
				'item_image'        =>  $_POST["image"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
            //do the subtract in quantity
            //$q = $q - $_POST["quantity"];
            //$statement3 = $pdo->prepare('UPDATE products SET quantity = :quantity WHERE id = :id');
            //$statement3->bindValue(':id', $id);
            //$statement3->bindValue(':quantity' , $q);
            //$statement3->execute();
            header('Location: detail.php?id='.$_GET['id']);
		}
		else
		{
			$_SESSION['alert'] = false;
            header('Location: detail.php?id='.$_GET['id']);
		}
	}
	else
	{
		$_SESSION["shipping"] = 10000;
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"],
			'item_image'        => $_POST["image"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
        //do the subtract in quantity
        $q = $q - $_POST["quantity"];
        $statement3 = $pdo->prepare('UPDATE products SET quantity = :quantity WHERE id = :id');
        $statement3->bindValue(':id', $id);
        $statement3->bindValue(':quantity' , $q);
        $statement3->execute();
        header('Location: detail.php?id='.$_GET['id']);
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="test.php"</script>';
				header("location: cart.php");
			}
		}
	}
}
if(isset($_GET["action"]))
{
    if($_GET["action"] == "deleteall") 
    {
        session_destroy();
    }
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "checkout")
	{
		// Check if the user is logged in, if not then redirect him to login page
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		$_SESSION["check"] = false;
    	header("location: ../../index.php");
    	exit;
		}
		else{
		header("location: checkouts.php");
		exit;
	}
}
}
?>
<html>
    <head>

    </head>
    <body>
        
    </body>
</html>