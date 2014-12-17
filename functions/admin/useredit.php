<?php

// This function gets all the details of a specified user
function admin_useredit_getUserDetails($user)
{
	global $db_handle;
	$stmt = $db_handle->prepare("SELECT ".TEA_DB_PREFIX."users.`username`,".TEA_DB_PREFIX."users.`group`,".TEA_DB_PREFIX."user_groups.`group_name`,".TEA_DB_PREFIX."users.`credits`,".TEA_DB_PREFIX."users.`email`,".TEA_DB_PREFIX."users.`first_name`,".TEA_DB_PREFIX."users.`last_name`,".TEA_DB_PREFIX."users.`address`,".TEA_DB_PREFIX."users.`suburb`,".TEA_DB_PREFIX."users.`state`,".TEA_DB_PREFIX."users.`country`,".TEA_DB_PREFIX."users.`postcode`,".TEA_DB_PREFIX."users.`home_phone`,".TEA_DB_PREFIX."users.`mobile_phone` FROM ".TEA_DB_PREFIX."users INNER JOIN ".TEA_DB_PREFIX."user_groups ON ".TEA_DB_PREFIX."users.`group`=".TEA_DB_PREFIX."user_groups.`id` WHERE `username`=?");
	$stmt->bindParam(1, $user, PDO::PARAM_STR);
	$stmt->execute();
	$searchresults = $stmt->fetch(PDO::FETCH_ASSOC);
	return $searchresults;
}

// This function gets all the groups on the server
function admin_useredit_getGroups()
{
	global $db_handle;
	$stmt = $db_handle->prepare("SELECT id,group_name FROM ".TEA_DB_PREFIX."user_groups");
	$stmt->bindParam(1, $user, PDO::PARAM_INT);
	$stmt->execute();
	$searchresults = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $searchresults;
}

// The function sets all the users details
// MUCH BETA
// MANY UNCERTANTIES
function admin_useredit_setUserDetails($userarray)
{
	global $db_handle;
	// Check if the password is blank
	// If a password was submitted, encrypt it
	// Otherwise set to NULL
	if($userarray['password']!="")
		{ $userarray['password'] = controller_encryptString($userarray['password']); }
	else
		{ $userarray['password'] = NULL; }
	
	// Update the users profile
	// Note on the password:
	// I HAVE NO IDEA WHY IT'S BACKWARDS
	// Just accept that it works and I spent many hours on it
	$stmt = $db_handle->prepare("UPDATE `".TEA_DB_PREFIX."users` SET `email`=:email, `credits`=:credits, `group`=:group, `first_name`=:first_name, `last_name`=:last_name, `address`=:address, `suburb`=:suburb, `state`=:state, `country`=:country, `postcode`=:postcode, `home_phone`=:home_phone, `mobile_phone`=:mobile_phone, `password`=(CASE `password` WHEN :password1 IS NOT NULL THEN `password` ELSE :password2 END) WHERE `username`=:username");
	$stmt->bindParam(":email", $userarray['email'], PDO::PARAM_STR);
	$stmt->bindParam(":credits", $userarray['credits'], PDO::PARAM_STR);
	$stmt->bindParam(":group", $userarray['group'], PDO::PARAM_INT);
	$stmt->bindParam(":first_name", $userarray['first_name'], PDO::PARAM_STR);
	$stmt->bindParam(":last_name", $userarray['last_name'], PDO::PARAM_STR);
	$stmt->bindParam(":address", $userarray['address'], PDO::PARAM_STR);
	$stmt->bindParam(":suburb", $userarray['suburb'], PDO::PARAM_STR);
	$stmt->bindParam(":state", $userarray['state'], PDO::PARAM_STR);
	$stmt->bindParam(":country", $userarray['country'], PDO::PARAM_STR);
	$stmt->bindParam(":postcode", $userarray['postcode'], PDO::PARAM_STR);
	$stmt->bindParam(":home_phone", $userarray['home_phone'], PDO::PARAM_STR);
	$stmt->bindParam(":mobile_phone", $userarray['mobile_phone'], PDO::PARAM_STR);
	$stmt->bindParam(":password1", $userarray['password'], PDO::PARAM_STR);
	$stmt->bindParam(":password2", $userarray['password'], PDO::PARAM_STR);
	$stmt->bindParam(":username", $userarray['username'], PDO::PARAM_STR);
	$stmt->execute();
}

// This function searches the user database
// So admins can edit them
// Make sure to return at MAX 50 results to prevent overload
function admin_useredit_searchUsers($query)
{
	global $db_handle;
	$query = "%".$query."%";
	$stmt = $db_handle->prepare("SELECT username, first_name, last_name, email FROM tea_users WHERE username LIKE ? OR email LIKE ? OR first_name LIKE ? OR last_name LIKE ? LIMIT 50");
	$stmt->bindParam(1, $query, PDO::PARAM_STR);
	$stmt->bindParam(2, $query, PDO::PARAM_STR);
	$stmt->bindParam(3, $query, PDO::PARAM_STR);
	$stmt->bindParam(4, $query, PDO::PARAM_STR);
	$stmt->execute();
	$searchresults = $stmt->fetchall(PDO::FETCH_ASSOC);
	return $searchresults;
}

?>