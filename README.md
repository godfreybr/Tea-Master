Tea-Master
==========

Tea Master is a virtual game store made for a university assignment. The original idea was to pair my games development class with my web design class.
However the games unit assignment requirements prevented this so the game itself was never created. The store however proceeded as planned.
It was designed to be a virtual store where players can purchase credits with real money, and then use those credits to purchase items for the game.
Functionality wise it mostly works, there are a lot of potential issues and little quirks with it however. There's also very little validation going on.

I wanted the whole application to be platform independent and modular as possible. With time not no my side however, I could not properly plan this out.

Notes
=========

This store IS buggy and is only meant for display purposes.

The store database backend is coded using PDOs and as such can support numerous database engines, however support for anything but MySQL is untested.

Update: PHP 7.3 throws some warnings but everything still appears to be fully functional despite the major differences between PHP 5.5 & PHP 7.x.

Requirements
==========

* PHP 5.5 or above (PHP 5.4 capable but not recommended)
* Apache or IIS Server
* MySQL Server

Installation
==========

An installer was planned but never implemented, setup must be done manually.

	1. Download to web server
	2. Import schema.sql to a 'MySQL' server
	3. Edit database credentials in ./config.php
	4. (Optional) If using PHP 5.4 or below, set TEA_ENCRYPTION_METHOD to 0
	5. Login with admin@example.com & Password1
