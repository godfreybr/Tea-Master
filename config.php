<?php

// http://patorjk.com/software/taag/#p=display&f=Small&t=MySQL

// Make sure this file isn't directly accessed
if(constant('TEA_MAIN_INCLUDED')!=1) { die("No direct access"); }

/* 
  __  __      ___  ___  _    
 |  \/  |_  _/ __|/ _ \| |   
 | |\/| | || \__ \ (_) | |__ 
 |_|  |_|\_, |___/\__\_\____|
         |__/                
*/

// Define the database type (MySQLi, MSSQL)
define("TEA_DB_TYPE",			"mysql");
// Define database server (default: localhost)
define("TEA_DB_SERVER",			"mysql.lcars-systems.com");
// Define database server username
define("TEA_DB_USERNAME",		"teamaster");
// Define database server password
define("TEA_DB_PASSWORD",		"teamaster");
// Define database server database
define("TEA_DB_DATABASE",		"lcars_teamaster");
// Define database table prefix
define("TEA_DB_PREFIX",			"tea_");

/*
  ___  _            _           _        
 |   \(_)_ _ ___ __| |_ ___ _ _(_)___ ___
 | |) | | '_/ -_) _|  _/ _ \ '_| / -_|_-<
 |___/|_|_| \___\__|\__\___/_| |_\___/__/
                                         
*/

define("TEA_DIR_ROOT",			"");
define("TEA_DIR_IMAGES",		TEA_DIR_ROOT."images/");
define("TEA_DIR_SCRIPTS",		TEA_DIR_ROOT."scripts/");
define("TEA_DIR_CONFIGS",		TEA_DIR_ROOT."configs/");
define("TEA_DIR_FUNCTIONS",		TEA_DIR_ROOT."functions/");

/*
  ___                  _ _        
 / __| ___ __ _  _ _ _(_) |_ _  _ 
 \__ \/ -_) _| || | '_| |  _| || |
 |___/\___\__|\_,_|_| |_|\__|\_, |
                             |__/ 
*/

// Disable/Enable installer
define("TEA_INSTALLER_ENABLE",		0);

// Enable restricted subnet access for sensitive areas
// Must be valid CIDR address
define("TEA_SUBNET_ACCESS",			"0.0.0.0/0");

// Enable native password encryption
// Native password encryption uses the new Password Hash functions in PHP5.5 (RECOMMENDED)
// Legacy mode uses older more compatible methods

define("TEA_ENCRYPTION_METHOD",		1);

/*
  _                   _           
 | |   ___  __ _ __ _(_)_ _  __ _ 
 | |__/ _ \/ _` / _` | | ' \/ _` |
 |____\___/\__, \__, |_|_||_\__, |
           |___/|___/       |___/ 
*/

// Whether to enable the logging system
define("TEA_LOGGING_ENABLE",			1);
// Where to log the files (database,file,syslog)
define("TEA_LOGGING_TYPE",				"database");

// Log user activities
define("TEA_LOGGING_USER_ACTIVITIES",		0);
define("TEA_LOGGING_ADMIN_ACTIVITIES",		0);

/*
  ___      _                   _           
 |   \ ___| |__ _  _ __ _ __ _(_)_ _  __ _ 
 | |) / -_) '_ \ || / _` / _` | | ' \/ _` |
 |___/\___|_.__/\_,_\__, \__, |_|_||_\__, |
                    |___/|___/       |___/ 
*/

// Enable or disable debugging
define("TEA_DEBUG_ENABLE",		1);
// Set debugging level
define("TEA_DEBUG_LEVEL",		1);

/*

  __  __ _        
 |  \/  (_)___ __ 
 | |\/| | (_-</ _|
 |_|  |_|_/__/\__|
                  

*/

define("TEA_MAX_IMAGE_SIZE",		2000000);

?>