// Registration form validation
// This module validates the entire registration system
// For use in browsers that don't support HTML5 form validation

// Check to ensure an email looks like an email
function validation_validateEmail(email)
{
	var atpos	= email.indexOf("@");
	var dotpos	= email.lastIndexOf(".");
	if (dotpos < atpos + 2 || dotpos + 2 >= email.length || atpos < 1)
	{
		return false;
	} else {
		return true;
	}
}

// Check if the passwords match
function validation_validatePassword(password1,password2)
{
	if(password1==password2)
	{
		return true;
	} else {
		return false;
	}
}

// Make sure the password is long enough
function validation_validatePasswordLength(password)
{
	if(password.length > 7)
	{
		return true;
	} else {
		return false;
	}
}

// Make sure the username isn't garbage or empty
function validation_validateUsername(username)
{
	
	if(username.length>4)
	{
		return true;
	} else {
		return false;
	}
	
}

function validation_validateform(prefix)
{
	var infractionCount=0;
	
	// Validate Username
	var username=document.getElementById(prefix+"username").value;
	if(validation_validateUsername(username) == false)
	{ infractionCount++; }
	
	// Validate Email
	var email=document.getElementById(prefix+"email").value;
	if(validation_validateEmail(email) == false)
	{ infractionCount++; }
		
	// Validate Passwords
	var password1=document.getElementById(prefix+"password").value;
	var password2=document.getElementById(prefix+"password_confirm").value;
	if(validation_validatePassword(password1,password2) == false)
	{ infractionCount++; }
	
	if(prefix=="registration_")
	{
		if(validation_validatePasswordLength(password1) == false)
		{ infractionCount++; }
	} else {
		if(password1 > 0 && validation_validatePasswordLength(password1) == false)
		{ infractionCount++; }
	}
	
	// Make sure ToS is selected
	if(prefix=="registration_")
	{ var tos=document.getElementById(prefix+"tos").value; }
	
	// If total infractions is zero, allow submission
	// Else stop it.
	if(infractionCount==0)
	{
		return true;
	} else {
		return false;
	}
}