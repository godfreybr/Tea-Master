<?php

// This function will encrypt a plain password
// Depending on the configuration it will either use
// password_hash which is new in PHP5.5
// or
// crypt() which is more compatible with older versions
// password_hash is preferred due to slower algorithm
function controller_encryptString($plainPassword)
{
	if(TEA_ENCRYPTION_METHOD==1)
	{
		return password_hash($plainPassword, PASSWORD_DEFAULT);
	} else {
		return crypt($plainPassword);
	}
}

// This function logs the user out
function controller_logout()
{
	setcookie(TEA_DB_PREFIX."sessionid", '', time() - 3600);
}

// Check if user is logged in
// If they are logged in, return an array of details
// If not, return null
function controller_isLoggedIn()
{
	// Access global handle
	global $db_handle;

	// Get the session cookie
	$usersession = $_COOKIE[TEA_DB_PREFIX."sessionid"];
	
	// IF a cookie exists
	if(isset($usersession))
	{
		// Check the database
		try
		{
			// Find a user ID assosiated with the session key
			// Make sure the key hasn't expired
			$stmt = $db_handle->prepare("SELECT user_id FROM ".TEA_DB_PREFIX."sessions WHERE session_key=? AND expiry>CURRENT_TIMESTAMP() LIMIT 1");
			$stmt->bindParam(1, $usersession, PDO::PARAM_STR,12);
			$stmt->execute();
			$memberID = $stmt->fetch(PDO::FETCH_ASSOC);

			// If a member is found, fetch all their details & return it as an array
			// To make life easier, we join their group permissions in that array too.
			// Otherwise return null
			if(sizeof($memberID)==1)
			{
				$stmt2 = $db_handle->prepare("SELECT ".TEA_DB_PREFIX."users.`id`, ".TEA_DB_PREFIX."users.`username`, ".TEA_DB_PREFIX."users.`group`, ".TEA_DB_PREFIX."users.`credits`, ".TEA_DB_PREFIX."users.`email`, ".TEA_DB_PREFIX."users.`first_name`, ".TEA_DB_PREFIX."users.`last_name`, ".TEA_DB_PREFIX."users.`address`, ".TEA_DB_PREFIX."users.`suburb`, ".TEA_DB_PREFIX."users.`state`, ".TEA_DB_PREFIX."users.`country`, ".TEA_DB_PREFIX."users.`postcode`, ".TEA_DB_PREFIX."users.`home_phone`, ".TEA_DB_PREFIX."users.`mobile_phone`, ".TEA_DB_PREFIX."user_groups.`id` AS group_id, ".TEA_DB_PREFIX."user_groups.`group_name`, ".TEA_DB_PREFIX."user_groups.`is_admin`, ".TEA_DB_PREFIX."user_groups.`is_mod`, ".TEA_DB_PREFIX."user_groups.`is_manifest`, ".TEA_DB_PREFIX."user_groups.`is_support`
					FROM ".TEA_DB_PREFIX."users
					INNER JOIN ".TEA_DB_PREFIX."user_groups
					ON ".TEA_DB_PREFIX."users.`group`=".TEA_DB_PREFIX."user_groups.id
					WHERE ".TEA_DB_PREFIX."users.id=:userid
					LIMIT 1");
				$stmt2->bindParam(':userid', $memberID['user_id'], PDO::PARAM_STR,12);
				$stmt2->execute();
				$fullmember = $stmt2->fetch(PDO::FETCH_ASSOC);
				return $fullmember;
			} else {
				return NULL;
			}
		}
		// Catch any errors
		catch(PDOException $e)
		{
			if(TEA_DEBUG_ENABLE==1)
			{
				echo $e->getMessage();
			} else {
				error_out("member controller");
			}
		}
	// If the cookie is not set
	// Just return null
	} else {
		return NULL;
	}
}

?>