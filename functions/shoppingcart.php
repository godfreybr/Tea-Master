<?php

function shoppingcart_addtocart($owner,$item,$amount)
{
	/*
	
	INSERT INTO ".TEA_DB_PREFIX."shopping_carts (cart_owner, item, amount) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE amount = amount+?
	INSERT INTO tea_shopping_carts (cart_owner, item, amount) VALUES (1, (SELECT id FROM tea_store_item WHERE name='rosa'), 1) ON DUPLICATE KEY UPDATE amount = amount+1
	
	*/
	
	// Access global handle
	global $db_handle;
	try {
		$stmt = $db_handle->prepare("INSERT INTO ".TEA_DB_PREFIX."shopping_carts (cart_owner, item, amount) VALUES (?, (SELECT id FROM ".TEA_DB_PREFIX."store_item WHERE name=?), ?) ON DUPLICATE KEY UPDATE amount = amount+?");
		$stmt->bindParam(1, $owner, PDO::PARAM_STR,12);
		$stmt->bindParam(2, $item, PDO::PARAM_STR,12);
		$stmt->bindParam(3, $amount, PDO::PARAM_STR,12);
		$stmt->bindParam(4, $amount, PDO::PARAM_STR,12);
		$stmt->execute();
	}
	catch(PDOException $e)
	{
    	if(TEA_DEBUG_ENABLE==1)
		{
			echo "<p>".$e->getMessage()."</p>";
		} else {
			error_out("shopping cart");
		}
    }
}

// This function updates the amount of items in a users cart
function shoppingcart_updateCartAmount($cart,$items,$owner)
{
	global $db_handle;
	try
	{
		// Update an item in the cart
		$stmt_updt = $db_handle->prepare("UPDATE ".TEA_DB_PREFIX."shopping_carts SET amount=? WHERE item=(SELECT id FROM ".TEA_DB_PREFIX."store_item WHERE name=?) AND cart_owner=?");
		
		// Delete an item from the cart
		$stmt_del = $db_handle->prepare("DELETE FROM ".TEA_DB_PREFIX."shopping_carts WHERE item=(SELECT id FROM ".TEA_DB_PREFIX."store_item WHERE name=?) AND cart_owner=?");

		// Go through each item name in the cart owners list
		foreach ($items as $item)
		{
			// If we're increasing or setting an amount higher than zero
			// Update it
			if($cart[$item['name']]>0)
			{
				$stmt_updt->bindParam(1, $cart[$item['name']], PDO::PARAM_STR,12);
				$stmt_updt->bindParam(2, $item['name'], PDO::PARAM_STR,12);
				$stmt_updt->bindParam(3, $owner, PDO::PARAM_STR,12);
				$stmt_updt->execute();
				
			// Otherwise they're removing it
			// So delete from database
			} else {
				$stmt_del->bindParam(1, $item['name'], PDO::PARAM_STR,12);
				$stmt_del->bindParam(2, $owner, PDO::PARAM_STR,12);
				$stmt_del->execute();
			}
		}
	}
	catch(PDOException $e)
	{
    	if(TEA_DEBUG_ENABLE==1)
		{
			echo "<p>".$e->getMessage()."</p>";
		} else {
			error_out("shopping cart");
		}
    }
}

function shoppingcart_getcartItemNames($owner)
{
	global $db_handle;
	try {
		$stmt = $db_handle->prepare("SELECT ".TEA_DB_PREFIX."store_item.name FROM ".TEA_DB_PREFIX."shopping_carts INNER JOIN ".TEA_DB_PREFIX."store_item ON ".TEA_DB_PREFIX."shopping_carts.item=".TEA_DB_PREFIX."store_item.id WHERE cart_owner=?");
		$stmt->bindParam(1, $owner, PDO::PARAM_STR,12);
		$stmt->execute();
		$cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $cart;
		}
	catch(PDOException $e)
	{
    	if(TEA_DEBUG_ENABLE==1)
		{
			echo "<p>".$e->getMessage()."</p>";
		} else {
			error_out("shopping cart");
		}
    }
}

function shoppingcart_getcart($owner)
{
	global $db_handle;
	try {
		$stmt = $db_handle->prepare("SELECT ".TEA_DB_PREFIX."store_item.name,".TEA_DB_PREFIX."store_item.display_name,".TEA_DB_PREFIX."store_categories.name AS category_name,".TEA_DB_PREFIX."store_item.price,".TEA_DB_PREFIX."store_item.stock,".TEA_DB_PREFIX."store_item.description,".TEA_DB_PREFIX."shopping_carts.amount, (".TEA_DB_PREFIX."store_item.price*".TEA_DB_PREFIX."shopping_carts.amount) AS itemcosts, (".TEA_DB_PREFIX."store_item.stock-".TEA_DB_PREFIX."shopping_carts.amount) AS poststock FROM ".TEA_DB_PREFIX."shopping_carts INNER JOIN ".TEA_DB_PREFIX."store_item ON ".TEA_DB_PREFIX."shopping_carts.item=".TEA_DB_PREFIX."store_item.id INNER JOIN ".TEA_DB_PREFIX."store_categories ON ".TEA_DB_PREFIX."store_categories.id=".TEA_DB_PREFIX."store_item.category WHERE cart_owner=?");
		$stmt->bindParam(1, $owner, PDO::PARAM_INT);
		$stmt->execute();
		$cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $cart;
	}
	catch(PDOException $e)
	{
    	if(TEA_DEBUG_ENABLE==1)
		{
			echo "<p>".$e->getMessage()."</p>";
		} else {
			error_out("shopping cart");
		}
    }
}

function shoppingcart_getTotalCartCost($owner)
{
	global $db_handle;
	try {
		$stmt = $db_handle->prepare("SELECT sum((".TEA_DB_PREFIX."store_item.price*".TEA_DB_PREFIX."shopping_carts.amount)) AS itemcosts FROM ".TEA_DB_PREFIX."shopping_carts INNER JOIN ".TEA_DB_PREFIX."store_item ON ".TEA_DB_PREFIX."shopping_carts.item=".TEA_DB_PREFIX."store_item.id WHERE ".TEA_DB_PREFIX."shopping_carts.cart_owner=?");
		$stmt->bindParam(1, $owner, PDO::PARAM_STR,12);
		$stmt->execute();
		$cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $cart[0]['itemcosts'];
	}
	catch(PDOException $e)
	{
    	if(TEA_DEBUG_ENABLE==1)
		{
			echo "<p>".$e->getMessage()."</p>";
		} else {
			error_out("shopping cart");
		}
    }
}

// This function checks the stock levels, if a transaction was made
// Used to make sure a user doesn't purchase more than the store stocks
function shoppingcart_getPostStockLevels($owner)
{
	global $db_handle;
	try {
		$stmt = $db_handle->prepare("SELECT (".TEA_DB_PREFIX."store_item.stock-".TEA_DB_PREFIX."shopping_carts.amount) AS poststock FROM ".TEA_DB_PREFIX."shopping_carts INNER JOIN ".TEA_DB_PREFIX."store_item ON ".TEA_DB_PREFIX."shopping_carts.item=".TEA_DB_PREFIX."store_item.id WHERE ".TEA_DB_PREFIX."shopping_carts.cart_owner=?");
		$stmt->bindParam(1, $owner, PDO::PARAM_STR,12);
		$stmt->execute();
		$cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $cart;
	}
	
	catch(PDOException $e) {
		if(TEA_DEBUG_ENABLE==1)
			{ echo "<p>".$e->getMessage()."</p>"; }
		else
			{ error_out("shopping cart"); }

	}
}

function shoppingcart_buyCart($owner,$credits)
{
	global $db_handle;
	
	// Get the total costs of the cart
	$totalCartCost = shoppingcart_getTotalCartCost($owner);

	// Make sure owner can purchase
	if(($credits-$totalCartCost) < 0)
	{
		$cartErrors++;
	}

	// Check stock levels
	$postStockLevels = shoppingcart_getPostStockLevels($owner);
	foreach($postStockLevels as $postStockLevel)
	{
		if($postStockLevel['poststock']<0)
		{
			$cartErrors++;
		}
	}
	
	// Get the users cart
	$currentCart = $db_handle->prepare("SELECT item,amount FROM ".TEA_DB_PREFIX."shopping_carts WHERE tea_shopping_carts.cart_owner=?");
	$currentCart->bindParam(1, $owner, PDO::PARAM_INT);
	$currentCart->execute();
	$currentCart = $currentCart->fetchAll(PDO::FETCH_ASSOC);
	
	// Make sure the cart isn't empty
	if(!count($currentCart)>0)
	{
		$cartErrors++;
	}
	
	// If there are no cart errors
	// The cart is good to be processed
	if(!$cartErrors>0)
	{
	
		// Update the users credits
		try {
			$updateCredits = $db_handle->prepare("UPDATE ".TEA_DB_PREFIX."users SET credits=(credits-?) WHERE id=?");
			$updateCredits->bindParam(1, $totalCartCost, PDO::PARAM_STR);
			$updateCredits->bindParam(2, $owner, PDO::PARAM_INT);
			$updateCredits->execute();
		}
		catch(PDOException $e) {
			if(TEA_DEBUG_ENABLE==1)
				{ echo "<p>".$e->getMessage()."</p>"; }
			else
				{ error_out("shopping cart"); }
	
		}
	
	// Create prepared inventory updater statement
	$updateInventory = $db_handle->prepare("INSERT INTO ".TEA_DB_PREFIX."user_inventories (owner, item, amount) VALUES (:owner, :item, :amount1) ON DUPLICATE KEY UPDATE amount = (amount+:amount2)");
	$updateInventory->bindParam(":owner", $owner, PDO::PARAM_INT);
	// Create prepared stock updater statement
	$updateStock = $db_handle->prepare("UPDATE ".TEA_DB_PREFIX."store_item SET stock=(stock-:stock) WHERE id=:item");
	// Create prepared shopping cart cleaner
	$updateCart = $db_handle->prepare("DELETE FROM ".TEA_DB_PREFIX."shopping_carts WHERE item=:item AND cart_owner=:owner");
	
	// Iterate through the users cart and process it
	foreach($currentCart AS $currentCartItem)
	{
		
		// Update inventory
		$updateInventory->bindParam(":item", $currentCartItem['item'], PDO::PARAM_INT);
		$updateInventory->bindParam(":amount1", $currentCartItem['amount'], PDO::PARAM_INT);
		$updateInventory->bindParam(":amount2", $currentCartItem['amount'], PDO::PARAM_INT);
		$updateInventory->execute();
		// Update stock
		$updateStock->bindParam(":item", $currentCartItem['item'], PDO::PARAM_INT);
		$updateStock->bindParam(":stock", $currentCartItem['amount'], PDO::PARAM_INT);
		$updateStock->execute();
		// Update cart
		$updateCart->bindParam(":item", $currentCartItem['item'], PDO::PARAM_INT);
		$updateCart->bindParam(":owner", $owner, PDO::PARAM_INT);
		$updateCart->execute();
		
	}
	
	//INSERT INTO ".TEA_DB_PREFIX."shopping_carts (cart_owner, item, amount) VALUES (?, (SELECT id FROM ".TEA_DB_PREFIX."store_item WHERE name=?), ?) ON DUPLICATE KEY UPDATE amount = amount+?
	//UPDATE tea_store_item SET stock=? WHERE id=?
	//
	} else {
		return false;
	}
}

?>