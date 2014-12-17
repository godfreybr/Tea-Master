<?php

// This function uses MCrypt to generate a random salt for users passwords
// Turns out it does not need to be used... ANYWHERE
// So I'm leaving this here incase there's a shortage of 'NaCl'
function member_register_generateSalt()
{
	$size = mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CFB);
    $iv = mcrypt_create_iv($size, MCRYPT_DEV_RANDOM);
	return $iv;
}

// Do validation checks, make sure Javascript hit everything
function member_registration_validation($registerArray)
{
	
	// Check email
	if(!filter_var($registerArray['email'], FILTER_VALIDATE_EMAIL))
	{
		$invalid['email'] = 1;
	}
	
	// Check Username
	if(strlen($registerArray['username'])<4)
	{
		$invalid['username'] = 1;
	}
	
	// Make sure passwords match
	if($registerArray['password']!=$registerArray['password_confirm'])
	{
		$invalid['password'] = 1;
	}
	
	// Make sure password is long enough
	if(strlen($registerArray['password']) < 6)
	{
		$invalid['password'] = 1;
	}
	
	return $invalid;
	
}

// This function creates a member in the database
// It then returns affected rows for success/failure
function member_register_insertUser($registerArray)
{
	// Access global handle
	global $db_handle;
	
	try {
		$stmt = $db_handle->prepare("INSERT INTO ".TEA_DB_PREFIX."users (username,
														email,
														password,
														first_name,
														last_name,
														address,
														suburb,
														state,
														country,
														postcode,
														home_phone,
														mobile_phone)
												VALUES (:username,
														:email,
														:password,
														:first_name,
														:last_name,
														:address,
														:suburb,
														:state,
														:country,
														:postcode,
														:home_phone,
														:mobile_phone)");
		$stmt->execute(array(
							':username'			=> $registerArray['username'],
							':email'			=> $registerArray['email'],
							':password'			=> $registerArray['password'],
							':first_name'		=> $registerArray['first_name'],
							':last_name'		=> $registerArray['last_name'],
							':address'			=> $registerArray['address'],
							':suburb'			=> $registerArray['suburb'],
							':state'			=> $registerArray['state'],
							':country'			=> $registerArray['country'],
							':postcode'			=> $registerArray['postcode'],
							':home_phone'		=> $registerArray['home_phone'],
							':mobile_phone'		=> $registerArray['mobile_phone']
							));
		$affected_rows = $stmt->rowCount();
		return $affected_rows;
	}
	catch(PDOException $e)
	{
    	if(TEA_DEBUG_ENABLE==1)
		{
			echo $e->getMessage();
		} else {
			error_out("registration");
		}
    }
}

// Post all the registration details to an array
$registerUserData['username'] = $_POST['register_username'];
$registerUserData['email'] = $_POST['register_email'];
$registerUserData['password'] = $_POST['register_password'];
$registerUserData['password_confirm'] = $_POST['register_password_confirm'];

$registerUserData['first_name'] = $_POST['register_firstname'];
$registerUserData['last_name'] = $_POST['register_lastname'];

$registerUserData['address'] = $_POST['register_address'];
$registerUserData['suburb'] = $_POST['register_suburb'];
$registerUserData['state'] = $_POST['register_state'];
$registerUserData['country'] = $_POST['register_country'];
$registerUserData['postcode'] = $_POST['register_postcode'];
$registerUserData['home_phone'] = $_POST['register_hphone'];
$registerUserData['mobile_phone'] = $_POST['register_mphone'];
$registerUserData['tos'] = $_POST['register_tos'];

// Validate all the posted material
// Make sure we're not posting junk
if($registerUserData['tos'] == 1)
{
	$registerUserChecks = member_registration_validation($registerUserData);
}

// Register the user if we pass the validation & ToS is checked
if($registerUserData['tos'] == 1 && count($registerUserChecks) == 0)
{
	$registerUserData['password'] = controller_encryptString($registerUserData['password']);
	$registrationSuccess = member_register_insertUser($registerUserData);
}

?>

<div class="content_container_div">
<?php

// Hide the registration form if there was a successful registration
if($registrationSuccess!=1) {
	
?>
	<form action="index.php?page=register" method="post" id="register" title="Register" onSubmit="return validation_validateform('register_');">
		<table align="center" id="registration_form">

			<?php
			// If there were errors in the registration, inform the user
			if(count($registerUserChecks) > 0) { ?>
			<tr>
				<th colspan="2" style="color:red;">Please fill in registration correctly.</th>
			</tr>
			<?php } ?>

			<?php
			// If no changes to database were done, maybe user exists
			if($registrationSuccess==0 && $registerUserData['tos'] == 1)
			{ ?>
			<tr>
				<th colspan="2" style="color:red;">Registration failed, a user may already exist with specified email or username.</th>
			</tr>
			<?php } ?>

			<tr>
				<th colspan="2">Account</th>
			</tr>
			<tr>
				<th align="right">Username:</th>
				<td><input name="register_username" type="text" required id="register_username" form="register" placeholder="Username" title="Username" value="<?php echo $registerUserData['username']; ?>"> <?php if($registerUserChecks['username']==1) { echo "Username must be at least 4 characters"; } ?></td>
			</tr>
			<tr>
				<th align="right">Email:</th>
				<td><input name="register_email" type="email" required id="login_email" form="register" placeholder="Email" title="Email" value="<?php echo $registerUserData['email']; ?>"> <?php if($registerUserChecks['email']==1) { echo "Email is invalid"; } ?></td>
			</tr>
			<tr>
				<th align="right">Password:</th>
				<td><input name="register_password" type="password" required id="register_password" form="register" placeholder="Password" pattern=".{8,}" title="Password"> <?php if($registerUserChecks['password']==1) { echo "Passwords must match and be longer than 7 characters"; } ?></td>
			</tr>
			<tr>
				<th align="right">Confirm Password:</th>
				<td><input name="register_password_confirm" type="password" required id="register_password_confirm" form="register" placeholder="Confirm Password" pattern=".{8,}" title="Confirm Password"> <?php if($registerUserChecks['password']==1) { echo "Passwords must match and be longer than 7 characters"; } ?></td>
			</tr>
			<tr>
				<th colspan="2">Personal Details</th>
			</tr>
			<tr>
				<th align="right">First Name:</th>
				<td><input name="register_firstname" type="text" id="register_firstname" form="register" placeholder="First Name" title="First Name" value="<?php echo $registerUserData['first_name']; ?>"></td>
			</tr>
			<tr>
				<th align="right">Last Name:</th>
				<td><input name="register_lastname" type="text" id="register_lastname" form="register" placeholder="Last Name" title="Last Name" value="<?php echo $registerUserData['last_name']; ?>"></td>
			</tr>
			<tr>
				<th align="right">Address:</th>
				<td><input name="register_address" type="text" id="register_address" form="register" placeholder="Address" title="Address" value="<?php echo $registerUserData['address']; ?>"></td>
			</tr>
			<tr>
				<th align="right">Suburb:</th>
				<td><input name="register_suburb" type="text" id="register_suburb" form="register" placeholder="Suburb" title="Suburb" value="<?php echo $registerUserData['suburb']; ?>"></td>
			</tr>
			<tr>
				<th align="right">State:</th>
				<td><input name="register_state" type="text" id="register_state" form="register" placeholder="State" title="State" value="<?php echo $registerUserData['state']; ?>"></td>
			</tr>
			<tr>
				<th align="right">Country:</th>
				<td><input name="register_country" type="text" id="register_country" form="register" placeholder="Country" title="Country" value="<?php echo $registerUserData['country']; ?>"></td>
			</tr>
			<tr>
				<th align="right">Postcode:</th>
				<td><input name="register_postcode" type="text" id="register_postcode" form="register" placeholder="Postcode" pattern="[0-9]{4,5}" title="Postcode" value="<?php echo $registerUserData['postcode']; ?>" maxlength="5"></td>
			</tr>
			<tr>
				<th align="right">Home Phone:</th>
				<td><input name="register_hphone" type="text" id="register_hphone" form="register" placeholder="Home Phone" pattern="[0-9]{8}" title="Home Phone" value="<?php echo $registerUserData['home_phone']; ?>" maxlength="8"></td>
			</tr>
			<tr>
				<th align="right">Mobile Phone:</th>
				<td><input name="register_mphone" type="text" id="register_mphone" form="register" placeholder="Mobile Phone" pattern="[0-9]{10}" title="Mobile Phone" value="<?php echo $registerUserData['mobile_phone']; ?>" maxlength="10"></td>
			</tr>
			<tr>
				<th align="right">Accept ToS:</th>
				<td><input name="register_tos" type="checkbox" required="required" id="register_tos" form="register" title="Accept ToS" value="1"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input name="register_submit" type="submit" id="register_submit" form="register" title="Register" value="Register"></td>
			</tr>
		</table>
	</form>
	<?php } else { ?>
	<p>Registration successful, you may now login.</p>
	<?php } ?>
</div>
