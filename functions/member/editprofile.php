<?php

// Get all profile details for selected user
function member_editprofile_getDetails($id)
{
	global $db_handle;
	$stmt = $db_handle->prepare("SELECT * FROM ".TEA_DB_PREFIX."users WHERE id=?");
	$stmt->bindParam(1, $id, PDO::PARAM_STR,12);
	$stmt->execute();
	$searchresults = $stmt->fetch(PDO::FETCH_ASSOC);
	return $searchresults;
}

// Update the details for the selected user
function member_editprofile_updateDetails($id,$userarray)
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
	$stmt = $db_handle->prepare("UPDATE `".TEA_DB_PREFIX."users` SET `username`=:username, `email`=:email, `first_name`=:first_name, `last_name`=:last_name, `address`=:address, `suburb`=:suburb, `state`=:state, `country`=:country, `postcode`=:postcode, `home_phone`=:home_phone, `mobile_phone`=:mobile_phone, `password`=(CASE `password` WHEN :password1 IS NOT NULL THEN `password` ELSE :password2 END) WHERE `id`=:id");
	$stmt->bindParam(":username", $userarray['username'], PDO::PARAM_STR);
	$stmt->bindParam(":email", $userarray['email'], PDO::PARAM_STR);
	$stmt->bindParam(":first_name", $userarray['firstname'], PDO::PARAM_STR);
	$stmt->bindParam(":last_name", $userarray['lastname'], PDO::PARAM_STR);
	$stmt->bindParam(":address", $userarray['address'], PDO::PARAM_STR);
	$stmt->bindParam(":suburb", $userarray['suburb'], PDO::PARAM_STR);
	$stmt->bindParam(":state", $userarray['state'], PDO::PARAM_STR);
	$stmt->bindParam(":country", $userarray['country'], PDO::PARAM_STR);
	$stmt->bindParam(":postcode", $userarray['postcode'], PDO::PARAM_STR);
	$stmt->bindParam(":home_phone", $userarray['homephone'], PDO::PARAM_STR);
	$stmt->bindParam(":mobile_phone", $userarray['mobilephone'], PDO::PARAM_STR);
	$stmt->bindParam(":password1", $userarray['password'], PDO::PARAM_STR);
	$stmt->bindParam(":password2", $userarray['password'], PDO::PARAM_STR);
	$stmt->bindParam(":id", $id, PDO::PARAM_INT);
	$stmt->execute();
}

$postedVariableArray = array("username","email","password","firstname","lastname","address","suburb","state","postcode","country","homephone","mobilephone");
foreach($postedVariableArray as $postedVariableArrayItem)
{ $l_updatedUserInfo[$postedVariableArrayItem] = $_POST['useredit_'.$postedVariableArrayItem]; }

if($l_updatedUserInfo['username']!="")
{
	member_editprofile_updateDetails($LoggedInUser['id'],$l_updatedUserInfo);
}

$l_UserEditDetails = member_editprofile_getDetails($LoggedInUser['id']);

?>
<div class="content_container_div">
		<form action="index.php?page=editprofile" method="post" onSubmit="return validation_validateform('useredit_');">
			<table width="100%">
				<tr>
					<th colspan="2">Account</th>
				</tr>
				<tr>
					<th align="right">Username:</th>
					<td><input name="useredit_username" type="text" required id="useredit_username" placeholder="Username" title="Username" value="<?php echo $l_UserEditDetails['username']; ?>"></td>
				</tr>
				<tr>
					<th align="right">Email:</th>
					<td><input name="useredit_email" type="email" required id="useredit_email" placeholder="Email" title="Email" value="<?php echo $l_UserEditDetails['email']; ?>"></td>
				</tr>
				<tr>
					<th align="right">Password:</th>
					<td><input name="useredit_password" type="password" id="useredit_password" placeholder="Password" pattern=".{8,}" title="Password (Minimum 8 Characters)">
						<i>Leave blank for unchanged</i></td>
				</tr>
				<tr>
					<th align="right">Confirm Password:</th>
					<td><input name="useredit_password_confirm" type="password" id="useredit_password_confirm" placeholder="Confirm Password" pattern=".{8,}" title="Confirm Password (Minimum 8 Characters)">
						<i>Leave blank for unchanged</i></td>
				</tr>

				<tr>
					<th colspan="2">Personal</th>
				</tr>
				<tr>
					<th align="right">First Name:</th>
					<td><input name="useredit_firstname" type="text" id="useredit_firstname" placeholder="First Name" title="First Name" value="<?php echo $l_UserEditDetails['first_name']; ?>"></td>
				</tr>
				<tr>
					<th align="right">Last Name:</th>
					<td><input name="useredit_lastname" type="text" id="useredit_lastname" placeholder="Last Name" title="Last Name" value="<?php echo $l_UserEditDetails['last_name']; ?>"></td>
				</tr>
				<tr>
					<th align="right">Address:</th>
					<td><input name="useredit_address" type="text" id="useredit_address" placeholder="Address" title="Address" value="<?php echo $l_UserEditDetails['address']; ?>"></td>
				</tr>
				<tr>
					<th align="right">Suburb:</th>
					<td><input name="useredit_suburb" type="text" id="useredit_suburb" placeholder="Suburb" title="Suburb" value="<?php echo $l_UserEditDetails['suburb']; ?>"></td>
				</tr>
				<tr>
					<th align="right">State:</th>
					<td><input name="useredit_state" type="text" id="useredit_state" placeholder="State" title="State" value="<?php echo $l_UserEditDetails['state']; ?>"></td>
				</tr>
				<tr>
					<th align="right">Postcode:</th>
					<td><input name="useredit_postcode" type="text" id="useredit_postcode" placeholder="Postcode" title="Postcode" value="<?php echo $l_UserEditDetails['postcode']; ?>"></td>
				</tr>
				<tr>
					<th align="right">Country:</th>
					<td><input name="useredit_country" type="text" id="useredit_country" placeholder="Country" title="Country" value="<?php echo $l_UserEditDetails['country']; ?>"></td>
				</tr>
				<tr>
					<th align="right">Home Phone:</th>
					<td><input name="useredit_homephone" type="text" id="useredit_homephone" placeholder="Home Phone" pattern="[0-9]{8}" title="Home Phone" value="<?php echo $l_UserEditDetails['home_phone']; ?>" maxlength="8"></td>
				</tr>
				<tr>
					<th align="right">Mobile Phone:</th>
					<td><input name="useredit_mobilephone" type="text" id="useredit_mobilephone" placeholder="Mobile Phone" pattern="[0-9]{10}" title="Mobile Phone" value="<?php echo $l_UserEditDetails['mobile_phone']; ?>" maxlength="10"></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" title="Edit User" value="Edit"></td>
				</tr>
			</table>
		</form>
	</div>