<?php

if(TEA_DEBUG_ENABLE==1)
{
	ini_set('display_errors', 1);
	error_reporting(E_ALL ^ E_NOTICE);
}

function error_out($errorCode)
{
	$errorPage = "<html><head><title>PAGE MALFUNCTION</title></head><body><center><h1>We're sorry</h1><p>We're sorry but we have encounted an error.</p><p>It appears to be '".$errorCode."' related.</p></center></body></html>";
	die($errorPage);
}

?>