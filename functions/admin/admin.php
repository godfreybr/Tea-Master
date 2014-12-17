<?php

// Check for the current page variable
if(!isset($_GET['adminpage']))
{
	$l_adminpage = 'home';
} else {
	$l_adminpage = $_GET['adminpage'];
}

?>

<h2>Administration Panel</h2>
<div style="float:left; width: 200px; display: inline-block;">
	<ul>
		<li><a href="index.php?page=admin&adminpage=home">Home</a></li>
		<li><a href="index.php?page=admin&adminpage=editstore">Edit Store</a></li>
		<li><a href="index.php?page=admin&adminpage=editstore&item=0">Add Items</a></li>
		<li><a href="index.php?page=admin&adminpage=edituser">Edit User</a></li>
	</ul>
</div>
<div style="display:inline-block; width:550px;">
	<?php 
if($l_adminpage=="home")
{ 

	echo '<h2>Administration Panel</h2><p>This administration panel allows you to edit users and the store.</p>';

}

if($l_adminpage=="editstore")
{ 
	require("storeedit.php");
	echo '<h2>Edit Store</h2><p>This administration panel allows you to edit users and the store.</p>';

	// Get the selected item
	$l_edititem = $_GET['item'];

	
	if($l_edititem=="")
	{
		
		// Get all items in store
		$l_storeAllItems = admin_storeedit_getAllItems();
		echo '<div class="content_container_div"><table width="100%">';
		foreach ($l_storeAllItems as $l_storeAllItem)
		{
			echo '<tr><th align="left">' . $l_storeAllItem['category_name'] . '</th><td><a href="index.php?page=admin&adminpage=editstore&item='.$l_storeAllItem['id'].'">' . $l_storeAllItem['display_name'] . '</a></td><td>$'.$l_storeAllItem['price'].'</td><td>'.$l_storeAllItem['stock'].'</td></tr>';
		}
		echo '</table></div>';
		
	}
		else
	{
		require(TEA_DIR_FUNCTIONS."admin/store_edit_item.php");
	}
}

// The edit user page
if($l_adminpage=="edituser")
{ 
	require("useredit.php");
	echo '<h2>Edit User</h2>';
	echo '<p>This page will allow you to edit a users profile.</p>';
	
	// Get the selected user
	$l_edituser = $_GET['user'];
	
	// If there is no selected user
	// Allow the admin to search and find one
	if($l_edituser=="")
	{
		echo '<div class="content_container_div"><form action="index.php?page=admin&adminpage=edituser" method="post">Search Users: <input name="admin_searchUsers" type="search" id="admin_searchUsers" placeholder="Username / Email / Name" title="Search Users"><input type="submit" title="Search Users" value="Search"></form></div>';
		
		if($_POST['admin_searchUsers']!="")
		{
			$l_searchedUsers = admin_useredit_searchUsers($_POST['admin_searchUsers']);
			if(count($l_searchedUsers)>0)
			{
				echo '<div class="content_container_div"><ul>';
				foreach ($l_searchedUsers as $l_searchedUser)
				{
					echo '<li><a href="index.php?page=admin&adminpage=edituser&user='.$l_searchedUser['username'].'">'.$l_searchedUser['first_name'].' '.$l_searchedUser['last_name'].'</a></li>';
				}
				echo '</ul></div>';
			} else {
				echo '<div class="content_container_div">No results</div>';
			}
		}
	} else {
		require(TEA_DIR_FUNCTIONS."admin/members_edit_user.php");
	}
}

?>
</div>
<!-- For design reasons, this must stay at the bottom -->
<div style="clear:both;"></div>
