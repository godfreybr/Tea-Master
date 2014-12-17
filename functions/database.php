<?php
//TEA_DB_TYPE
// Initiate database connection
function database_connect()
{
	try
	{
		// Create PDO connect query
		if(TEA_DB_TYPE=="mysql")
		{
			$pdoConnector = 'mysql:host='.TEA_DB_SERVER.';dbname='.TEA_DB_DATABASE.';charset=utf8';
		} else {
			die("INVALID DATABASE TYPE");
		}
		// Open PDO connection to database
		$db_handle = new PDO($pdoConnector, TEA_DB_USERNAME, TEA_DB_PASSWORD);
		
		// Turn off prepare emulation & go into exception mode
		$db_handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db_handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// Return the handle
		return $db_handle;
	}
	// Catch any errors
	catch(PDOException $e)
	{
    	if(TEA_DEBUG_ENABLE==1)
		{
			echo $e->getMessage();
		} else {
			error_out("database");
		}
    }

}

// Return an array with all navigation data
function database_getcontent_navigation()
{
	// Access global handle
	global $db_handle;

	try
	{
		// Prepare the statement
		$stmt = $db_handle->prepare("SELECT title,title_full FROM ".TEA_DB_PREFIX."pages WHERE hidden=0 AND admin_only=0");
		// Execute the query
		$stmt->execute();
		// Fetch the results
		$fullnavigation = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Return the array
		return $fullnavigation;
	}
	// Catch any errors
	catch(PDOException $e)
	{
    	if(TEA_DEBUG_ENABLE==1)
		{
			echo $e->getMessage();
		} else {
			error_out("database");
		}
    }
}

function database_getcontent_pagecontent($pageid)
{
	// Access global handle
	global $db_handle;

	try
	{
		// Prepare the statement
		$stmt = $db_handle->prepare("SELECT content,link_only,admin_only FROM ".TEA_DB_PREFIX."pages WHERE title=:page LIMIT 1");
		// Bind the page parameter
		$stmt->bindParam(':page', $pageid, PDO::PARAM_STR,12);
		// Execute the query
		$stmt->execute();
		// Fetch the results
		$fullcontent = $stmt->fetch(PDO::FETCH_ASSOC);
		// Return the array
		return $fullcontent;
	}
	// Catch any errors
	catch(PDOException $e)
	{
    	if(TEA_DEBUG_ENABLE==1)
		{
			echo $e->getMessage();
		} else {
			error_out("database");
		}
    }
}

// Close connection to database
function database_close()
{
	// Access global handle
	global $db_handle;

	// Close database connection
	$db_handle = null;
}

?>