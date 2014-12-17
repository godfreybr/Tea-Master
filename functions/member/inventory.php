<?php

function member_inventory_getInventory($owner)
{
	try
	{
		global $db_handle;
		$stmt = $db_handle->prepare("SELECT tea_store_item.`name`, tea_store_item.`display_name`, tea_store_item.`description`, tea_store_categories.`name` AS category_name, tea_user_inventories.`amount` FROM tea_user_inventories INNER JOIN tea_store_item ON tea_user_inventories.`item`=tea_store_item.`id` INNER JOIN tea_store_categories ON tea_store_item.`category`=tea_store_categories.`id` WHERE tea_user_inventories.`owner`=? ORDER BY tea_store_item.`category`");
		$stmt->bindParam(1, $owner, PDO::PARAM_INT);
		$stmt->execute();
		$inventory = $stmt->fetchall(PDO::FETCH_ASSOC);
		return $inventory;
	}
	catch(PDOException $e)
	{
		if(TEA_DEBUG_ENABLE==1)
		{ echo "<p>".$e->getMessage()."</p>"; }
		else
		{ error_out("inventory"); }
	}
}

$l_usersInventory = member_inventory_getInventory($LoggedInUser['id']);

if(count($l_usersInventory)>0)
{
	echo '<h2>Inventory</h2><div class="content_container_div"><table width="100%" align="center">';
	echo '<tr><th colspan="2">Item</th><th width="75">Amount</th></tr>';
	foreach ($l_usersInventory as $l_usersInventoryItem) {
		echo '<tr>
				<td width="100"><img src="images/'.$l_usersInventoryItem['category_name'].'/'.$l_usersInventoryItem['name'].'.png" alt="" width="100" /></td>
				<td><strong>'.$l_usersInventoryItem['display_name'].'</strong><br />'.$l_usersInventoryItem['description'].'</td>
				<td align="center">'.$l_usersInventoryItem['amount'].'</td></tr>';
	}
	echo '</td></tr></table></form></div>';
} else {
	echo '<p>Inventory is empty</p>';
}
?>

