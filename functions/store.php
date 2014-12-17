<?php

function store_formatStoreItem($itemID,$itemName,$itemDesc,$itemClass,$itemPrice)
{
	return '<div class="shop_item" id="shop_item-'.$itemID.'" tooltip="'.$itemDesc.'">
				<div class="shop_item_title">'.$itemName.'</div>
				<img src="images/'.$itemClass.'/'.$itemID.'.png" width="128" />
				<div class="shop_item_price">$'.$itemPrice.'</div>
				<div class="shop_item_controls"><form action="index.php?page=shoppingcart" method="post"><input name="addtocart_item" type="hidden" id="addtocart_item" value="'.$itemID.'"><input name="addtocart_amount" type="hidden" id="addtocart_amount" value="1"><input type="submit" value="Add to Cart"></form></div>
			</div>';
}

function store_formatStoreCategory($id,$name)
{
	return '<div class="shop_category"><a href="index.php?page=store&category='.$id.'">'.$name.'</a></div>';
}

function store_getRootCategory($itemCategory)
{
	// Access global handle
	global $db_handle;
	if($itemCategory!=NULL)
	{
		$stmt = $db_handle->prepare("SELECT * FROM ".TEA_DB_PREFIX."store_categories WHERE subcategory=(SELECT id FROM tea_store_categories WHERE name=?)");
		$stmt->bindParam(1, $itemCategory, PDO::PARAM_STR,12);
	} else {
		$stmt = $db_handle->prepare("SELECT * FROM ".TEA_DB_PREFIX."store_categories WHERE subcategory IS NULL");
	}
	$stmt->execute();
	$searchresults = $stmt->fetchall(PDO::FETCH_ASSOC);
	return $searchresults;
}

function store_getProductsInCategory($category)
{
	// Access global handle
	global $db_handle;
	$stmt = $db_handle->prepare("SELECT ".TEA_DB_PREFIX."store_item.name,".TEA_DB_PREFIX."store_item.display_name,".TEA_DB_PREFIX."store_item.description,".TEA_DB_PREFIX."store_item.description_short,".TEA_DB_PREFIX."store_item.price,".TEA_DB_PREFIX."store_item.discount,".TEA_DB_PREFIX."store_categories.name AS category_name FROM ".TEA_DB_PREFIX."store_item INNER JOIN ".TEA_DB_PREFIX."store_categories ON ".TEA_DB_PREFIX."store_categories.id=".TEA_DB_PREFIX."store_item.category WHERE category=(SELECT id FROM ".TEA_DB_PREFIX."store_categories WHERE name=?)");
	$stmt->bindParam(1, $category, PDO::PARAM_STR,12);
	$stmt->execute();
	$searchresults = $stmt->fetchall(PDO::FETCH_ASSOC);
	return $searchresults;
}

function store_getParentCategory($category)
{
	// Access global handle
	global $db_handle;
	$stmt = $db_handle->prepare("SELECT name,display_name FROM ".TEA_DB_PREFIX."store_categories WHERE id=(SELECT subcategory FROM ".TEA_DB_PREFIX."store_categories WHERE name=?)");
	$stmt->bindParam(1, $category, PDO::PARAM_STR,12);
	$stmt->execute();
	$searchresults = $stmt->fetch(PDO::FETCH_ASSOC);
	return $searchresults;
}

function store_getNewest()
{
	// Access global handle
	global $db_handle;

	try
	{
		// Prepare the statement
		$stmt = $db_handle->prepare("SELECT ".TEA_DB_PREFIX."store_item.name,".TEA_DB_PREFIX."store_item.display_name,".TEA_DB_PREFIX."store_item.description_short,".TEA_DB_PREFIX."store_categories.name AS category_name,".TEA_DB_PREFIX."store_item.price FROM ".TEA_DB_PREFIX."store_item INNER JOIN ".TEA_DB_PREFIX."store_categories ON ".TEA_DB_PREFIX."store_categories.id = ".TEA_DB_PREFIX."store_item.category ORDER BY date_added DESC LIMIT 20");
		$stmt->execute();
		$searchresults = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Return the array
		return $searchresults;
	}
	// Catch any errors
	catch(PDOException $e)
	{
    	if(TEA_DEBUG_ENABLE==1)
		{
			echo $e->getMessage();
		} else {
			error_out("store");
		}
    }
}

?>