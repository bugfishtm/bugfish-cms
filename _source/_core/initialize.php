<?php
	/* 	 _           ___ _     _   _____ _____ _____ 
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

		You should have received a copy of the GNU General Public License
		along with this program.  If not, see <https://www.gnu.org/licenses/>.
		
		File Description:
			CMS Initialization File. This file will make all required validations, verifications
			and set all variables and constants as they are required. It also will include required library
			files and load extensions configuration and mysql files. MySQL Core and Site Module Files will
			be installed automatically if Table Name related to MySQL Init File Name does not exist.
			
	*/ if(!is_array($object)) { @http_response_code(503); echo "Startup Error - Please delete your settings.php file and re-install this instance..."; exit(); }	
	#################################################################################################################################################
	// Define Defaults
	#################################################################################################################################################
		define("_HIVE_CREATOR_", 'Powered by <a href="https://github.com/bugfishtm/bugfish-cms" rel="noopener" target="_blank">Bugfish CMS</a>!');
		
	#################################################################################################################################################
	// Includes and Requirements
	#################################################################################################################################################
		require_once($object["path"]."/_core/_framework/classes/x_class_2fa.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_api.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_benchmark.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_block.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_comment.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_crypt.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_csrf.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_curl.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_debug.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_eventbox.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_hitcounter.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_ipbl.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_lang.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_log.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_mail.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_mail_item.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_mail_phpmailer.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_mail_template.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_mysql.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_mysql_item.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_perm.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_perm_item.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_redis.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_referer.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_table.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_user.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_var.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_version.php");
		require_once($object["path"]."/_core/_framework/classes/x_class_zip.php");
		
	#################################################################################################################################################
	// Requirements of Framework Functionalities
	#################################################################################################################################################
		require_once($object["path"]."/_core/_framework/functions/x_button.php");
		require_once($object["path"]."/_core/_framework/functions/x_captcha.php");
		require_once($object["path"]."/_core/_framework/functions/x_cookiebanner.php");
		require_once($object["path"]."/_core/_framework/functions/x_curl.php");
		require_once($object["path"]."/_core/_framework/functions/x_eventbox.php");
		require_once($object["path"]."/_core/_framework/functions/x_library.php");
		require_once($object["path"]."/_core/_framework/functions/x_rss.php");
		require_once($object["path"]."/_core/_framework/functions/x_search.php");
		require_once($object["path"]."/_core/_framework/functions/x_table.php");		

	#################################################################################################################################################
	// Requirements of _core/_lib/*
	#################################################################################################################################################
		require_once($object["path"]."/_core/_lib/lib.hive.php");
		require_once($object["path"]."/_core/_lib/lib.simple.php");
		require_once($object["path"]."/_core/_lib/lib.volt.php");
		require_once($object["path"]."/_core/_lib/lib.windmill.php");
		require_once($object["path"]."/_core/_lib/lib.adminbsb.php");
		
	#################################################################################################################################################
	// Create Maybe lost System Folders
	#################################################################################################################################################
		hive__folder_create($object["path"]."/_data", true, false);
		hive__folder_create($object["path"]."/_disabled", true, true);
		hive__folder_create($object["path"]."/_disabled/_site", true, false);
		hive__folder_create($object["path"]."/_disabled/_script", true, false);
		hive__folder_create($object["path"]."/_disabled/_image", true, false);
		hive__folder_create($object["path"]."/_image", true, false);
		hive__folder_create($object["path"]."/_script", true, false);
		hive__folder_create($object["path"]."/_site", true, false);
		hive__folder_create($object["path"]."/_store", true, false);
		hive__folder_create($object["path"]."/_store/_tpl", true, true);
		hive__folder_create($object["path"]."/_store/_tpl/_docker", true, false);
		hive__folder_create($object["path"]."/_store/_tpl/_extension", true, false);
		hive__folder_create($object["path"]."/_store/_tpl/_image", true, false);
		hive__folder_create($object["path"]."/_store/_tpl/_script", true, false);
		hive__folder_create($object["path"]."/_store/_tpl/_site", true, false);
		hive__folder_create($object["path"]."/_store/_temp", true, true);
		hive__folder_create($object["path"]."/_store/_module", true, false);
		hive__folder_create($object["path"]."/_store/_module/_cache", true, false);
		hive__folder_create($object["path"]."/_store/_module/_changelog", true, false);
		hive__folder_create($object["path"]."/_store/_module/_image", true, false);
		hive__folder_create($object["path"]."/_store/_module/_release", true, false);
		hive__folder_create($object["path"]."/_store/_hub", true, false);
		hive__folder_create($object["path"]."/_store/_hub/_changelog", true, false);
		hive__folder_create($object["path"]."/_store/_hub/_download", true, false);
		hive__folder_create($object["path"]."/_store/_hub/_download/_cache", true, false);
		hive__folder_create($object["path"]."/_store/_hub/_download/_image", true, false);
		hive__folder_create($object["path"]."/_store/_hub/_download/_release", true, false);
		hive__folder_create($object["path"]."/_store/_hub/_download/_changelog", true, false);
		hive__folder_create($object["path"]."/_store/_hub/_release", true, false);
		hive__folder_create($object["path"]."/_store/_core", true, false);
		hive__folder_create($object["path"]."/_store/_core/_release", true, false);
		hive__folder_create($object["path"]."/_store/_core/_changelog", true, false);
		hive__folder_create($object["path"]."/_store/_app", true, false);
		hive__folder_create($object["path"]."/_store/_app/_release", true, false);
		hive__folder_create($object["path"]."/_store/_app/_changelog", true, false);
	
	#################################################################################################################################################
	// Define cfg_ruleset.php Setup
	#################################################################################################################################################
		if(file_exists(@$object["path"]."/cfg_ruleset.php")) 	{ require_once($object["path"]."/cfg_ruleset.php"); } 	
		// Array of Site Modes to Switch to and Force use only of them.
		if(!is_array(@$hive_mode_array)) 						{ $hive_mode_array = false; }
		// Set Override Switch
		if(!@$hive_mode_override) 								{ $hive_mode_override = false; }
		// Set default Hive Mode if not Set
		if(!@$hive_mode_default) 								{ $hive_mode_default = "_administrator"; }
		// Administrator Switch to Site Functionality
		if(!defined("_HIVE_ADMIN_SITE_")) 						{ define('_HIVE_ADMIN_SITE_', "_administrator");	 }
		// Set fetch Site modules by URL Array
		if(!defined("_HIVE_MOD_FETCH_")) 						{ define('_HIVE_MOD_FETCH_',   false); }
		// Set enable/disable for developer.php file on Start if not defined
		if(!defined("_HIVE_MOD_CHANGES_")) 						{ define('_HIVE_MOD_CHANGES_', false); }
		// Set enable/disable for _core/_action/token_switch.php file on Start if not defined
		if(!defined("_HIVE_ALLOW_TOKEN_")) 						{ define('_HIVE_ALLOW_TOKEN_', true);	 }
		// Set PHP Errors Log Path on Start if not defined
		if(!defined("_HIVE_PHP_LOG_PATH_")) 					{ define('_HIVE_PHP_LOG_PATH_', false); }
		// Set PHP Errors Output on Start if not defined
		if(!defined("_HIVE_PHP_DISPLAY_ERROR_ON_START_")) 		{ define('_HIVE_PHP_DISPLAY_ERROR_ON_START_', 0); }
		// Set Primary Store URL if not defined
		if(!defined("_HIVE_SERVER_")) 							{ define("_HIVE_SERVER_", array("https://store.bugfish.eu")); }
		// Set Primary Core Update URL if not defined
		if(!defined("_HIVE_SERVER_CORE_")) 						{ define("_HIVE_SERVER_CORE_", "https://store.bugfish.eu"); }
		// Set Cookie Domain if set in cfg_ruleset.php
		if(defined("_HIVE_COOKIE_DOMAIN_")) 					{ ini_set('session.cookie_domain', _HIVE_COOKIE_DOMAIN_); }	
		// Restrict Upgrade to Admin Interface on Default
		if(!defined("_HIVE_RESTRICT_UPDATE_")) 					{ define("_HIVE_RESTRICT_UPDATE_", true); }	
	
	#################################################################################################################################################
	// Error Reporting
	#################################################################################################################################################
		error_reporting(E_ALL); 
		ini_set('log_errors', TRUE);
		if(defined("_HIVE_PHP_LOG_PATH_")) { if(_HIVE_PHP_LOG_PATH_) { ini_set('error_log',_HIVE_PHP_LOG_PATH_);}}
		if(defined("_HIVE_PHP_DISPLAY_ERROR_ON_START_")) { ini_set('display_errors', _HIVE_PHP_DISPLAY_ERROR_ON_START_); } else { ini_set('display_errors', 0); }
		
	#################################################################################################################################################
	// Start Session
	#################################################################################################################################################
		session_start();

	#################################################################################################################################################
	// Constants for Tables
	#################################################################################################################################################
		$object["prefix"]						= @$mysql["prefix"];
		// Default Table Constants - Classes Auto-Creation
		define("_TABLE_LOG_", 				$object["prefix"]."log");
		define("_TABLE_LOG_IP_", 			$object["prefix"]."log_ip");
		define("_TABLE_LOG_BENCHMARK_", 	$object["prefix"]."log_benchmark");
		define("_TABLE_LOG_CURL_", 			$object["prefix"]."log_curl");
		define("_TABLE_LOG_MAIL_", 			$object["prefix"]."log_mail");
		define("_TABLE_LOG_MYSQL_", 		$object["prefix"]."log_mysql");
		define("_TABLE_LOG_REFERER_", 		$object["prefix"]."log_referer");
		define("_TABLE_LOG_CRON_", 			$object["prefix"]."log_cron");
		define("_TABLE_LOG_JS_", 			$object["prefix"]."log_js");
		define("_TABLE_LOG_VISIT_", 		$object["prefix"]."log_hitcounter");
		// Default Table Constants - Classes Auto-Creation
		define("_TABLE_USER_", 				$object["prefix"]."user");
		define("_TABLE_USER_EXTRAFIELDS_", 	$object["prefix"]."user_extrafields");
		define("_TABLE_USER_SESSION_",		$object["prefix"]."user_session");
		define("_TABLE_USER_PERM_",			$object["prefix"]."user_perm");
		define("_TABLE_USER_GROUP_",		$object["prefix"]."user_group");
		define("_TABLE_USER_GROUP_PERM_",	$object["prefix"]."user_group_perm");
		define("_TABLE_USER_GROUP_LINK_",	$object["prefix"]."user_group_link");
		// Default Table Constants - Classes Auto-Creation
		define("_TABLE_VAR_", 				$object["prefix"]."sys_var");
		define("_TABLE_LANG_",				$object["prefix"]."sys_lang");
		define("_TABLE_MAIL_TPL_",			$object["prefix"]."sys_template_mail");
		define("_TABLE_API_", 				$object["prefix"]."sys_api");
		define("_TABLE_COMMENT_", 			$object["prefix"]."sys_comment");
		// Tables for Store and Token Access to Modules - Installed out of _core/_mysql folder!
		define("_TABLE_STORE_", 			$object["prefix"]."store");
		define("_TABLE_HUB_", 				$object["prefix"]."hub");
		define("_TABLE_TOKEN_",				$object["prefix"]."token");
		
	#################################################################################################################################################
	// Main Constant Definitions
	#################################################################################################################################################
		define("_HIVE_PREFIX_", 				@$mysql["prefix"]);
		define("_HIVE_COOKIE_", 				@$object["cookie"]);
		define("_HIVE_PATH_", 					@$object["path"]);	
		define("_HIVE_PATH_DATA_", 				@$object["path"]."/_data/");	
		define("_HIVE_PATH_SITE_", 				@$object["path"]."/_site/");	
		define("_HIVE_PATH_SCRIPT_", 			@$object["path"]."/_script/");	
		define("_HIVE_PATH_IMAGE_", 			@$object["path"]."/_image/");	
		define("_HIVE_PATH_OFF_", 				@$object["path"]."/_disabled/");	
		define("_HIVE_PATH_IMAGE_OFF_", 		@$object["path"]."/_disabled/_image/");	
		define("_HIVE_PATH_SCRIPT_OFF_", 		@$object["path"]."/_disabled/_script/");	
		define("_HIVE_PATH_SITE_OFF_", 			@$object["path"]."/_disabled/_site/");	

	#################################################################################################################################################
	// Current Hive Mode Determination
	#################################################################################################################################################
		if($hive_mode_override) { define("_HIVE_MODE_DEFAULT_", $hive_mode_override); } else { define("_HIVE_MODE_DEFAULT_", $hive_mode_default); } unset($hive_mode_default);
		if($hive_mode_override) { if(_HIVE_ADMIN_SITE_) {define("_HIVE_MODE_ARRAY_", array($hive_mode_override, _HIVE_ADMIN_SITE_));} else {define("_HIVE_MODE_ARRAY_", array($hive_mode_override));} } 
			elseif(@is_array(@$hive_mode_array)) { if(_HIVE_ADMIN_SITE_) { array_push($hive_mode_array, _HIVE_ADMIN_SITE_); define("_HIVE_MODE_ARRAY_", $hive_mode_array);} else {define("_HIVE_MODE_ARRAY_", $hive_mode_array);} } 
		if(!$hive_mode_override) {	
			$directory = $object["path"]."/_site";
			$folders = array();
			if (is_dir($directory)) {
				$contents = scandir($directory);
				foreach ($contents as $item) {
					$itemPath = $directory . '/' . $item;
					if (is_dir($itemPath) && !in_array($item, array('.', '..'))) {
						$folders[] = $item;
					}
					unset($itemPath);
				} unset($item);
			} if(_HIVE_ADMIN_SITE_) {define("_HIVE_MODE_ARRAY_", $folders);} 
			else {
				if (($key = array_search(_HIVE_ADMIN_SITE_, $folders)) !== false) { 
					unset($folders[$key]);
				} define("_HIVE_MODE_ARRAY_", $folders);
			} 	 
		} unset($hive_mode_array); unset($directory);	unset($folders); unset($contents); unset($key);	
		
		// Switch _HIVE_MODE_
		if(!isset($_SESSION[_HIVE_COOKIE_."hive_mode"])) { @$_SESSION[_HIVE_COOKIE_."hive_mode"] = _HIVE_MODE_DEFAULT_; }		
		if(@is_string(@$_SESSION[_HIVE_COOKIE_."hive_mode"]) AND  @in_array(@$_SESSION[_HIVE_COOKIE_."hive_mode"], @_HIVE_MODE_ARRAY_)) {
		} else {  
			$_SESSION[_HIVE_COOKIE_."hive_mode"] = _HIVE_MODE_DEFAULT_;
		}			
		if(is_array(_HIVE_MOD_FETCH_) AND !$hive_mode_override) {
			$found_new = false;
			$found_url = false;
			if(is_array(_HIVE_MOD_FETCH_)) { 
				foreach(_HIVE_MOD_FETCH_ as $key => $value) {
					if( strpos($_SERVER['HTTP_HOST'], $value["url"]) > -1)  {
						$found_new = $value["mode"];		
						$found_url = $value["url"];		
					}					
				}
			}
			if(!$found_new) { hive__error("Dynamic URL Error", "Site Mode could not be determined by URL!", "Please check your dynamic site mode by domain settings in the administrator interface or at cfg_ruleset.php.", true, 503); }
			else {
				$_SESSION[_HIVE_COOKIE_."hive_mode"] = $found_new;
				define("_HIVE_URL_", $found_url."/");
			}
		}			
		// Override _HIVE_MODE_
		if($hive_mode_override AND $_SESSION[_HIVE_COOKIE_."hive_mode"] != $hive_mode_override) {
			if(_HIVE_ADMIN_SITE_ AND $_SESSION[_HIVE_COOKIE_."hive_mode"] == _HIVE_ADMIN_SITE_) {
			} elseif(!_HIVE_ADMIN_SITE_ AND $_SESSION[_HIVE_COOKIE_."hive_mode"] == _HIVE_ADMIN_SITE_) {
				$_SESSION[_HIVE_COOKIE_."hive_mode"] = $hive_mode_override;
			} else {
				$_SESSION[_HIVE_COOKIE_."hive_mode"] = $hive_mode_override;
			}
		} unset($hive_mode_override);  
		
		// Check for Hive Mode per SetEnv Variable 
		$ovr_hive_mode_getenv = @getenv("_HIVE_MODE_ENV_OVR_"); 
		if(strlen($ovr_hive_mode_getenv) > 0 AND trim($ovr_hive_mode_getenv ?? '') != "") { 
			if(@in_array($ovr_hive_mode_getenv, _HIVE_MODE_ARRAY_)) {
				$_SESSION[_HIVE_COOKIE_."hive_mode"] = $ovr_hive_mode_getenv;
			} else { 
				hive__error("Module Missing", "A Site Module is missing, which has been overrided by Apache2 Environment Variables!", "You have set the Apache2 Environment Variable: '_HIVE_MODE_ENV_OVR_' to '".@$ovr_hive_mode_getenv."', but this site module does not exist. Please fix the Environment Variable Value to fit a valid site module!", true, 503);
				exit();
			}
		} unset($ovr_hive_mode_getenv);
		
		// Set Hive Mode
		define("_HIVE_MODE_", $_SESSION[_HIVE_COOKIE_."hive_mode"]);

	#################################################################################################################################################
	// Relative and Absolute Variable Declaration
	#################################################################################################################################################
		define('_HIVE_SITE_PATH_', 			$object["path"]."/_site/"._HIVE_MODE_."/");	
		define('_HIVE_SITE_COOKIE_', 		_HIVE_COOKIE_."_"._HIVE_MODE_."_");	
		define('_HIVE_SITE_PREFIX_', 		_HIVE_PREFIX_."_"._HIVE_MODE_."_");	
		define('_HIVE_SITE_PATH_DATA_', 	$object["path"]."/_data/"._HIVE_MODE_."/");	
		define('_HIVE_SITE_PATH_EXT_', 		$object["path"]."/_data/"._HIVE_MODE_."/_extension/");	
		define('_HIVE_SITE_PATH_EXT_OFF_', 	$object["path"]."/_data/"._HIVE_MODE_."/_extension_disabled/");	
		define('_HIVE_SITE_PATH_PUBLIC_', 	$object["path"]."/_data/"._HIVE_MODE_."/_public/");	
		define('_HIVE_SITE_PATH_PRIVATE_', 	$object["path"]."/_data/"._HIVE_MODE_."/_private/");	
		define('_HIVE_SITE_PATH_DOMAIN_', 	$object["path"]."/_data/"._HIVE_MODE_."/_domain/");	

	#################################################################################################################################################
	// Get Current Extensions
	#################################################################################################################################################
		if( trim(_HIVE_MODE_ ?? '') != "") { $object["extensions_path"] = hive__extension_path(_HIVE_MODE_); }
		else { $object["extensions_path"] = array(); }
		define("_HIVE_SITE_EXT_", $object["extensions_path"]);

	#################################################################################################################################################
	// Get Current Core Data
	#################################################################################################################################################
		require($object["path"]."/_core/version.php");
		$object["core_mode"] = $x;
		unset($x);
		
	#################################################################################################################################################
	// Get Current Hive Mode Data
	#################################################################################################################################################
		if(file_exists($object["path"]."/_site/"._HIVE_MODE_."/version.php") AND trim(_HIVE_MODE_ ?? '') != "") { 
			require($object["path"]."/_site/"._HIVE_MODE_."/version.php");
			$object["hive_mode"] = $x;
			unset($x);
		} else {
			$object["hive_mode"] = false;
			unset($_SESSION[_HIVE_COOKIE_."hive_mode"]);
		}			
		
	#################################################################################################################################################
	// Create Site Modules Folders
	#################################################################################################################################################
		if(is_array($object["hive_mode"])) {
				hive__folder_create(_HIVE_SITE_PATH_DATA_, true, false);
				hive__folder_create(_HIVE_SITE_PATH_EXT_, true, false);
				hive__folder_create(_HIVE_SITE_PATH_EXT_OFF_, true, true);
				hive__folder_create(_HIVE_SITE_PATH_PUBLIC_, true, false);
				hive__folder_create(_HIVE_SITE_PATH_PRIVATE_, true, true);
				hive__folder_create(_HIVE_SITE_PATH_DOMAIN_, true, false);
		}		
		
	#################################################################################################################################################
	// MySQL Initializations
	#################################################################################################################################################
		$object["mysql"] = new x_class_mysql(@$mysql["host"], @$mysql["user"], @$mysql["pass"], @$mysql["db"], @$mysql["port"]);	
		if ($object["mysql"]->lasterror != false) { $object["mysql"]->displayError(true, 503); exit(); }		
		if(is_array($object["hive_mode"])) {  $object["mysql"]->log_config(_TABLE_LOG_MYSQL_, _HIVE_MODE_);	}
			else {  $object["mysql"]->log_config(_TABLE_LOG_MYSQL_, "");	}
		
	#################################################################################################################################################
	// Load Log Class
	#################################################################################################################################################
		$object["log"] 			= 	new x_class_log($object["mysql"], _TABLE_LOG_CRON_, "");
		if(is_array($object["hive_mode"])) { $object["log"] = new x_class_log($object["mysql"], _TABLE_LOG_, _HIVE_MODE_); }
			else { $object["log"] 			= 	new x_class_log($object["mysql"], _TABLE_LOG_, ""); }
		$object["log_tmp"] 		= 	new x_class_log($object["mysql"], _TABLE_LOG_, "");		
		
	#################################################################################################################################################
	// Load Pre-Defined Core Tables if Needed
	#################################################################################################################################################
		if(!$object["mysql"]->table_exists($object["prefix"]."store")) {
			$object["log_tmp"]->warning("MySQL Table Installation: '<b>".@htmlspecialchars($object["prefix"]."store" ?? '' )."</b>'", "mysql");
			require_once(_HIVE_PATH_."/_core/_mysql/mysql.store.php");
			$object["mysql"]->free_all();
		}	
		if(!$object["mysql"]->table_exists($object["prefix"]."token")) {
			$object["log_tmp"]->warning("MySQL Table Installation: '<b>".@htmlspecialchars($object["prefix"]."token" ?? '' )."</b>'", "mysql");
			require_once(_HIVE_PATH_."/_core/_mysql/mysql.token.php");
			$object["mysql"]->free_all();
		}
		if(!$object["mysql"]->table_exists($object["prefix"]."hub")) {
			$object["log_tmp"]->warning("MySQL Table Installation: '<b>".@htmlspecialchars($object["prefix"]."hub" ?? '' )."</b>'", "mysql");
			require_once(_HIVE_PATH_."/_core/_mysql/mysql.hub.php");
			$object["mysql"]->free_all();
		}
		$object["mysql"]->benchmark_config(true, _HIVE_SITE_COOKIE_);
		unset($mysql);		
		
	#################################################################################################################################################
	// Classes Variables Initializations
	#################################################################################################################################################
		if(is_array($object["hive_mode"])) {  $object["var"] 			= 	new x_class_var($object["mysql"], _TABLE_VAR_, _HIVE_MODE_); }
			else { $object["var"] 			= 	new x_class_var($object["mysql"], _TABLE_VAR_, ""); }
		$object["var_glob"] 				= 	new x_class_var($object["mysql"], _TABLE_VAR_, "");
		
	#################################################################################################################################################
	// Init Current Site Build Number and Version/RNAME Vonstants
	#################################################################################################################################################
		if(is_array($object["hive_mode"])) { 
			define('_HIVE_BUILD_', $object["hive_mode"]["build"]);   
			define('_HIVE_VERSION_', $object["hive_mode"]["version"]);
			define('_HIVE_RNAME_', $object["hive_mode"]["rname"]);
			$object["var"]->setup("_HIVE_BUILD_ACTIVE_",@htmlspecialchars( _HIVE_BUILD_ ?? ''), "Current Installed Site Modules Build Number");	
			$object["var"]->setup("_HIVE_RNAME_ACTIVE_",@htmlspecialchars( _HIVE_RNAME_ ?? ''), "Current Installed Site Modules RNAME");
		} else { define('_HIVE_BUILD_', 0); define('_HIVE_VERSION_', 0); define('_HIVE_RNAME_', 0); define("_HIVE_CRIT_ER_", 1); }		
		$tmp_build = $object["var"]->get("_HIVE_BUILD_ACTIVE_");
		$tmp_rname = $object["var"]->get("_HIVE_RNAME_ACTIVE_");
		if(_HIVE_BUILD_ == 0 OR _HIVE_VERSION_ == 0 OR _HIVE_RNAME_ == 0 OR _HIVE_BUILD_ != $tmp_build OR _HIVE_RNAME_ != $tmp_rname) {
			if(!defined("_HIVE_CRIT_ER_")) { define("_HIVE_CRIT_ER_", 1); }
		} unset($tmp_build); unset($tmp_rname);		
		
	#################################################################################################################################################
	// Get Site Mode Library Files
	#################################################################################################################################################
		if(!defined("_HIVE_CRIT_ER_")) { 
			foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_lib/lib.*.php") as $filename) { if(@basename($filename) == "index.php") { continue; } require_once $filename;}	 
			foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_wfc/wfc.*.php") as $filename) { if(@basename($filename) == "index.php") { continue; } require_once $filename;}	 
			// Extension Libraries
			foreach (_HIVE_SITE_EXT_ as $hive_extension_loader_current_init) {
				if (is_dir($hive_extension_loader_current_init."/_lib")) {
						foreach (glob($hive_extension_loader_current_init."/_lib/lib.*.php") as $filenamex){ require_once $filenamex; }
				}		
			}	
			// Extension Libraries
			foreach (_HIVE_SITE_EXT_ as $hive_extension_loader_current_init) {
				if (is_dir($hive_extension_loader_current_init."/_wfc")) {
						foreach (glob($hive_extension_loader_current_init."/_wfc/wfc.*.php") as $filenamex){ require_once $filenamex; }
				}
			}	
		}			
	
	#################################################################################################################################################
	// Load Global Configurations from Site Modules (Preconfiguration)
	#################################################################################################################################################		
		if(!defined("_HIVE_CRIT_ER_"))  {
			if(is_array(_HIVE_MODE_ARRAY_))  {
				foreach(_HIVE_MODE_ARRAY_ as $key => $value) {
					$realpath = _HIVE_SITE_PATH_."/".$value."/"; 
					if (file_exists($realpath."/_config/global_pre.php")) {
						$object["hive_mode_config"] = array(); 
						$object["hive_mode_config"]["info"]   = hive__require_x($realpath."/version.php");
						$object["hive_mode_config"]["path"]   = $realpath;
						$object["hive_mode_config"]["name"]   = basename($realpath);
						$object["hive_mode_config"]["prefix"] = _HIVE_COOKIE_."_".$value."_";
						$object["hive_mode_config"]["cookie"] = _HIVE_COOKIE_."_".$value."_";
						require_once($value."/_config/global_pre.php");
					}
				}
			}
		} unset($object["hive_mode_config"]);		
		
	#################################################################################################################################################
	// Load Site Specific Pre Configuration (and of extension modules)
	#################################################################################################################################################	
		if(!defined("_HIVE_CRIT_ER_"))  {
			if(file_exists($object["path"]."/_site/"._HIVE_MODE_."/_config/config_pre.php")) { 
				require_once($object["path"]."/_site/"._HIVE_MODE_."/_config/config_pre.php"); 
			}	
			// Extension Libraries
			foreach (_HIVE_SITE_EXT_ as $hive_extension_loader_current_init) {
				if (file_exists($hive_extension_loader_current_init."/_config/config_pre.php")) {
					$object["extension"] = array(); 
					$object["extension"]["info"]   = hive__require_x($hive_extension_loader_current_init."/version.php");
					$object["extension"]["path"]   = $hive_extension_loader_current_init;
					$object["extension"]["name"]   = basename($hive_extension_loader_current_init);
					$object["extension"]["prefix"] = _HIVE_PREFIX_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
					$object["extension"]["cookie"] = _HIVE_COOKIE_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
					require_once $hive_extension_loader_current_init."/_config/config_pre.php";
				}
			}	
		} unset($object["extension"]);

	#################################################################################################################################################
	/* Set Up The Real URL as Configured in Settings.php */	
	#################################################################################################################################################
		if(!defined("_HIVE_URL_")) { 
			define("_HIVE_URL_", $object["url"]); 
		}
		$object["url"] = _HIVE_URL_;

	#################################################################################################################################################
	/* Give constant to work with determinated URLs with no need to set them anywhere. */	
	#################################################################################################################################################
		$tmprel = parse_url(_HIVE_URL_, PHP_URL_PATH);
		if(!$tmprel OR $tmprel == "") { $tmprel = "/"; }
		if (isset($_SERVER['HTTPS']) && @$_SERVER['HTTPS'] === 'on') {
			$link = "https://";
		} else { $link = "http://"; }
		$tmprelx = $link.@$_SERVER["HTTP_HOST"].$tmprel;
		if(substr($tmprelx, -1, 1) != "/") { $tmprelx = $tmprelx."/"; }
		if(substr($tmprel, -1, 1) != "/") { $tmprel = $tmprel."/"; }
		define('_HIVE_URL_REL_', $tmprelx);	
		define('_HIVE_URLC_REL_', $tmprel);	
		unset($tmprelx);
		unset($tmprel);
		unset($link);

	#################################################################################################################################################
	// Classes Initializations
	#################################################################################################################################################
		$object["debug"] 		= 	new x_class_debug();
			$object["debug"]->js_error_create_db($object["mysql"], _TABLE_LOG_JS_);
		$object["eventbox"] 	= 	new x_class_eventbox(_HIVE_SITE_COOKIE_);
		$object["curl"] 		= 	new x_class_curl();	
		$object["crypt"] 		= 	new x_class_crypt();	
		$object["zip"] 			= 	new x_class_zip();
		if(!defined("_HIVE_CRIT_ER_"))  { $tmp_mode = _HIVE_MODE_; } else { $tmp_mode = ""; }
		$object["benchmark"] 	= 	new x_class_benchmark($object["mysql"], _TABLE_LOG_BENCHMARK_, $tmp_mode);	
		$object["api"] 			= 	new x_class_api($object["mysql"], _TABLE_API_, $tmp_mode);
		$object["hitcounter"] 	= 	new x_class_hitcounter($object["mysql"], _TABLE_LOG_VISIT_, _HIVE_SITE_COOKIE_, $tmp_mode);
		$object["hitcounter"]->clearget(false);
		$object["comment"] 		= 	new x_class_comment($object["mysql"], _TABLE_COMMENT_, _HIVE_SITE_COOKIE_, 0, 0, $tmp_mode);
		unset($tmp_mode);
		$object["2fa"] 		= 	false;

	#################################################################################################################################################
	// Load Global Configurations from Site Modules (Middleware)
	#################################################################################################################################################		
		if(!defined("_HIVE_CRIT_ER_"))  {
			if(is_array(_HIVE_MODE_ARRAY_))  {
				foreach(_HIVE_MODE_ARRAY_ as $key => $value) {
					$realpath = _HIVE_SITE_PATH_."/".$value."/";
					if (file_exists($realpath."/_config/global.php")) {
						$object["hive_mode_config"] = array(); 
						$object["hive_mode_config"]["info"]   = hive__require_x($realpath."/version.php");
						$object["hive_mode_config"]["path"]   = $realpath;
						$object["hive_mode_config"]["name"]   = basename($realpath);
						$object["hive_mode_config"]["prefix"] = _HIVE_COOKIE_."_".$value."_";
						$object["hive_mode_config"]["cookie"] = _HIVE_COOKIE_."_".$value."_";
						require_once($value."/_config/global.php");
					}
				}
			}
		} unset($object["hive_mode_config"]);		
		
	#################################################################################################################################################
	// Instance Settings
	#################################################################################################################################################
		if(!defined("_HIVE_CRIT_ER_")) { 
			if(file_exists($object["path"]."/_site/"._HIVE_MODE_."/_config/config.php")) { 
				require_once($object["path"]."/_site/"._HIVE_MODE_."/_config/config.php"); 
			} 
			// Extension Libraries
			foreach (_HIVE_SITE_EXT_ as $hive_extension_loader_current_init) {
				if (file_exists($hive_extension_loader_current_init."/_config/config.php")) {
					$object["extension"] = array(); 
					$object["extension"]["info"]   = hive__require_x($hive_extension_loader_current_init."/version.php");
					$object["extension"]["path"]   = $hive_extension_loader_current_init;
					$object["extension"]["name"]   = basename($hive_extension_loader_current_init);
					$object["extension"]["prefix"] = _HIVE_PREFIX_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
					$object["extension"]["cookie"] = _HIVE_COOKIE_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
					require_once $hive_extension_loader_current_init."/_config/config.php";
				}
			} unset($object["extension"]);	
		}	
		
	#################################################################################################################################################
	// Init Contants out of Variable Classes
	#################################################################################################################################################
		$object["var"]->init_constant();			
		$object["var_glob"]->init_constant();			
		
	#################################################################################################################################################
	// Some Variables in Case they are not set by configurations of modules.
	#################################################################################################################################################
		if(!defined("_HIVE_URL_GET_")) 					{ define('_HIVE_URL_GET_', array("hl1", "hl2", "hl4", "hl5", "hl6")); }
		if(!defined("_HIVE_CURL_LOGGING_")) 			{ define('_HIVE_CURL_LOGGING_', false); }
		if(!defined("_HIVE_URL_SEO_")) 					{ define("_HIVE_URL_SEO_", false); }
		if(!defined("_HIVE_TITLE_SPACER_")) 			{ define("_HIVE_TITLE_SPACER_", " - "); }
		if(!defined("_UPDATER_CODE_")) 					{ define("_UPDATER_CODE_", false); }
		if(!defined("_CRON_ONLY_CLI_")) 				{ define("_CRON_ONLY_CLI_", true); }
		if(!defined("_HIVE_CSRF_TIME_")) 				{ define("_HIVE_CSRF_TIME_", 1200); }
		if(!defined("_TINYMCE_PLUGINS_")) 				{ define("_TINYMCE_PLUGINS_", "preview importcss searchreplace autolink directionality visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor advlist lists wordcount help charmap quickbars emoticons code"); }
		if(!defined("_TINYMCE_MENU_BAR_")) 				{ define("_TINYMCE_MENU_BAR_", "file edit view insert format table help"); }
		if(!defined("_TINYMCE_TOOL_BAR_")) 				{ define("_TINYMCE_TOOL_BAR_", "undo redo | bold italic underline strikethrough | blocks fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | image media link"); }		
		
	#################################################################################################################################################
	// Load Modules Current Selected MySQL Configuration
	#################################################################################################################################################
		if(!defined("_HIVE_CRIT_ER_")) { 
			foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_mysql/mysql.*.php") as $filename){ 
				if(@basename($filename) == "index.php") { continue; } 
				if(!$object["mysql"]->table_exists(_HIVE_SITE_PREFIX_.substr(basename($filename), 6, -4))) {
					$object["log"]->warning("MySQL Table Installation for: '<b>".@htmlspecialchars(_HIVE_MODE_ ?? '')."</b>' with Table Name: '<b>".@htmlspecialchars(_HIVE_SITE_PREFIX_.substr(basename($filename), 6, -4) ?? '' )."</b>'", "mysql");
					require_once($filename);
					$object["mysql"]->free_all();
				}
			}	
			// Extension Libraries
			foreach (_HIVE_SITE_EXT_ as $hive_extension_loader_current_init) {
				$object["extension"] = array(); 
				$object["extension"]["info"]   = hive__require_x($hive_extension_loader_current_init."/version.php");
				$object["extension"]["path"]   = $hive_extension_loader_current_init;
				$object["extension"]["name"]   = basename($hive_extension_loader_current_init);
				$object["extension"]["prefix"] = _HIVE_PREFIX_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
				$object["extension"]["cookie"] = _HIVE_COOKIE_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
				foreach (glob($hive_extension_loader_current_init."/_mysql/mysql.*.php") as $filenamemm){ 
					if(@basename($filenamemm) == "index.php") { continue; } 
					if(!$object["mysql"]->table_exists($object["extension"]["prefix"].substr(basename($filenamemm), 6, -4))) {
						$object["log"]->warning("MySQL Table Installation for: '<b>"._HIVE_MODE_."</b>' on Extension: '<b>".htmlspecialchars($object["extension"]["name"] ?? '') ."</b>' with Table Name: '<b>".@htmlspecialchars($object["extension"]["prefix"].substr(basename($filenamemm), 6, -4) ?? '' )."</b>'", "mysql");
						require_once($filenamemm);
						$object["mysql"]->free_all();
					}
				}	
			} unset($object["extension"]);	
		} unset($object["log_tmp"]);
				
	#################################################################################################################################################
	// Define Default Headers for Mails
	#################################################################################################################################################
		if(!defined("_SMTP_MAILS_HEADER_")) {
			define("_SMTP_MAILS_HEADER_", '<!doctype html><html><head><meta name="viewport" content="width=device-width, initial-scale=1.0"/><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><style>body { background-color: #121212; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; } .content { background: #FFFFFF; box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px; border-radius: 5px; margin-top: 15px;  }  .footer { clear: both; margin-top: 10px; text-align: center; width: 100%; color: #000000; font-size: 12px; text-align: center;  }  h1, h2, h3, h4 { color: #000000; font-family: sans-serif; font-weight: 400; line-height: 1.4; margin: 0; margin-bottom: 30px; }  h1 { font-size: 35px; font-weight: 300; text-align: center; text-transform: capitalize; }  a { color: blue; text-decoration: none; } hr { border: 0; border-bottom: 1px solid #242424; margin: 20px 0; }  @media only screen and (max-width: 620px) { div.content { margin-top: 2vw !important; margin-left: 2vw !important; margin-right: 2vw !important;}} a:hover { color: black; } .alert { padding: 15px; margin: 5px; border-radius: 5px; } .alert-danger { background: #FFCDD2; } .alert-success { background: #A5D6A7; } .alert-warning { background: #FFF9C4; }</style></head><body><div class="content">'); }
		if(!defined("_SMTP_MAILS_FOOTER_")) { define("_SMTP_MAILS_FOOTER_", '</div></body></html>'); }		
		
	#################################################################################################################################################
	// Default Captcha Setup
	#################################################################################################################################################		
		if(!defined("_CAPTCHA_FONT_PATH_")) 	{ define("_CAPTCHA_FONT_PATH_", "../_font/font.captcha_fallback.ttf"); }
		if(!defined("_CAPTCHA_WIDTH_")) 		{ define("_CAPTCHA_WIDTH_", "200"); }
		if(!defined("_CAPTCHA_HEIGHT_")) 		{ define("_CAPTCHA_HEIGHT_", "70"); }
		if(!defined("_CAPTCHA_LINES_")) 		{ define("_CAPTCHA_LINES_", mt_rand(5, 12)); }
		if(!defined("_CAPTCHA_CODE_")) 			{ define("_CAPTCHA_CODE_", mt_rand(1000, 9999)); }
		if(!defined("_CAPTCHA_SQUARES_")) 		{ define("_CAPTCHA_SQUARES_", mt_rand(5, 12)); }
		if(!defined("_CAPTCHA_COLORS_")) 		{ define("_CAPTCHA_COLORS_", false); }		
		
	#################################################################################################################################################
	// Default User Setup
	#################################################################################################################################################	
		if(!defined("_USER_MULTI_LOGIN_")) 		{ define("_USER_MULTI_LOGIN_", false); }
		if(!defined("_USER_REC_DROP_")) 		{ define("_USER_REC_DROP_", true); }
		if(!defined("_USER_MAX_SESSION_")) 		{ define("_USER_MAX_SESSION_", 7); }
		if(!defined("_USER_TOKEN_TIME_")) 		{ define("_USER_TOKEN_TIME_", 600); }
		if(!defined("_USER_PF_SIGNS_")) 		{ define("_USER_PF_SIGNS_", 7); }
		if(!defined("_USER_PF_CAPSIGNS_")) 		{ define("_USER_PF_CAPSIGNS_", 1); }
		if(!defined("_USER_PF_SMSIGNS_")) 		{ define("_USER_PF_SMSIGNS_", 1); }
		if(!defined("_USER_PF_SPSIGNS_")) 		{ define("_USER_PF_SPSIGNS_", 0); }
		if(!defined("_USER_PF_NUMSIGNS_")) 		{ define("_USER_PF_NUMSIGNS_", 1); }
		if(!defined("_USER_AUTOBLOCK_")) 		{ define("_USER_AUTOBLOCK_", 1200); }
		if(!defined("_USER_WAIT_COUNTER_")) 	{ define("_USER_WAIT_COUNTER_", 120); }
		if(!defined("_USER_LOG_SESSIONS_")) 	{ define("_USER_LOG_SESSIONS_", true); }
		if(!defined("_USER_INITIAL_USERNAME_")) { define("_USER_INITIAL_USERNAME_", "admin@admin.local"); }
		if(!defined("_USER_INITIAL_USERPASS_")) { define("_USER_INITIAL_USERPASS_", "changeme"); }
		if(!defined("_USER_LOG_IP_")) 			{ define("_USER_LOG_IP_", false); }

	#################################################################################################################################################
	/* MySQL Debug Mode? */
	#################################################################################################################################################
		if(defined("_HIVE_MYSQL_DEBUG_")) { if(_HIVE_MYSQL_DEBUG_) { $object["mysql"]->stop_on_error(); $object["mysql"]->display_on_error(); } } else { define("_HIVE_MYSQL_DEBUG_", false); }

	#################################################################################################################################################
	/* Apply PHP Debug */
	#################################################################################################################################################
		if(defined("_HIVE_PHP_DEBUG_")) { 
			if(_HIVE_PHP_DEBUG_ == true) { 
				@ini_set('display_errors', 1); 
				@ini_set('display_startup_errors', 1); 
				@error_reporting(E_ALL);	
			} else { 
				@ini_set('display_errors', 0); 
				@ini_set('display_startup_errors', 0); 
			} 
		} else { 
			@ini_set('display_errors', 0); 
			@ini_set('display_startup_errors', 0); 
			define("_HIVE_PHP_DEBUG_", false); 
		} 
		if(defined("_HIVE_PHP_MODS_")) { 
			if(is_array(@_HIVE_PHP_MODS_)) { 
				foreach(_HIVE_PHP_MODS_ as $key => $value) { 
					$object["debug"]->required_php_module($value, true); 
				} 
			} 
		} else { define("_HIVE_PHP_MODS_", array()); }		
		
	#################################################################################################################################################
	/* Get Current URL Data and Setup*/
	#################################################################################################################################################
		if(!_HIVE_URL_SEO_) { 
			define('_HIVE_URL_CUR_', array(@$_GET[_HIVE_URL_GET_[0]], @$_GET[_HIVE_URL_GET_[1]], @$_GET[_HIVE_URL_GET_[2]], @$_GET[_HIVE_URL_GET_[3]], @$_GET[_HIVE_URL_GET_[4]])); 
		} else {  $tmp = explode("/", @$_GET[_HIVE_URL_SEO_]); define('_HIVE_URL_CUR_', array(@$tmp[0], @$tmp[1], @$tmp[2], @$tmp[3], @$tmp[4]));}	    		
		
	#################################################################################################################################################
	// User Init	
	#################################################################################################################################################
		$object["user"] = new x_class_user($object["mysql"], _TABLE_USER_, _TABLE_USER_SESSION_, _HIVE_COOKIE_, _USER_INITIAL_USERNAME_, _USER_INITIAL_USERPASS_, 1); 
		$object["user"]->multi_login(_USER_MULTI_LOGIN_);	
		$object["user"]->login_recover_drop(_USER_REC_DROP_);	
		$object["user"]->user_unique(false);
		$object["user"]->mail_unique(true);
		$object["user"]->login_field_mail();
		$object["user"]->log_ip(_USER_LOG_IP_);
		$object["user"]->log_activation(_USER_LOG_SESSIONS_);
		$object["user"]->log_session(_USER_LOG_SESSIONS_);
		$object["user"]->log_recover(_USER_LOG_SESSIONS_);
		$object["user"]->log_mail_edit(_USER_LOG_SESSIONS_);
		$object["user"]->wait_activation_min(_USER_WAIT_COUNTER_);
		$object["user"]->wait_recover_min(_USER_WAIT_COUNTER_);
		$object["user"]->wait_mail_edit_min(_USER_WAIT_COUNTER_);
		$object["user"]->autoblock(_USER_AUTOBLOCK_);
		$object["user"]->min_activation(_USER_TOKEN_TIME_);
		$object["user"]->min_recover(_USER_TOKEN_TIME_);
		$object["user"]->min_mail_edit(_USER_TOKEN_TIME_);
		$object["user"]->sessions_days(_USER_MAX_SESSION_);
		$object["user"]->cookies_use(true);
		$object["user"]->cookies_days(_USER_MAX_SESSION_);	
		$object["user"]->passfilter(_USER_PF_SIGNS_, _USER_PF_CAPSIGNS_, _USER_PF_SMSIGNS_, _USER_PF_SPSIGNS_, _USER_PF_NUMSIGNS_);	
		$object["user"]->groups(_TABLE_USER_GROUP_, _TABLE_USER_GROUP_LINK_);		
		$object["user"]->extrafields(_TABLE_USER_EXTRAFIELDS_);		
		$object["user"]->init();		
		
	#################################################################################################################################################
	// User Permissions
	#################################################################################################################################################
		if(is_array($object["hive_mode"])) { $tmp_type = _HIVE_MODE_; } else { $tmp_type = ""; } 
		$object["perm_user"] 		= 	new x_class_perm($object["mysql"], _TABLE_USER_PERM_, $tmp_type);
		$object["perm_user_glob"] 	= 	new x_class_perm($object["mysql"], _TABLE_USER_PERM_, "");
		$object["perm_group"] 		= 	new x_class_perm($object["mysql"], _TABLE_USER_GROUP_PERM_, $tmp_type);	
		$object["perm_group_glob"] 	= 	new x_class_perm($object["mysql"], _TABLE_USER_GROUP_PERM_, "");	
		unset($tmp_type);		
		
	#################################################################################################################################################
	// Create Permission Item for Current User
	#################################################################################################################################################
		$object["user_perm"] = $object["perm_user"]->item($object["user"]->user_id);	
		$object["user_perm_glob"] = $object["perm_user_glob"]->item($object["user"]->user_id);		
		
	#################################################################################################################################################
	// Prepare Arrays for User Groups and Permissions
	#################################################################################################################################################
		$object["user_group"] = array();
		$tmp = $object["mysql"]->select("SELECT * FROM "._TABLE_USER_GROUP_LINK_." WHERE fk_user = '".@$object["user"]->user_id."'", true);
		if(is_array($tmp)) {
			foreach($tmp AS $key => $value) {
				$valuex = $object["mysql"]->select("SELECT * FROM "._TABLE_USER_GROUP_." WHERE id = '".$value["fk_group"]."'", false);
				if(!is_array($valuex)) { continue; }
				$valuex["perm_obj"] = $object["perm_group"]->item($value["fk_group"]);
				$valuex["perm_obj_glob"] = $object["perm_group_glob"]->item($value["fk_group"]);
				array_push($object["user_group"], $valuex);
			}	
		} unset($tmp);			
		
	#################################################################################################################################################
	// Init of may not set variables
	#################################################################################################################################################		
		if(!defined("_REDIS_")) 				{ define("_REDIS_", 					false); }
		if(!defined("_REDIS_HOST_")) 			{ define("_REDIS_HOST_", 				"localhost"); }
		if(!defined("_REDIS_PORT_")) 			{ define("_REDIS_PORT_", 				6379); }
		if(!defined("_REDIS_PREFIX_")) 			{ define("_REDIS_PREFIX_", 				_HIVE_SITE_PREFIX_); }
		if(!defined("_HIVE_IP_LIMIT_")) 		{ define("_HIVE_IP_LIMIT_", 			100000); }
		if(!defined("_HIVE_REFERER_")) 			{ define("_HIVE_REFERER_", 				false); }	
		if(!defined("_SMTP_HOST_")) 			{ define("_SMTP_HOST_", 				false); }
		if(!defined("_SMTP_PORT_")) 			{ define("_SMTP_PORT_", 				false); } 
		if(!defined("_SMTP_AUTH_")) 			{ define("_SMTP_AUTH_", 				false); } 
		if(!defined("_SMTP_USER_")) 			{ define("_SMTP_USER_", 				false); } 
		if(!defined("_SMTP_PASS_")) 			{ define("_SMTP_PASS_", 				false); } 
		if(!defined("_SMTP_INSECURE_")) 		{ define("_SMTP_INSECURE_", 			true); }
		if(!defined("_SMTP_DEBUG_")) 			{ define("_SMTP_DEBUG_", 				0); }
		if(!defined("_SMTP_MAILS_IN_HTML_")) 	{ define("_SMTP_MAILS_IN_HTML_", 		true); }
		if(!defined("_SMTP_SENDER_MAIL_")) 		{ define("_SMTP_SENDER_MAIL_", 			false); }
		if(!defined("_SMTP_SENDER_NAME_")) 		{ define("_SMTP_SENDER_NAME_", 			false); }
		
	#################################################################################################################################################
	// More Classes Inits
	#################################################################################################################################################
		if(!is_array($object["hive_mode"])) { $tmp_type = ""; } else { $tmp_type = _HIVE_MODE_; }
		$object["curl"]->logging($object["mysql"], _HIVE_CURL_LOGGING_, true, _TABLE_LOG_CURL_, $tmp_type);		
		$object["ipbl"] = new x_class_ipbl($object["mysql"], _TABLE_LOG_IP_, _HIVE_IP_LIMIT_);	
		if(_REDIS_) { $object["redis"] = new x_class_redis(_REDIS_HOST_, _REDIS_PORT_, _REDIS_PREFIX_); }
		$object["mail"] = new x_class_mail(_SMTP_HOST_, _SMTP_PORT_, _SMTP_AUTH_, _SMTP_USER_, _SMTP_PASS_, _SMTP_SENDER_MAIL_, _SMTP_SENDER_NAME_);
		$object["mail"]->initReplyTo(_SMTP_SENDER_MAIL_, _SMTP_SENDER_NAME_);
		$object["mail"]->change_default_template(_SMTP_MAILS_HEADER_, _SMTP_MAILS_FOOTER_);		
		$object["mail"]->all_default_html(_SMTP_MAILS_IN_HTML_);	
		$object["mail"]->smtpdebuglevel(_SMTP_DEBUG_);	
		$object["mail"]->allow_insecure_ssl_connections(_SMTP_INSECURE_);		
		$object["mail"]->logging($object["mysql"], _TABLE_LOG_MAIL_, false, $tmp_type);	
		unset($tmp_type);

	#################################################################################################################################################
	// Mail Template Settings
	#################################################################################################################################################
		if(!defined("_HIVE_CRIT_ER_")) {
			$object["mail_template"] = new x_class_mail_template($object["mysql"], _TABLE_MAIL_TPL_, _HIVE_MODE_);
			$object["mail_template"]->set_header(_SMTP_MAILS_HEADER_);
			$object["mail_template"]->set_footer(_SMTP_MAILS_FOOTER_);			
		}
		
	#################################################################################################################################################
	// Referer Class	
	#################################################################################################################################################
		if(@@$_SERVER["HTTP_HOST"]) { $tmp_host = @$_SERVER["HTTP_HOST"]; } else { $tmp_host = ""; }
		$object["referer"] = new x_class_referer($object["mysql"], _TABLE_LOG_REFERER_, @$tmp_host);	
		if(_HIVE_REFERER_) 	{ $object["referer"]->execute($tmp_type); }
		unset($tmp_host);

	#################################################################################################################################################
	// Language Initializations	
	#################################################################################################################################################
		if(!defined("_HIVE_LANG_ARRAY_")) 			{ define("_HIVE_LANG_ARRAY_", 			array("")); }
		if(!defined("_HIVE_LANG_DEFAULT_")) 		{ define("_HIVE_LANG_DEFAULT_", 		false); }
		// Just Create the Language Table
		$object["lang"] = new x_class_lang($object["mysql"], _TABLE_LANG_, false, false, false);
		unset($object["lang"]);
		// Set Default if not set or wrong
		if(isset($_SESSION[_HIVE_SITE_COOKIE_."hive_language"])) {
			if(in_array($_SESSION[_HIVE_SITE_COOKIE_."hive_language"], _HIVE_LANG_ARRAY_)) {
			} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = _HIVE_LANG_DEFAULT_; }
		} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = _HIVE_LANG_DEFAULT_;}
		// Load Users Prefered Language if none set.
		if($object["user"]->user_loggedIn AND is_array($object["hive_mode"])) {
			$tmp = $object["user"]->user["hive_extradata"];
			$tmp = @unserialize($tmp);
			if(is_array(@$tmp[_HIVE_MODE_])) {
				if(isset($tmp[_HIVE_MODE_]["lang"]) AND @$tmp[_HIVE_MODE_]["lang"] AND @trim(@$tmp[_HIVE_MODE_]["lang"] ?? '') != "") {
					if(@in_array(@$tmp[_HIVE_MODE_]["lang"], _HIVE_LANG_ARRAY_)) {
						$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = @$tmp[_HIVE_MODE_]["lang"];		
					}
				}
			}
		} unset($tmp); 
		// Save in Variable
		define("_HIVE_LANG_", $_SESSION[_HIVE_SITE_COOKIE_."hive_language"]);
		// Load Default Language File			
		$object["lang_tmp_def"] = new x_class_lang(false, false, false, false, $object["path"]."/_core/_lang/en.php");  
		// Load and merge Language
		if(is_array($object["hive_mode"])) {
			$object["lang"] = new x_class_lang(false, false, false, false, _HIVE_SITE_PATH_."/_lang/"._HIVE_LANG_.".php"); 	 
			foreach($object["lang_tmp_def"]->array as $key => $value) {	
				if(@!$object["lang"]->array[$key]) { $object["lang"]->array[$key] = $value; }
			} unset($object["lang_tmp_def"]); 
			$object["lang_tmp"] = new x_class_lang($object["mysql"], _TABLE_LANG_, @$_SESSION[_HIVE_SITE_COOKIE_."hive_language"], _HIVE_MODE_, false);
			foreach($object["lang_tmp"]->array as $key => $value) { 
				$object["lang"]->array[$key] = $value;
			}
			unset($object["lang_tmp"]);
		} else {
			$object["lang"] = new x_class_lang(false, false, false, false, $object["path"]."/_core/_lang/en.php"); 
		} unset($tmp); unset($object["lang_tmp_def"]);

	#################################################################################################################################################
	// Theme Initializations	
	#################################################################################################################################################
		if(!defined("_HIVE_THEME_ARRAY_")) 			{ define("_HIVE_THEME_ARRAY_", 			array()); }
		if(!defined("_HIVE_THEME_DEFAULT_")) 		{ define("_HIVE_THEME_DEFAULT_", 		false); }
		// Check for Validity
		if(isset($_SESSION[_HIVE_SITE_COOKIE_."hive_theme"])) {
			if(@in_array(@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"], _HIVE_THEME_ARRAY_)) {
			} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] = _HIVE_THEME_DEFAULT_; }
		} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] = _HIVE_THEME_DEFAULT_; }
		// If logged in restore Failsafed Theme on Site Module
		if($object["user"]->user_loggedIn AND is_array($object["hive_mode"])) {
			$tmp = $object["user"]->user["hive_extradata"];
			$tmp = @unserialize($tmp);
			if(is_array(@$tmp[_HIVE_MODE_])) {
				if(isset($tmp[_HIVE_MODE_]["theme"]) AND @$tmp[_HIVE_MODE_]["theme"] AND @trim(@$tmp[_HIVE_MODE_]["theme"] ?? '') != "") {
					if(@in_array(@$tmp[_HIVE_MODE_]["theme"], _HIVE_THEME_ARRAY_)) {
						$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] = @$tmp[_HIVE_MODE_]["theme"];				
					}
				}
			}
		} define("_HIVE_THEME_", $_SESSION[_HIVE_SITE_COOKIE_."hive_theme"]); unset($tmp);

	#################################################################################################################################################
	// Color Initializations	
	#################################################################################################################################################
		if(!defined("_HIVE_THEME_COLOR_DEFAULT_")) 	{ define("_HIVE_THEME_COLOR_DEFAULT_", 	"#FFFF00"); }
		if(isset($_SESSION[_HIVE_SITE_COOKIE_."hive_color"])) {
		} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_color"] = _HIVE_THEME_COLOR_DEFAULT_; }
		if($object["user"]->user_loggedIn AND is_array($object["hive_mode"])) {
			$tmp = $object["user"]->user["hive_extradata"];
			$tmp = @unserialize($tmp);
			if(is_array(@$tmp[_HIVE_MODE_])) {
				if(isset($tmp[_HIVE_MODE_]["color"]) AND @$tmp[_HIVE_MODE_]["color"] AND @trim(@$tmp[_HIVE_MODE_]["color"] ?? '') != "") {
					$_SESSION[_HIVE_SITE_COOKIE_."hive_color"] = @$tmp[_HIVE_MODE_]["color"];				
				}
			}
		} define("_HIVE_COLOR_", $_SESSION[_HIVE_SITE_COOKIE_."hive_color"]); unset($tmp);

	#################################################################################################################################################
	// Robots.TXT for Website if Configured
	#################################################################################################################################################
		if(!file_exists($object["path"]."/robots.txt")) {
			file_put_contents($object["path"]."/robots.txt", 
"Sitemap: "._HIVE_URL_REL_."sitemap.xml
User-Agent: *
Disallow: "._HIVE_URLC_REL_."_api/*
Disallow: "._HIVE_URLC_REL_."_core/*
Disallow: "._HIVE_URLC_REL_."_cron/*
Disallow: "._HIVE_URLC_REL_."_data/*
Disallow: "._HIVE_URLC_REL_."_disabled/*
Disallow: "._HIVE_URLC_REL_."_image/*
Disallow: "._HIVE_URLC_REL_."_script/*
Disallow: "._HIVE_URLC_REL_."_site/*
Disallow: "._HIVE_URLC_REL_."_store/*
Disallow: "._HIVE_URLC_REL_."cfg_ruleset.php
Disallow: "._HIVE_URLC_REL_."README.md
Disallow: "._HIVE_URLC_REL_."LICENSE.md
Disallow: "._HIVE_URLC_REL_."cfg_ruleset_sample.php
Disallow: "._HIVE_URLC_REL_."updater.php
Disallow: "._HIVE_URLC_REL_."installer.php
Disallow: "._HIVE_URLC_REL_."developer.php");
		}		
		
	#################################################################################################################################################
	// Create HTAccess File
	#################################################################################################################################################
		if(!file_exists($object["path"]."/.htaccess")) {	
			file_put_contents($object["path"]."/.htaccess", 
"###############################################################
# HTcess File of bugfishCMS Instance
# Changes will be persistent!
###############################################################
## Enable Rewriting - Do not comment this out!
RewriteEngine On

###############################################################
## HTTP -> HTTPS Rewrite
## Remove comment below to activate automatic HTTPS Rewriting if non HTTPS
#	RewriteCond %{HTTPS} !=on
#	RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

###############################################################
## Non-WWW -> WWW Rewrite
## Remove comment below to activate automatic non www to www forward
## Do not use together with WWW -> Non-WWW Rewrite
#	RewriteCond %{HTTP_HOST} ^[^.]+\.[^.]+$
#	RewriteRule ^(.*)$ http://www.%{HTTP_HOST}/$1 [L,R=301]	

###############################################################
## WWW -> Non WWW Rewrite
## Remove comment below to activate automatic non www to www forward
## Do not use together with Non-WWW -> WWW Rewrite
#	RewriteCond %{HTTP_HOST} ^www\.(.*)$ [NC]
#	RewriteRule ^(.*)$ https://%1/$1 [R=301,L]
	
###############################################################
## SEO Url Rewrite
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?hive__seo_tag_loc=$1 [L,QSA]

###############################################################
## Use mod_expires ?
## Comment out to use mod_expires if activated on your
## Apache Server instance.
#	<IfModule mod_expires.c>
#	  ExpiresActive On
#	   ExpiresByType image/jpeg \"access plus 1 year\"
#	   ExpiresByType image/gif \"access plus 1 year\"
#	   ExpiresByType image/png \"access plus 1 year\"
#	   ExpiresByType image/webp \"access plus 1 year\"
#	   ExpiresByType image/svg+xml \"access plus 1 year\"
#	   ExpiresByType image/x-icon \"access plus 1 year\" 
#	 
#	   ExpiresByType video/webm \"access plus 1 year\"
#	   ExpiresByType video/mp4 \"access plus 1 year\"
#	   ExpiresByType video/mpeg \"access plus 1 year\"
#
#	   ExpiresByType font/ttf \"access plus 1 year\"
#	   ExpiresByType font/otf \"access plus 1 year\"
#	   ExpiresByType font/woff \"access plus 1 year\"
#	   ExpiresByType font/woff2 \"access plus 1 year\"
#	   ExpiresByType application/font-woff \"access plus 1 year\"
#
#	   ExpiresByType text/css \"access plus 1 month\"
#	   ExpiresByType text/javascript \"access plus 1 month\"
#	   ExpiresByType application/javascript \"access plus 1 month\"
#
#	   ExpiresByType application/pdf \"access plus 1 month\"
#	   ExpiresByType image/vnd.microsoft.icon \"access plus 1 year\"
#	</IfModule>	

###############################################################
## Disable Directory Browsing for Security Purposes
Options -Indexes

###############################################################
## Lock Configuration Files
<Files \"settings.php\">  
  Order Allow,Deny
  Deny from all
</Files>
<Files \"settings_sample.php\">  
  Order Allow,Deny
  Deny from all
</Files>
<Files \"cfg_ruleset.php\">  
  Order Allow,Deny
  Deny from all
</Files>
<Files \".htaccess\">  
  Order Allow,Deny
  Deny from all
</Files>
<Files \"cfg_ruleset_sample.php\">  
  Order Allow,Deny
  Deny from all
</Files>

###############################################################
## Custom Error Pages
## Comment this out if you dont want custom error pages to be used
ErrorDocument 400 "._HIVE_URLC_REL_."_core/_error/error.400.php
ErrorDocument 401 "._HIVE_URLC_REL_."_core/_error/error.401.php
ErrorDocument 403 "._HIVE_URLC_REL_."_core/_error/error.403.php
ErrorDocument 404 "._HIVE_URLC_REL_."_core/_error/error.404.php
ErrorDocument 500 "._HIVE_URLC_REL_."_core/_error/error.500.php
ErrorDocument 503 "._HIVE_URLC_REL_."_core/_error/error.503.php

###############################################################
## Lock Folders which should not be public accessible
## Do not comment this out (Seperate with |)
RewriteRule ^(_disabled) - [F,L]"); }	

	#################################################################################################################################################
	// Unset Constant Fixes
	#################################################################################################################################################
		if(!defined("_HIVE_TITLE_")) { define('_HIVE_TITLE_', "CMS"); }
		if(!defined("_UPDATER_TITLE_")) { define("_UPDATER_TITLE_", "Module"); }
		if(!defined("_HIVE_SITE_URL_")) { define('_HIVE_SITE_URL_', _HIVE_URL_REL_); }
		define("_HIVE_SITE_REL_", _HIVE_URL_REL_."_site/"._HIVE_MODE_."/");
		define("_HIVE_SITEC_REL_", _HIVE_URLC_REL_."_site/"._HIVE_MODE_."/");
		if(!defined("_HIVE_JS_ACTION_ACTIVE_")) { define("_HIVE_JS_ACTION_ACTIVE_", false); }

	#################################################################################################################################################
	// Load Global Configurations from Site Modules (Post Configuration)
	#################################################################################################################################################		
		if(!defined("_HIVE_CRIT_ER_"))  {
			if(is_array(_HIVE_MODE_ARRAY_))  {
				foreach(_HIVE_MODE_ARRAY_ as $key => $value) {
					$realpath = _HIVE_SITE_PATH_."/".$value."/";
					if (file_exists($realpath."/_config/global_post.php")) {
						$object["hive_mode_config"] = array(); 
						$object["hive_mode_config"]["info"]   = hive__require_x($realpath."/version.php");
						$object["hive_mode_config"]["path"]   = $realpath;
						$object["hive_mode_config"]["name"]   = basename($realpath);
						$object["hive_mode_config"]["prefix"] = _HIVE_COOKIE_."_".$value."_";
						$object["hive_mode_config"]["cookie"] = _HIVE_COOKIE_."_".$value."_";
						require_once($value."/_config/global_post.php");
					}
				}
			}
		} unset($object["hive_mode_config"]);

	#################################################################################################################################################
	// Instance Settings Post
	#################################################################################################################################################
		if(!defined("_HIVE_CRIT_ER_")) { 
			if(file_exists($object["path"]."/_site/"._HIVE_MODE_."/_config/config_post.php")) { 
				require_once($object["path"]."/_site/"._HIVE_MODE_."/_config/config_post.php"); 
			} 
			// Extension Libraries
			foreach (_HIVE_SITE_EXT_ as $hive_extension_loader_current_init) {
				if (file_exists($hive_extension_loader_current_init."/_config/config_post.php")) {
					$object["extension"] = array(); 
					$object["extension"]["info"]   = hive__require_x($hive_extension_loader_current_init."/version.php");
					$object["extension"]["path"]   = $hive_extension_loader_current_init;
					$object["extension"]["name"]   = basename($hive_extension_loader_current_init);
					$object["extension"]["prefix"] = _HIVE_PREFIX_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
					$object["extension"]["cookie"] = _HIVE_COOKIE_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
					require_once $hive_extension_loader_current_init."/_config/config_post.php";
				}
			} unset($object["extension"]);	
		}	
		
	#################################################################################################################################################
	// API Define Variables for Default Scripts
	#################################################################################################################################################
		if(!defined("_HIVE_ACTION_MAILCHANGE_EXEC_")) { define("_HIVE_ACTION_MAILCHANGE_EXEC_", false); } 
		if(!defined("_HIVE_ACTION_RECOVER_EXEC_")) { define("_HIVE_ACTION_RECOVER_EXEC_", false); } 
		if(!defined("_HIVE_ACTION_LOGIN_EXEC_")) { define("_HIVE_ACTION_LOGIN_EXEC_", false); } 
		if(!defined("_HIVE_ACTION_ACTIVATE_EXEC_")) { define("_HIVE_ACTION_ACTIVATE_EXEC_", false); } 
		if(!defined("_HIVE_ACTION_REGISTER_EXEC_")) { define("_HIVE_ACTION_REGISTER_EXEC_", false); } 