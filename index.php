<?php

/*
===== REFERENCES =====

* 	http://www.teavana.com/

*/

//ini_set('display_errors', 1);
//error_reporting(E_ALL ^ E_NOTICE);

// Define included
define("TEA_MAIN_INCLUDED",1);

// Include config file
require("config.php");

// Include core functions
require(TEA_DIR_FUNCTIONS."functions.php");

// Initiate Database & handle
$db_handle = database_connect();

// Log the user out if they wanted it
if(isset($_GET['logout'])) { controller_logout(); }

// Check if a user is logged in
$LoggedInUser = controller_isLoggedIn();

// Get the page variable
if(!isset($_GET['page']))
{
	$l_pageid = "home";
} else {
	$l_pageid = $_GET['page'];
}

// Get the item post
if(!isset($_GET['item']))
{
	// If page item is not set, make sure the variable is null
	$l_pageitem = NULL;
	
	// Since we're not checking for an item
	// Check if we're checking for a category
	if(!isset($_GET['category']))
	{
		// If the category isn't set
		// Make sure the variable is null
		$l_pagecategory = NULL;
		} else {
		// Otherwise set the variable to the search term
		$l_pagecategory = $_GET['category'];
	}
} else {
	// If the item search is not null
	// Variable it
	$l_pageitem = $_GET['item'];
	
	// Make sure the category is NULL
	// to prevent conflicts.
	$l_pagecategory = NULL;
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tea Master: Homepage</title>
<link rel="stylesheet" type="text/css" href="themes/skylake/styles/main.css">
<script type="text/javascript" src="javascript/validateprofile.js"></script>
<script type="text/javascript">

// Detect for Internet Explorer
// We don't support IE because it sucks
if (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0)
{
	alert("This website does not support Internet Explorer.");
}

</script>
</head>

<body>

<?php //var_dump($LoggedInUser); ?>

<div id="head_infobar">
	<div style="float:left; display:inline-block; margin: 5px;"><a href="AssignmentInfo.html">Assignment Info</a> | <?php if($LoggedInUser['is_admin']) { ?><a href="index.php?page=admin">Admin</a><?php } ?></div>
	<div style="float:right; display:inline-block; margin: 5px;">
		<?php
if($LoggedInUser==NULL)
{ echo 'Not Logged In, <a href="index.php?page=login">login</a> or <a href="index.php?page=register">register</a>'; }
else
{ echo 'Hello ' . $LoggedInUser['first_name'] . ' (<a href="index.php?page=login&logout">Logout</a>) | <a href="index.php?page=editprofile">Edit Profile</a> | <a href="index.php?page=inventory">Inventory</a> | <a href="index.php?page=shoppingcart">Shopping Cart</a> | Credits: ' . $LoggedInUser['credits']; }
?></div>
	<div style="clear:both;"></div>
</div>
<div id="main_container">
	<div id="banner_container"><img src="themes/skylake/images/banner-text.png" alt="Tea Master" /></div>
	<div id="nav_container">
		<?php
	
		// Build the navigation bar
		$navbar = database_getcontent_navigation();
		foreach ($navbar as $navitem) {
			echo '<a href="index.php?page='.$navitem['title'].'">'.$navitem['title_full'].'</a>';
		}
	
	?>
		<div style="float: right; display: inline-block">
			<form id="search_searchform">
				<input name="page" type="hidden" id="page" value="search">
				<input name="search_query" type="search" required="required" id="search_query" placeholder="Search Store" list="previous_searches" pattern=".{3,}" title="Search Store (Min 3 Characters)">
				
				<?php if($_COOKIE['previous_search']!="") { ?>
				<datalist id="previous_searches">
				<option value="<?php echo $_COOKIE['previous_search']; ?>">
				</datalist>
				<?php } ?>
				
				<input type="submit" title="Go" value="Go">
			</form>
		</div>
	</div>
	<div id="content_container">
		<?php
	
		// Build the page content
		$pageContent = database_getcontent_pagecontent($l_pageid);
		if($pageContent['link_only']==0)
		{
			echo $pageContent['content'];
		}
		
		// Include the related modules for each page
		if($l_pageid=="home")
		{
			echo "<h2>Newest Items</h2>";
			$l_newestItems = store_getNewest();
			foreach ($l_newestItems as $l_newestItem) {
				echo store_formatStoreItem($l_newestItem['name'],$l_newestItem['display_name'],$l_newestItem['description_short'],$l_newestItem['category_name'],$l_newestItem['price']);
			}
		}
		
		// This is the store page
		// Display all store items
		if($l_pageid=="store")
		{
			
			// Show categories
			echo "<h3>Categories</h3>";
			
			// Get the category variable
			if(!isset($_GET['category']))
			{
				$l_categoryid = NULL;
			} else {
				$l_categoryid = $_GET['category'];
				// If the category is blank, set it to NULL
				if($l_categoryid==""){ $l_categoryid = NULL; }
			}
			
			// Check if the category is the root category
			// If not root, display breadcrumbs
			if(isset($l_categoryid) && $l_categoryid!="")
			{
				$l_store_parentcategory = store_getParentCategory($l_categoryid);
				if($l_store_parentcategory['display_name']=="")
				{ $l_store_parentcategory['display_name'] = "Root"; }
				echo store_formatStoreCategory($l_store_parentcategory['name'],"<-- ".$l_store_parentcategory['display_name']);
			}
			
			// Get all sub-categories of the root category
			$l_store_categories = store_getRootCategory($l_categoryid);
			foreach ($l_store_categories as $l_store_category) {
				echo store_formatStoreCategory($l_store_category['name'],$l_store_category['display_name']);
			}
			
			// Display all the shops items for the current category
			echo "<h3>Items</h3>";
			$l_store_items = store_getProductsInCategory($l_categoryid);
			foreach ($l_store_items as $l_store_item) {
				echo store_formatStoreItem($l_store_item['name'],$l_store_item['display_name'],$l_store_item['description_short'],$l_store_item['category_name'],$l_store_item['price']);
			}
			
		}
		
		// This is the shopping cart
		// We post any purchases & display the users shopping cart here
		if($l_pageid=="shoppingcart")
		{
			// Make sure the user is logged in
			// Guests may not shop here
			if($LoggedInUser!=NULL)
			{
				require(TEA_DIR_FUNCTIONS."shoppingcart.php");
				
				if($_POST['cart_method']=="Purchase")
				{
					shoppingcart_buyCart($LoggedInUser['id'],$LoggedInUser['credits']);
				}
				
				// Add items to users cart
				if(isset($_POST['addtocart_item']))
				{
					$l_shoppingcart_response = shoppingcart_addtocart($LoggedInUser['id'],$_POST['addtocart_item'],$_POST['addtocart_amount']);
					if($l_shoppingcart_response>0)
					{
						echo "<p>Added to cart...</p>";
					}
				}
				
				// Modify cart
				if($_POST['cart_method']=="Update")
				{
					$l_itemNameList = shoppingcart_getcartItemNames($LoggedInUser['id']);
					foreach ($l_itemNameList as $l_itemNameListItem) {
						$l_itemCartUpdatedAmount[$l_itemNameListItem['name']] = $_POST['modifycart_amount_'.$l_itemNameListItem['name']];
					}

					if($l_itemCartUpdatedAmount!=NULL)
					{
						shoppingcart_updateCartAmount($l_itemCartUpdatedAmount,$l_itemNameList,$LoggedInUser['id']);
					}
				}
				
				// Get the users cart
				// Display it all
				$l_shoppingcart_items = shoppingcart_getcart($LoggedInUser['id']);
				
				$l_shoppingcart_size = count($l_shoppingcart_items);
				
				echo '<h2>Shopping Cart</h2>';
				
				if($l_shoppingcart_size>0)
				{
					echo '<div class="content_container_div"><form action="index.php?page=shoppingcart" method="post"><table width="100%" align="center">';
					echo '<tr><th colspan="2">Item</th><th width="50">Price</th><th width="50">Stock</th><th width="75">Amount</th><th width="50">Total</th></tr>';
					foreach ($l_shoppingcart_items as $l_shoppingcart_item) {
						echo '<tr>
						<td width="100"><img src="images/'.$l_shoppingcart_item['category_name'].'/'.$l_shoppingcart_item['name'].'.png" alt="" width="100" /></td>
						<td><strong>'.$l_shoppingcart_item['display_name'].':</strong> '.$l_shoppingcart_item['description'].'</td>
						<td>$'.$l_shoppingcart_item['price'].'</td>';
						if(($l_shoppingcart_item['stock']-$l_shoppingcart_item['amount'])<0)
						{
							echo '<td style="color:red;">'.$l_shoppingcart_item['stock'].'</td>';
							$l_cartUnderstocked = true;
						} else {
							echo '<td>'.$l_shoppingcart_item['stock'].'</td>';
						}
						
						echo '<td><input name="modifycart_amount_'.$l_shoppingcart_item['name'].'" type="number" id="modifycart_amount_'.$l_shoppingcart_item['name'].'" min="0" step="1" value="'.$l_shoppingcart_item['amount'].'"></td>
						<td>$'.$l_shoppingcart_item['itemcosts'].'</td></tr>';
					}
					echo '<tr><td colspan="5" align="right">Total:</td><td>$'.shoppingcart_getTotalCartCost($LoggedInUser['id']).'</td></tr>';
					echo '<tr><td colspan="10"><input name="cart_method" type="submit" id="cart_method" value="Update">';
					
					if(shoppingcart_getTotalCartCost($LoggedInUser['id'])>$LoggedInUser['credits'] || $l_cartUnderstocked == true)
					{
						echo '<input name="cart_method" type="submit" disabled id="cart_method" value="Purchase (Insufficient Funds/Stock)">';
					} else {
						echo '<input name="cart_method" type="submit" id="cart_method" value="Purchase">';
					}
					echo '</td></tr></table></form></div>';
				} else {
					echo '<p>Cart is empty</p>';
				}
			} else {
				// USer isn't logged in, so no cart for them
				echo '<p>You must be logged in to use the store.</p>';
			}
		}

		// This is the administration panel
		// Make sure user is an admin
		if($l_pageid=="admin" && $LoggedInUser['is_admin'])
		{
			// Include admin module
			require(TEA_DIR_FUNCTIONS."admin/admin.php");
		}

		if($l_pageid=="editprofile" && $LoggedInUser!=NULL)
		{
			require(TEA_DIR_FUNCTIONS."member/editprofile.php");
		}
		
		if($l_pageid=="inventory" && $LoggedInUser!=NULL)
		{
			require(TEA_DIR_FUNCTIONS."member/inventory.php");
		}

		if($l_pageid=="login")
		{
			require(TEA_DIR_FUNCTIONS."member/login.php");
		}
		
		if($l_pageid=="register")
		{
			require(TEA_DIR_FUNCTIONS."member/register.php");
		}
		if($l_pageid=="search")
		{
			require(TEA_DIR_FUNCTIONS."search.php");
		}
		?>
	</div>
</div>
</body>
</html>
<?php database_close(); ?>