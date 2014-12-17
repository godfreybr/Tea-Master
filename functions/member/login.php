<?php

// Compare submitted password with stored encrypted password
function login_encryptPassword($plainpassword,$DBhash)
{
	if(TEA_ENCRYPTION_METHOD==1)
	{
		// PASSWORD FUNCTIONS
		if (password_verify($plainpassword, $DBhash)) { return true; } else { return false; }
	} else {
		// CRYPT FUNCTIONS
		if (crypt($plainpassword, $DBhash) == $DBhash) { return true; } else { return false; }
	}
}

// This function will get the users password
function login_getUserPasswordID($email)
{
	// Access global handle
	global $db_handle;

	try
	{
		// Prepare the statement
		$stmt = $db_handle->prepare("SELECT id, password FROM ".TEA_DB_PREFIX."users WHERE email=? LIMIT 1");
		// Bind the page parameter
		$stmt->bindParam(1, $email, PDO::PARAM_STR,12);
		// Execute the query
		$stmt->execute();
		// Fetch the results
		$password = $stmt->fetch(PDO::FETCH_ASSOC);
		// Return the array
		/*if(sizeof($password)==1)
		{ return $password; }
		else
		{ return false; }
		*/
		return $password;
	}
	// Catch any errors
	catch(PDOException $e)
	{
    	if(TEA_DEBUG_ENABLE==1)
		{
			echo $e->getMessage();
		} else {
			error_out("logins");
		}
    }
}

// This function will return a randomised string
// This is used for making session IDs
function login_makeSessionString()
{
	// Get current timestamp
	$cTimestamp = time();
	// Make some random numbers
	$randomStrings = mt_rand(50000,100000).mt_rand(50000,100000).mt_rand(50000,100000).mt_rand(50000,100000);
	// Put together everything
	$newSession = $cTimestamp * ($cTimestamp . $randomStrings);
	// Encrypt the random session
	$newSession = controller_encryptString($newSession);
	return $newSession;
}

function login_establishLoginSession($userid,$sessionkey,$expiry)
{
	// Add session to database
	// Access global handle
	global $db_handle;
	
	// Convert timestamp to MySQL timestamp
	$expirySQL = date('Y-m-d G:i:s',$expiry);
	
	try {
		$stmt = $db_handle->prepare("INSERT INTO ".TEA_DB_PREFIX."sessions (user_id,session_key,expiry) VALUES (:id,:session,:expiry)");
		$stmt->execute(array(
							':id'			=> $userid,
							':session'		=> $sessionkey,
							':expiry'		=> $expirySQL
							));
	}
	catch(PDOException $e)
	{
    	if(TEA_DEBUG_ENABLE==1)
		{
			echo $e->getMessage();
		} else {
			error_out("logins");
		}
    }
	
	// Set session cookie
	setcookie(TEA_DB_PREFIX."sessionid", $sessionkey, $expiry, "/");

	$affected_rows = $stmt->rowCount();
	if($affected_rows==1)
	{ return true; }
	else
	{ return false; }
}

function login_doLogin($username,$password,$rememberme)
{
	// Get the users ID & password
	$userDetails = login_getUserPasswordID($username);
	if($userDetails!=false)
	{
		// Compare the passwords and check if they match
		$passwordsMatch = login_encryptPassword($password,$userDetails['password']);
		// If the user supplied the correct password
		// Start doing the login magic
		if($passwordsMatch)
		{
			// Set the expiry timer
			// If users selected remember me, make the expiry longer
			if($rememberme==1)
			{ $expiry = time()+(86400 * 30); }
			else
			{ $expiry = time()+86400; }
			
			// Generate a session string
			$session = login_makeSessionString();
			
			// Create the session
			$sessionstatus = login_establishLoginSession($userDetails['id'],$session,$expiry);
			
			return $sessionstatus;
			
		} else {
			return false;
		}
	} else {
		return false;
	}
}

// Post all variables
$loginForm['email'] = $_POST['login_email'];
$loginForm['password'] = $_POST['login_password'];
$loginForm['rememberme'] = $_POST['login_rememberme'];


if(isset($loginForm['email']))
{
	$loginStatus = login_doLogin($loginForm['email'],$loginForm['password'],$loginForm['rememberme']);
}

if($loginStatus==false && isset($loginForm['email']))
{
	echo "Login fail";
}

?>

<div class="content_container_div">
	<form action="index.php?page=login" method="post" id="login" title="Login">
		<table align="center">
			<tr>
				<th>Email:</th>
				<td><input name="login_email" type="email" required id="login_email" placeholder="Email" title="Email"></td>
			</tr>
			<tr>
				<th>Password:</th>
				<td><input name="login_password" type="password" required id="login_password" form="login" placeholder="Password" title="Password"></td>
			</tr>
			<tr>
				<th>Remember Me:</th>
				<td><input name="login_rememberme" type="checkbox" id="login_rememberme" form="login" title="Remember Me" value="1"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input name="login_submit" type="submit" id="login_submit" title="Login" value="Login"></td>
			</tr>
		</table>
	</form>
</div>