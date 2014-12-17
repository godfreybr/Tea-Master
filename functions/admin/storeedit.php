<?php

function admin_storeedit_getAllItems()
{
	global $db_handle;
	$stmt = $db_handle->prepare("SELECT ".TEA_DB_PREFIX."store_item.id,".TEA_DB_PREFIX."store_item.display_name,".TEA_DB_PREFIX."store_item.price,".TEA_DB_PREFIX."store_item.stock,".TEA_DB_PREFIX."store_categories.display_name AS category_name FROM ".TEA_DB_PREFIX."store_item INNER JOIN ".TEA_DB_PREFIX."store_categories ON ".TEA_DB_PREFIX."store_item.category=".TEA_DB_PREFIX."store_categories.id ORDER BY ".TEA_DB_PREFIX."store_item.category");
	$stmt->execute();
	$searchresults = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $searchresults;
}

function admin_storeedit_getItemDetails($item)
{
	global $db_handle;
	$stmt = $db_handle->prepare("SELECT ".TEA_DB_PREFIX."store_item.id,".TEA_DB_PREFIX."store_categories.id AS category_id,".TEA_DB_PREFIX."store_categories.display_name AS category_displayname,".TEA_DB_PREFIX."store_categories.name AS category_name,".TEA_DB_PREFIX."store_item.name, ".TEA_DB_PREFIX."store_item.display_name,".TEA_DB_PREFIX."store_item.description,".TEA_DB_PREFIX."store_item.description_short,".TEA_DB_PREFIX."store_item.price,".TEA_DB_PREFIX."store_item.discount,".TEA_DB_PREFIX."store_item.stock FROM ".TEA_DB_PREFIX."store_item INNER JOIN ".TEA_DB_PREFIX."store_categories ON ".TEA_DB_PREFIX."store_item.category=".TEA_DB_PREFIX."store_categories.id WHERE ".TEA_DB_PREFIX."store_item.id=?");
	$stmt->bindParam(1, $item, PDO::PARAM_INT);
	$stmt->execute();
	$searchresults = $stmt->fetch(PDO::FETCH_ASSOC);
	return $searchresults;
}

function admin_storeedit_getAllCategories()
{
	global $db_handle;
	$stmt = $db_handle->prepare("SELECT id,display_name FROM ".TEA_DB_PREFIX."store_categories");
	$stmt->execute();
	$searchresults = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $searchresults;
}

function admin_storeedit_AddUpdateItem($itemarray)
{
	global $db_handle;
	// If the submitted ID is blank
	// Add an item, it never exited before
	if($itemarray['id']=="")
	{
		$stmt = $db_handle->prepare("INSERT INTO ".TEA_DB_PREFIX."store_item (name,display_name,category,description_short,description,price,discount,stock) VALUES (:name, :displayname, :category, :shortdesc, :desc, :price, :discount, :stock)");
	} else {
		$stmt = $db_handle->prepare("UPDATE ".TEA_DB_PREFIX."store_item SET name=:name, display_name=:displayname, category=:category, description_short=:shortdesc, description=:desc, price=:price, discount=:discount, stock=:stock WHERE id=:id");
		$stmt->bindParam(":id", $itemarray['id'], PDO::PARAM_INT);
	}
	$stmt->bindParam(":name", $itemarray['name'], PDO::PARAM_STR);
	$stmt->bindParam(":displayname", $itemarray['displayname'], PDO::PARAM_STR);
	$stmt->bindParam(":category", $itemarray['category'], PDO::PARAM_INT);
	$stmt->bindParam(":shortdesc", $itemarray['shortdesc'], PDO::PARAM_STR);
	$stmt->bindParam(":desc", $itemarray['description'], PDO::PARAM_STR);
	$stmt->bindParam(":price", $itemarray['price'], PDO::PARAM_STR);
	$stmt->bindParam(":discount", $itemarray['discount'], PDO::PARAM_INT);
	$stmt->bindParam(":stock", $itemarray['stock'], PDO::PARAM_INT);
	$stmt->execute();
}

function admin_storeedit_getCategoryName($id)
{
	global $db_handle;
	$stmt = $db_handle->prepare("SELECT name FROM ".TEA_DB_PREFIX."store_categories WHERE id=?");
	$stmt->bindParam(1, $id, PDO::PARAM_INT);
	$stmt->execute();
	$searchresults = $stmt->fetch(PDO::FETCH_ASSOC);
	return $searchresults['name'];
}

function admin_storeedit_ProcessCoverImage($image,$category,$name)
{
	// Get the uploaded image
	$input = $image["tmp_name"];
	
	// Construct the url for outputed image
	$output = TEA_DIR_IMAGES.$category."/".$name.".png";

	// Make sure the directory exists
	// If not, create it
	if(!file_exists(TEA_DIR_IMAGES.$category))
	{ mkdir(TEA_DIR_IMAGES.$category, 0755); }

	// New Dimensions
	$x = 128;
	$y = 128;

	// Get new dimensions
	list($width, $height) = getimagesize($input);
	
	// Create a blank image object
	$new_image = imagecreatetruecolor($x, $y);

	// Create another image object from uploaded picture
	// Use switch statement for different image types
	switch($image["type"]) {
		case 'image/jpg':
		case 'image/jpeg':
			$image = imagecreatefromjpeg($input);
		break;
		case 'image/gif':
			$image = imagecreatefromgif($input);
		break;
		case 'image/png':
			$image = imagecreatefrompng($input);
			
			// Disable alpha blending & enable alpha in blank image object
			// For transparency
			imagealphablending($new_image, false);
			imagesavealpha($new_image,true);
			$transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
			imagefilledrectangle($new_image, 0, 0, $x, $y, $transparent);
			
			// Add transparency to original image
			imagesavealpha($image,true);
		break;
	}

	// Resize uploaded picture & import to blank image object
	imagecopyresampled($new_image, $image, 0, 0, 0, 0, $x, $y, $width, $height);
	
	// Output final image
	imagepng($new_image, $output, 7);
}

?>