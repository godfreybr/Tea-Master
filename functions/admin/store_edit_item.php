<?php

		// Post all the item infos
		$postedVariableArray = array("id","name","displayname","category","shortdesc","description","price","discount","stock");
		foreach($postedVariableArray as $postedVariableArrayItem)
		{ $l_updatedItemInfo[$postedVariableArrayItem] = $_POST['storeedit_'.$postedVariableArrayItem]; }
	
		// Add/Update any item posted
		if($l_updatedItemInfo['name']!="")
		{
			admin_storeedit_AddUpdateItem($l_updatedItemInfo);
		}
	
		// Post the image
		$l_updatedItemInfo["image"] = $_FILES["storeedit_image"];
		if($l_updatedItemInfo["image"]["name"]!="")
		{
			$l_updatedItemInfo["category_name"] = admin_storeedit_getCategoryName($l_updatedItemInfo['category']);
			admin_storeedit_ProcessCoverImage($l_updatedItemInfo["image"],$l_updatedItemInfo["category_name"],$l_updatedItemInfo['name']);
		}
		
		// Get the items contents
		$l_shopItemDetails = admin_storeedit_getItemDetails($l_edititem);
		?>
		<div class="content_container_div">
			<form action="index.php?page=admin&adminpage=editstore&item=<?php echo $l_edititem; ?>" method="post" enctype="multipart/form-data">
			<input name="storeedit_id" type="hidden" id="storeedit_id" value="<?php echo $l_shopItemDetails['id'] ?>">
				<table width="100%">
					<tr>
						<th colspan="2">Item</th>
					</tr>
					<tr>
						<th align="right">Item Name:</th>
						<td><input name="storeedit_name" type="text" required id="storeedit_name" placeholder="Item Name" pattern="^[a-zA-Z0-9_]*$" title="Item Name (a-zA-Z0-9_)" value="<?php echo $l_shopItemDetails['name'] ?>"></td>
					</tr>
					<tr>
						<th align="right">Item Display Name:</th>
						<td><input name="storeedit_displayname" type="text" required id="storeedit_displayname" placeholder="Display Name" title="Display Name" value="<?php echo $l_shopItemDetails['display_name'] ?>"></td>
					</tr>
					<tr>
						<th align="right">Category:</th>
						<td><select name="storeedit_category" id="storeedit_category">
							<option value="<?php echo $l_shopItemDetails['category_id'] ?>" selected="selected"><?php echo $l_shopItemDetails['category_displayname'] ?> (Current)</option>
							<?php
							$l_storeCategories = admin_storeedit_getAllCategories();
							foreach ($l_storeCategories as $l_storeCategory)
							{
								echo '<option value="'.$l_storeCategory['id'].'">'.$l_storeCategory['display_name'].'</option>';
							}
							?>
						</select></td>
					</tr>
					<tr>
						<th colspan="2">Details</th>
					</tr>
					<tr>
						<th align="right">Short Description:</th>
						<td><input name="storeedit_shortdesc" type="text" required id="storeedit_shortdesc" placeholder="Short Description" title="Short Description" value="<?php echo $l_shopItemDetails['description_short'] ?>"></td>
					</tr>
					<tr>
						<th align="right">Description:</th>
						<td><textarea name="storeedit_description" cols="30" rows="10" id="storeedit_description" placeholder="Description" title="Description"><?php echo $l_shopItemDetails['description'] ?></textarea></td>
					</tr>
					<tr>
						<th colspan="2">Store Info</th>
					</tr>
					<tr>
						<th align="right">Price:</th>
						<td><input name="storeedit_price" type="number" required id="storeedit_price" placeholder="Price" min="0.00" step="0.01" title="Price" value="<?php echo $l_shopItemDetails['price'] ?>"></td>
					</tr>
					<tr>
						<th align="right">Discount:</th>
						<td><input name="storeedit_discount" type="number" required id="storeedit_discount" placeholder="Discount" max="99" min="0" title="Discount" value="<?php echo $l_shopItemDetails['discount'] ?>"></td>
					</tr>
					<tr>
						<th align="right">Stock:</th>
						<td><input name="storeedit_stock" type="number" required id="storeedit_stock" placeholder="Stock" min="0" title="Stock" value="<?php echo $l_shopItemDetails['stock'] ?>"></td>
					</tr>
					<tr>
						<th colspan="2">Image</th>
					</tr>
					<tr>
						<th colspan="2"><img src="/images/<?php echo $l_shopItemDetails['category_name'] ?>/<?php echo $l_shopItemDetails['name'] ?>.png" alt="" width="150" height="150" /></th>
					</tr>
					<tr>
						<th align="right">Upload:</th>
						<td><input name="storeedit_image" type="file" id="storeedit_image" title="Image Upload"></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" title="Edit Item" value="Edit"></td>
					</tr>
				</table>
			</form>
		</div>