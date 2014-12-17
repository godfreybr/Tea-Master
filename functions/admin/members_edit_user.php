<?php

// Update the users details
		$l_updatedUserInfo['username'] = $_POST['useredit_username'];
		$l_updatedUserInfo['email'] = $_POST['useredit_email'];
		$l_updatedUserInfo['password'] = $_POST['useredit_password'];
		$l_updatedUserInfo['credits'] = $_POST['useredit_credits'];
		$l_updatedUserInfo['group'] = $_POST['useredit_group'];
		$l_updatedUserInfo['first_name'] = $_POST['useredit_firstname'];
		$l_updatedUserInfo['last_name'] = $_POST['useredit_lastname'];
		$l_updatedUserInfo['address'] = $_POST['useredit_address'];
		$l_updatedUserInfo['suburb'] = $_POST['useredit_suburb'];
		$l_updatedUserInfo['state'] = $_POST['useredit_state'];
		$l_updatedUserInfo['country'] = $_POST['useredit_country'];
		$l_updatedUserInfo['postcode'] = $_POST['useredit_postcode'];
		$l_updatedUserInfo['home_phone'] = $_POST['useredit_homephone'];
		$l_updatedUserInfo['mobile_phone'] = $_POST['useredit_mobilephone'];
		
		if($l_updatedUserInfo['username']!="")
		{
			admin_useredit_setUserDetails($l_updatedUserInfo);
			echo '<p>User Updated</p>';
		}
		
		// Get the users details
		$l_UserEditDetails = admin_useredit_getUserDetails($l_edituser);
		?>
	<div class="content_container_div">
		<form action="index.php?page=admin&adminpage=edituser&user=<?php echo $l_edituser; ?>" method="post">
			<table width="100%">
				<tr>
					<th colspan="2">Account</th>
				</tr>
				<tr>
					<th align="right">Username:</th>
					<td><input name="useredit_username" type="text" required id="useredit_username" placeholder="Username" title="Username" value="<?php echo $l_UserEditDetails['username']; ?>" readonly></td>
				</tr>
				<tr>
					<th align="right">Email:</th>
					<td><input name="useredit_email" type="text" required id="useredit_email" placeholder="Email" title="Email" value="<?php echo $l_UserEditDetails['email']; ?>"></td>
				</tr>
				<tr>
					<th align="right">Password:</th>
					<td><input name="useredit_password" type="password" id="useredit_password" placeholder="Password" title="Password">
						<i>Leave blank for unchanged</i></td>
				</tr>
				<tr>
					<th align="right">Credits:</th>
					<td><input name="useredit_credits" type="number" id="useredit_credits" placeholder="Credits" min="0" title="Credits" value="<?php echo $l_UserEditDetails['credits']; ?>"></td>
				</tr>
				<tr>
					<th align="right">Group:</th>
					<td><select name="useredit_group" id="useredit_group">
							<option value="<?php echo $l_UserEditDetails['group']; ?>" selected="selected"><?php echo $l_UserEditDetails['group_name']; ?> (Current)</option>
							<?php
							$l_userGroups = admin_useredit_getGroups();
							foreach ($l_userGroups as $l_userGroup)
							{
								echo '<option value="'.$l_userGroup['id'].'">'.$l_userGroup['group_name'].'</option>';
							}
							?>
						</select></td>
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