<?php if(!is_array(@$object)) { http_response_code(404); exit(); }
	/* 
		 _           ___ _     _   _____ _____ _____ 
		| |_ _ _ ___|  _|_|___| |_|     |     |   __|
		| . | | | . |  _| |_ -|   |   --| | | |__   |
		|___|___|_  |_| |_|___|_|_|_____|_|_|_|_____|
				|___|                                
		Copyright (C) 2024 Jan Maurice Dahlmanns [Bugfish]

		This program is free software: you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation, either version 3 of the License, or
		(at your option) any later version.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.
		
		File Description:
			Rulset for specific CMS Settings. With this file you can change 
			some primary CMS functionalities like site module determination.
			Rename the file to cfg_ruleset.php after making changes to activate it.
	*/

	##############################################################################################
	// File Purpose and Usage
	##############################################################################################

		// This file defines specific rules and settings for the CMS.
		// These settings can also be managed via the CMS administrator interface.
		// Only developers or advanced users should edit this file directly.
		// To activate this file, rename it to `cfg_ruleset.php`.

	##############################################################################################
	// Initial Setup for Site Modules
	##############################################################################################

		// **Parallel Site Module Switching**:
		// - Allows admin to switch between site modules (e.g., from frontend to admin panel).
		// - Recommended to set to `false` for standalone site modules.
		// - Default admin module: `_administrator`.
		// Uncomment and adjust the following line to use:
		// define('_HIVE_ADMIN_SITE_', "_administrator");
	
		// **Default Site Module**:
		// - The default site module to load if no other is specified.
		// - Default value: `_administrator` (can be changed).
		// Uncomment and adjust the following line to use:
		// $hive_mode_default = "_administrator";

	##############################################################################################
	// Environment Variable Override for Site Mode
	##############################################################################################

		// **Site Mode Override via Environment Variable**:
		// - Allows overriding the default site mode by setting an environment variable in the Apache vhost.
		// - Useful for deploying different sites using the same codebase but with different configurations.
		// - Example in Apache config: `SetEnv _HIVE_MODE_ENV_OVR_ "MODULENAME"`
		// - The specified module name in the environment variable will take precedence over other settings.
		// - This feature is optional and only used if defined in the server environment.

	##############################################################################################
	// Installer Settings
	##############################################################################################

		// **Installer Window Title**:
		// - Title displayed during CMS installation.
		// - Default value: "bugfishCMS".
		// Uncomment and adjust the following line to use:
		// define("_INSTALLER_TITLE_", "bugfishCMS");
		
		// **Cookie and Session Prefix**:
		// - Default prefix for cookies and sessions during installation.
		// - Default value: `bcms_` (max 5 characters, no special chars).
		// Uncomment and adjust the following line to use:
		// define("_INSTALLER_COOKIE_", "bcms_");
		
		// **Database Table Prefix**:
		// - Default prefix for database tables during installation.
		// - Default value: `hive_` (max 5 characters, no special chars).
		// Uncomment and adjust the following line to use:
		// define("_INSTALLER_PREFIX_", "bcms_");
	
		// **Installation Password**:
		// - Option to require a password during installation.
		// - Default value: `false` (no password required).
		// Uncomment and adjust the following line to use:
		// define("_INSTALLER_CODE_", false);

	##############################################################################################
	// Store Functionality
	##############################################################################################

		// **Custom Store Server**:
		// - Option to define a custom server for updates and store functions in an array.
		// - Multiple Values are possible.
		// - Default store URL: `https://store.bugfish.eu`.
		// - Advanced users can specify their own server.
		// Uncomment and adjust the following line to use:
		// define("_HIVE_SERVER_", array("https://STOREURL"));
		
		// **Core Update Server**:
		// - URL for automatic core updates. It is recommended to leave the default.
		// - Default value: `https://store.bugfish.eu`.
		// Uncomment and adjust the following line to use:
		// define("_HIVE_SERVER_CORE_", "https://COREUPDATEURL");

	##############################################################################################
	// Session Cookie Domain Settings
	##############################################################################################

		// **Session Cookie Domain**:
		// - Set the domain for PHP session cookies.
		// - Leave undefined to use the default domain.
		// Uncomment and adjust the following line to use:
		// define("_HIVE_COOKIE_DOMAIN_", ".example.domain");

	##############################################################################################
	// Developer Settings
	##############################################################################################

		// **Updating only over Administrator Interface?**:
		// - If this is set to true, the updater script wont work on visitors or at the modules frontpage
		//   You can than only update a module over the administrator interface.
		// - If set to false, the updater on the site modules frontpage will be visible to update the page.
		// - Default value: `true`.
		// Uncomment and adjust the following line to use:
		// define('_HIVE_RESTRICT_UPDATE_', false); 
		
		// **Allow Developer Mode**:
		// - Enable the use of `/developer.php` for advanced debugging.
		// - Default value: `false`.
		// Uncomment and adjust the following line to use:
		// define('_HIVE_MOD_CHANGES_', true); 

		// **Token-Based Switches**:
		// - Allows the use of token-based switches via `_core/_action/token_switch.php`.
		// - Default value: `true`.
		// Uncomment and adjust the following line to use:
		// define('_HIVE_ALLOW_TOKEN_', true);

		// **PHP Logfile Location**:
		// - Set a custom PHP logfile location. Default is to use the web server's default.
		// - Default value: `false`.
		// Uncomment and adjust the following line to use:
		// define('_HIVE_PHP_LOG_PATH_', false);

		// **PHP Errors on Initialization**:
		// - Enable PHP error reporting during initialization for debugging purposes.
		// - Default value: `0` (errors are hidden).
		// Uncomment and adjust the following line to use:
		// define('_HIVE_PHP_DISPLAY_ERROR_ON_START_', 1);

	##############################################################################################
	// Experimental Settings - Not for Productive Environments!
	##############################################################################################
		
		// **Force Site Mode**:
		// - Force the CMS to run in a specific site mode, disabling module switching.
		// - Default value: `false`.
		// Uncomment and adjust the following line to use:
		// $hive_mode_override = "_administrator";

		// **Allowed Site Modules**:
		// - Restrict the CMS to only allow certain site modules.
		// - Default value: `false`.
		// Uncomment and adjust the following line to use:
		// $hive_mode_array = array("modname1", "modname2", "modname3");
	
		// **Automatic Site Mode by URL**:
		// - Enables automatic selection of a site module based on the requested URL.
		// - Default value: `false` (disables this feature).
		// - Example configuration: 
		//   `array(array("url" => "x.domain", "mode" => "xdomainmod"), ...)`
		// Uncomment and adjust the following line to use:
		// define("_HIVE_MOD_FETCH_", false);