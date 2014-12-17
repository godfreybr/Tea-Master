<?php

// This function searches the store for any item matches
// It only searches the item title, then returns an array of matches
function search_searchStore($query)
{
	// Access global handle
	global $db_handle;

	// Fix query
	$query = "%$query%";
	
	try
	{
		// Prepare the statement
		$stmt = $db_handle->prepare("SELECT ".TEA_DB_PREFIX."store_item.`name`, ".TEA_DB_PREFIX."store_item.`display_name`, ".TEA_DB_PREFIX."store_categories.`name` AS category_name, ".TEA_DB_PREFIX."store_item.`description_short`, ".TEA_DB_PREFIX."store_item.`price` FROM ".TEA_DB_PREFIX."store_item INNER JOIN ".TEA_DB_PREFIX."store_categories ON ".TEA_DB_PREFIX."store_item.`category`=".TEA_DB_PREFIX."store_categories.`id` WHERE ".TEA_DB_PREFIX."store_item.`display_name` LIKE ?");
		$stmt->bindParam(1, $query, PDO::PARAM_STR,12);
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
			error_out("search");
		}
    }
}

$l_searchString = $_GET['search_query'];
setcookie("previous_search", $l_searchString, time() + (86400 * 30), "/");
if(isset($l_searchString) && $l_searchString!="")
{
	$l_searchResults = search_searchStore($l_searchString);
	if(count($l_searchResults)>0){
		echo '<div class="shop_container">';
		foreach ($l_searchResults as $l_searchResult) {
				echo store_formatStoreItem($l_searchResult['name'],$l_searchResult['display_name'],$l_searchResult['description_short'],$l_searchResult['category_name'],$l_searchResult['price']);
		}
		echo '</div>';
	} else {
		echo "<p>No results.</p>";
	}
} else {
	echo "<p>No search query.</p>";
}

?>

</div>
