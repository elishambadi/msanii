<?php 
session_start();
if(!empty($_GET["action"])) {
	switch ($_GET["action"]) {
		case 'add':
			if (!empty($_POST["quantity"])) {//Will be 1 always
				$productByCode = $db_handle->runQuery("SELECT * FROM photographers WHERE photographer_id='" . $_GET["code"] . "'");

				$itemArray = array($productByCode[0]['photographer_id'] =>
					array('photographer_name'=>$productByCode[0]["username"],
						'photographer_id'=>$productByCode[0]["photographer_id"],
						'email'=>$productByCode)[0]["email"] );

				if (!empty($_SESSION["cart_item"])) {
					//to check if current photographer is already in cart
					if (in_array($productByCode[0]["photographer_id"], array_keys($_SESSION["cart_item"]))) {
						
					}
					else{
						//If not add the photographer to cart
						$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
					}
				}
				else{
					$_SESSION["cart_item"] = $itemArray;
				}
			}
			break;
		case 'remove':
			if (!empty($_SESSION["cart_item"])) {
				foreach ($_SESSION["cart_item"] as $key => $value) {
					if ($_GET["code"] == $key) {
						unset($_SESSION["cart_item"][$key]);
					}
					if (empty($_SESSION["cart_item"])) {
						unset($_SESSION["cart_item"]);
					}
				}
			}
			break;
		case 'empty':
			unset($_SESSION["cart_item"]);
			break;
		default:
			# code...
			break;
	}
};
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Shopping cart</title>
 	<!-- Bootstrap core CSS -->
  	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  	<!-- Custom styles for this template -->
  	<link href="css/simple-sidebar.css" rel="stylesheet">

  	<!-- Fontawesome Icons -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 </head>
 <body>
 	<h4>Shopping Cart</h4>
 	<a href="cart.php?action=empty"></a>
 	<table class="table">
 		<th>id</th>
 		<th>Username</th>
 		<th>Remove</th>
 	</table>
 	<?php 
 		//Code to display cart items
 		foreach ($_SESSION["cart_item"] as $item) {?>
 			<tr>
 				<td><?php echo $item["photographer_id"]; ?></td>
 				<td><!-- <img src="<?php echo $item["image"]; ?>"> --><?php echo $item["username"]; ?></td>
 				<td><a href="cart.php?action=remove&&code="></a></td>
 			</tr>
 		<?}
 	 ?>
 
 </body>
 </html>