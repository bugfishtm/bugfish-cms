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
			Core Library File to be auto-included on CMS Initialization if
			stated in initialize.php.in _core.
	*/ if(!is_array(@$object)) { @http_response_code(@404); @Header("Location: ../"); exit(); }
	#################################################################################################################################################
	// File Include Functionalities
	#################################################################################################################################################	
		function hive__require_once($object, $filepath) { require_once($filepath); return true; }
		function hive__require($object, $filepath) { require($filepath); return true; }
		function hive__require_x($filepath) {
			if(file_exists($filepath."/version.php")) {
				require($filepath);
				return $x;
			} else { return false; }}

	#################################################################################################################################################
	// Check for Local or Remote Global Permissions (OR PERMISSION CHECK)
	#################################################################################################################################################
		function hive__access($object, $rights_local, $global_search = false) {
			// Initial CMS User is always Superadmin
			if(@$object["user"]->user["user_initial"] == 1) { return true; }
			// Permission Checks
			if($global_search) { 
				// Check for Global Permissions
				if(!is_array($rights_local)) { $rights_local = array($rights_local); }
				// Check for Permission and Return
				if(is_array($rights_local)) {
					foreach($rights_local AS $key => $value) {
						// Does user have perm himself?
						if($object["user_perm_glob"]->has_perm($value)) { return true; }
						// Obtain Group Permission
						foreach($object["user_group"] as $groupkey => $groupvalue) { 
							if($groupvalue["perm_group_glob"]->has_perm($value)) { return true; }
						}
					}
				} return false;
			} else {
				// Check for Local Permissions
				if(!is_array($rights_local)) { $rights_local = array($rights_local); }
				// Check for Permission and Return
				if(is_array($rights_local)) {
					foreach($rights_local AS $key => $value) {
						// Does user have perm himself?
						if($object["user_perm"]->has_perm($value)) { return true; }
						// Obtain Group Permission
						foreach($object["user_group"] as $groupkey => $groupvalue) { 
							if($groupvalue["perm_obj"]->has_perm($value)) { return true; }
						}
					}
				} return false;
			}
		}

	#################################################################################################################################################
	// Set User Logged In Related Values
	#################################################################################################################################################
		function hive__user_lang_set($object, $user_id, $mode, $theme_name) {
			if(is_numeric($user_id) AND @in_array(@$theme_name, _HIVE_LANG_ARRAY_)) {
				$x = $object["user"]->get($user_id);
				$tmp = @unserialize($x["hive_extradata"]);
				$tmp[$mode]["lang"] = $theme_name;
				$tmp = serialize($tmp);
				$bind[0]["value"] = $tmp;
				$bind[0]["type"] = "s";
				$object["mysql"]->query("UPDATE "._TABLE_USER_." SET hive_extradata = ? WHERE id = '".$user_id."'", $bind);
				return true;
			} return false;
		}
		function hive__user_theme_set($object, $user_id, $mode, $theme_name) {
			if(is_numeric($user_id) AND @in_array(@$theme_name, _HIVE_THEME_ARRAY_)) {
				$x = $object["user"]->get($user_id);
				$tmp = @unserialize($x["hive_extradata"]);
				$tmp[$mode]["theme"] = $theme_name;
				$tmp = serialize($tmp);
				$bind[0]["value"] = $tmp;
				$bind[0]["type"] = "s";
				$object["mysql"]->query("UPDATE "._TABLE_USER_." SET hive_extradata = ? WHERE id = '".$user_id."'", $bind);
				return true;
			} return false;
		}	
		function hive__user_theme_sub_set($object, $user_id, $mode, $theme_name) {
			if(is_numeric($user_id)) {
				$x = $object["user"]->get($user_id);
				$tmp = @unserialize($x["hive_extradata"]);
				$tmp[$mode]["theme_sub"] = $theme_name;
				$tmp = serialize($tmp);
				$bind[0]["value"] = $tmp;
				$bind[0]["type"] = "s";
				$object["mysql"]->query("UPDATE "._TABLE_USER_." SET hive_extradata = ? WHERE id = '".$user_id."'", $bind);
				return true;
			} return false;
		}	
		function hive__user_color_set($object, $user_id, $mode, $theme_name) {
			if(is_numeric($user_id)) {
				$x = $object["user"]->get($user_id);
				$tmp = @unserialize($x["hive_extradata"]);
				$tmp[$mode]["color"] = $theme_name;
				$tmp = serialize($tmp);
				$bind[0]["value"] = $tmp;
				$bind[0]["type"] = "s";
				$object["mysql"]->query("UPDATE "._TABLE_USER_." SET hive_extradata = ? WHERE id = '".$user_id."'", $bind);
				return true;
			} return false;
		}		

	#################################################################################################################################################
	// Quick and Easy Functions
	#################################################################################################################################################	
		function hive__trim($string) {
			return trim($string ?? '');
		}
		function hive__hsc($string) {
			return htmlspecialchars($string ?? '');
		}
		function hive__hen($string) {
			return htmlentities($string ?? '');
		}

	#################################################################################################################################################
	// Folder Functions
	#################################################################################################################################################
		function hive__folder_create($folderpath, $forwardfile = false, $denie_access = false, $chmode = 0770) {
			if(!is_dir($folderpath)) {  @mkdir($folderpath, $chmode, true); }
			if(is_dir($folderpath)) {
				if($forwardfile) {
					if(!file_exists($folderpath."/index.php")) { 
						file_put_contents($folderpath."/index.php", "<?php
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
			Redirect to previous directory in Folder Structure.
	*/
	@http_response_code(404);
	Header(\"Location: ../\");");
					}
				}
				if($denie_access) { x_htaccess_secure($folderpath); }
			}
		}	
		
	#################################################################################################################################################
	// Extension Functionalities
	#################################################################################################################################################		
		function hive__extension_path($hive_mode) {
			$array = array();
			if(is_dir(_HIVE_PATH_."/_data/".$hive_mode."/_extension")) { 
				foreach (glob(_HIVE_PATH_."/_data/".$hive_mode."/_extension/*") as $filename) {
					if(is_dir($filename)) { 
						array_push($array, $filename);
					}
				}		
			} return $array;	
		}

	#################################################################################################################################################
	// URL Functionalities
	#################################################################################################################################################
		function  hive__url($array) {
			$url_rel = _HIVE_URL_REL_."";
			if(_HIVE_URL_SEO_) {
				foreach($array as $key => $value) {
					if($value == false) { break;}
					if($key == 0) {  } else {$url_rel .= "/";  }
					if(@is_string(@_HIVE_URL_GET_[$key]) AND @is_string($value)) { $url_rel .= $value; }}
			} else {
				foreach($array as $key => $value) {
					if($value == false) { break;}
					if($key == 0) { $url_rel .= "?"; } else {$url_rel .= "&";  }
					if(@is_string(@_HIVE_URL_GET_[$key]) AND @is_string($value)) { $url_rel .= _HIVE_URL_GET_[$key]."=".$value; }
				}}
				if(substr($url_rel, 0, 1) == "?") { return "/".$url_rel;}
			return $url_rel;}

	#################################################################################################################################################
	// Full Error Page to Include per Function
	#################################################################################################################################################		
		function hive__error($title, $subtitle, $description, $exit, $code) { 
			if(is_numeric($code)) { @http_response_code($code); }
		?><!DOCTYPE html>
		<html>
		<head>
			<title><?php echo $title; ?><?php if(defined("_HIVE_TITLE_SPACER_")) { echo _HIVE_TITLE_SPACER_; } else { echo " - "; } ?><?php if(defined("_HIVE_TITLE_")) { echo _HIVE_TITLE_; } else { echo "CMS"; } ?></title>
			<meta charset="UTF-8">
			<meta name="robots" content="noindex, nofollow">
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1" />
			<link rel="icon" href="data:image/png;base64,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AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKAAAADAAAABgAAAAAQAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABISEv8SEhL/EhIS/xISE/8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISE/8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISE/8SEhL/EhIS/xISEv8SEhL/EhIS/xISE/8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISEv8SEhL/EhIS/xISE/8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SExL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xEVHf8OKF//DS93/w0vd/8NL3f/DS93/w0vd/8NL3f/DS93/w0tcP8RGjD/EhIT/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISE/8SEhL/EhIS/xISEv8SExL/EhIS/xISEv8SExL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/w8mWP8IVPr/CFb//whW//8IVv//CFb//whW//8IV///CFb//whW/v8MOp3/EhQa/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISE/8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ERUc/xEWIv8SEhL/EhIS/xISEv8SExL/EhIS/w4sa/8IVv//CFb//whW//8IVv//CFb//whW//8IVv//CFb//whW//8LPq3/ERYe/xISEv8SEhL/EhIS/xISEv8SFBv/ERYf/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISEv8SEhL/EhIS/xISFP8QIUj/CU3h/wlQ7P8PJ13/EhMV/xISEv8SEhL/EhIS/w4sa/8IVv//CFb//xAZKf8RFR7/ERUe/xEVHv8RFR7/CkvZ/whW//8LPq3/EBYe/xISEv8SEhL/EhIS/xAcNf8KRMP/CFT6/w4rav8SFBj/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xAgRP8KSM//CVb+/whW/v8JTd//Dydd/xISEv8SEhL/ERou/ww4l/8IVv//CFb//xEVH/8SEhL/ExIS/xISEv8SEhL/CkvX/whW//8KRcX/ECBE/xISFP8SEhL/EB46/wpFxP8IVv//CFb//wlR7v8OLW//EhQY/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EB05/wlN3/8IV/7/CFb//whV/f8IVv//CVHt/w4rbf8MN5P/CEzc/whT9f8IVv//CFb//xEVHv8SEhL/EhIS/xISEv8SEhL/CkvX/whW/v8IVPn/CU/m/wtAtP8OK2v/CknR/whW//8IVv7/CFb//whW/v8JUe7/Dyhg/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISE/8QHz//CUzd/whW//8IU/b/DTWM/w4qZv8JUO7/CFb//whW//8IVv//CFb//whU+f8JUOj/C0Cx/xISEv8SEhL/EhIS/xISEv8SExL/DTOH/wlO5P8IU/T/CFb+/whW//8IVv//CFb//whU+/8MOp3/Ditr/wlR7v8IVv//CFT5/w4nXv8SExf/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xAePv8KRsn/CFb+/whT9v8MNY7/ERUd/xIUGP8OLXL/CVLw/whW//8IU/T/C0K6/w4wef8QIUb/EhQa/xISEv8SEhL/EhIS/xISEv8SExL/EhIU/xAdOf8OK2r/DDym/wlQ6v8IVv//CFb+/ww6nv8RGCf/EhIS/w8oYf8JTuP/CFb//wlQ7P8OKmj/EhMX/xISEv8SEhL/ExIS/xISE/8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/ERov/wpL2v8IVv7/CFb//ww4mP8RFR7/EhIS/xISEv8SFBn/Dilj/ws+q/8PJln/ERcj/xISE/8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhUd/xAePv8MOJf/DTF+/xEVHv8SEhL/EhIS/xITFv8OK2X/CVHv/whW//8JUOn/DyVV/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/Cjuh/whW//8IVv//C0G2/xISFf8SEhL/EhIS/zg5Of87Ozv/FBQU/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/zMzM/8/Pz//FBQU/xISEv8SEhP/DTOF/whW/v8IVv//CknS/xISEv8SEhL/EhIS/xIS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Ev8SExL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/Hx8f/3J0df9nbHX/Fxoh/xISEv8SEhL/EhIS/xISEv8SFBr/DTKC/whW//8IVv//CkfK/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ERot/wtBt/8IVv7/CFb//ws8pv8RGSr/EhIS/xISEv8RFR//DTKC/wtDvP8NMX//ERsw/xISEv8SExL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/ERYh/w4qZv8LP67/DDqf/xEZK/8SEhL/EhIS/xIUGf8NL3n/CFLy/whW//8JStf/DyNM/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xEaLv8KQ7z/CFb//whV+/8MPKT/ERYf/xIUGf8MNYj/CFP2/whW//8IVPj/CU3h/ww6nv8QIkj/EhMW/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xEbMv8NM4T/C0nT/whS8v8IVv//CFb+/wpEwP8RGSr/EhIS/w4tb/8IU/H/CFb//wlP6P8PJVH/EhMU/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8QHDX/CkfL/whW//8IVv7/DDeU/w0we/8IVPn/CFb//wlS8P8IU/b/CFb//whW//8IVv//CkTB/xISFP8SExL/EhIS/xISEv8SEhL/DDaS/whW//8IVv//CFb//whV/P8JUe//CFX8/whW/f8LPq3/DS92/whV/f8IVv//CVDq/w8lUv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISE/8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EBw1/wpEwP8IVv//CFb+/whV+v8IVv//CkrX/w8nWv8OLnP/CkG0/wlR7P8IVv//CFb//xEVHP8SExL/EhIS/xISEv8SEhL/CkrW/whW//8IUvX/CkbG/w00iP8PJln/C0G4/whW//8IVPz/CVX7/whW//8JTNv/DyZW/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISEv8SEhL/EhIS/xAbM/8KRcT/CFb//whW//8KS9n/EB9C/xISEv8SEhT/ERYh/w0xff8IVv//CFb//xEVH/8SEhL/EhIS/xISEv8SEhL/C0vX/whW/v8LQbj/ERsx/xITFf8SEhL/ERcl/wtCuf8IVv//CFb//wlR7f8PJlz/ExMV/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8QHjr/CkfJ/wpJ0/8PI1D/EhIS/xISEv8SEhL/EhIS/w4sa/8IVv//CVb//xAfPv8QHDX/EBw1/xAcNf8QHDX/CUzd/whW/v8LPq3/ERYe/xISEv8SExL/ExIS/xEXJv8LQbP/CE3f/w8nXv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISE/8SEhL/EhIS/xISEv8SExL/EBcl/xEZK/8SEhL/EhIS/xISE/8SEhL/EhIS/w4sa/8IVv//CFb//whS8f8IUfD/CFHw/whR8P8IUfD/CFX8/whW//8LPq3/ERYe/xISEv8SEhL/EhIS/xISEv8RFiD/ERkq/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/w8lVf8IVfz/CFb//whW//8IVv//CFb//whW/v8IVv//CFb//whW/v8MOZz/EhQZ/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISE/8SEhL/EhIS/xISEv8SEhL/EhIS/xISE/8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xIUGP8PI1D/Dipo/w4qaP8OK2j/Dipo/w4qaP8OKmj/Dipo/w4oYP8RGSf/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISE/8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA==">
			<style type="text/css">
				body { text-align: center; padding: 10%; font: 20px Helvetica, sans-serif; color: #333; }
				h1 { font-size: 50px; margin: 0; }
				article { display: block; text-align: left; max-width: 650px; margin: 0 auto; }
				a { color: #FF5707; text-decoration: none; }
				a:hover { color: #333; text-decoration: none; }
				@media only screen and (max-width : 480px) {
					h1 { font-size: 40px; }
				}
			</style>
		</head>
			<body>
				<article>
					<h1><?php echo $title; ?></h1>
					<p><?php echo $subtitle; ?> <?php echo $description; ?></p>
					<p><a href="/">Back to Home</a></p>
				</article>
		</body></html><?php if($exit) { exit(); } }		

	#################################################################################################################################################
	// Default Login and User Token Functionalities
	#################################################################################################################################################			
		function hive__template_mail_activate($object, $get_token = "ref_token", $get_user = "ref_user", $message = true, $redirect = false) {
			$code = false;
			if(is_numeric(@$_GET[$get_user]) AND is_numeric(@$_GET[$get_token])) {
				if(!$object["ipbl"]->banned()) { 
					$code = $object["user"]->mail_edit_confirm(@$_GET[$get_user], @$_GET[$get_token]);
					if($code == 1) { if($message) { $object["eventbox"]->ok($object["lang"]->translate("hive_login_msg_m_ok"));  }}
					if($code == 2) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_er")); }}
					if($code == 3) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_exp")); }}
					if($code == 4) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_res")); }}
					if($code == 5) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_block")); }}
					if($code == 6) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_res")); }}
			} else { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_ipban")); } $code = "banned";} } 
			if($redirect) { Header("Location: ".$redirect.""); exit(); } return $code; }
			
		function hive__template_user_activate($object, $get_token = "ref_token", $get_user = "ref_user", $message = true, $redirect = false) {
			$code = false;
			if(is_numeric(@$_GET[$get_user]) AND is_numeric(@$_GET[$get_token])) {
				if(!$object["ipbl"]->banned()) { 
					$code = $object["user"]->activation_confirm(@$_GET[$get_user], @$_GET[$get_token]);
					if($code == 1) { if($message) { $object["eventbox"]->ok($object["lang"]->translate("hive_login_msg_a_ok"));  } }
					if($code == 2) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_a_er")); } }
					if($code == 3) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_a_exp")); } }
					if($code == 4) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_a_block")); } }
				} else { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_ipban")); } $code = "banned";}
				} if($redirect) { Header("Location: ".$redirect.""); exit(); } return $code; }
		
		function hive__template_login($object, $cookies_allow = false, $message = true) {
			// Return OK if user is Logged In
			if($object["user"]->user_loggedIn) { return true; }
			// Get the current protocol (http or https)
			$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
			$domain = $_SERVER['HTTP_HOST'];
			$uri = $_SERVER['REQUEST_URI'];
			$current_url = $protocol . $domain . $uri;
			if ($_SERVER['QUERY_STRING']) {
				$current_url .= '?' . $_SERVER['QUERY_STRING'];
			}
			// Login Operation
			if (isset($_POST["loginbutton"])) {
				// Check for IP Ban on Current Login Try
				if(!$object["ipbl"]->banned()) { 
					// Check for Empty Missing Inputs
					if (!empty($_POST["usermail"]) and !empty($_POST["password"])) {
						// Prepare Cookie Allowed Bool Variable
						if(isset($_POST["rememberme"]) AND $cookies_allow) { $stay = true; } else { $stay = false; }
						// Check for CSRF Class Validation of $_post Token is set or Object is not created (csrf)
						if (!is_object($object["csrf"])) { 
						} else {
							if ($object["csrf"]->check($_POST["token"])) {
							} else { if($message) {  $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); } return "csrf"; }	
						}
						// Login Request
						$object["user"]->login_request($_POST["usermail"], $_POST["password"], $stay);	
						// Fetch and Result Operation
						if ($object["user"]->login_request_code == 1) {			
							if($message) { $object["eventbox"]->ok($object["lang"]->translate("hive_login_msg_l_ok")); }
							return $object["user"]->login_request_code;				
						} elseif ($object["user"]->login_request_code == 2) {	
							if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_l_wrong")); }
							return $object["user"]->login_request_code;				
							$object["ipbl"]->increase();	
						} elseif ($object["user"]->login_request_code == 3) {
							if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_l_wrong")); }
							return $object["user"]->login_request_code;				
							$object["ipbl"]->increase();			
						} elseif ($object["user"]->login_request_code == 4) {
							if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_l_blocked")); }	
							return $object["user"]->login_request_code;				
						} elseif ($object["user"]->login_request_code == 5) {
							if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_l_inactive")); }	
							return $object["user"]->login_request_code;				
						} elseif ($object["user"]->login_request_code == 6) {
							if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_l_blockedpwf")); }
							return $object["user"]->login_request_code;						
						} elseif ($object["user"]->login_request_code == 7) {
							if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_l_disabled")); }
							return $object["user"]->login_request_code;								
						} return 8;
					} else { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_empty")); } return "empty"; }
				} else { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_ipban")); } return "banned"; }
			} return false; }	

		function hive__template_recover_request($object, $rec_url = false, $get_token = "rec_token", $get_user = "rec_user") {
			if (isset($_POST["resetbutton"])) {
				if (@trim(@$_POST["mail"]) != "") {	
					// Check for CSRF Class Validation of $_post Token is set or Object is not created (csrf)
					if (!is_object($object["csrf"])) { 
					} else {
						if ($object["csrf"]->check($_POST["token"])) {
						} else { if($message) {  $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); } return "csrf"; }	
					}													
					$object["user"]->recover_request($_POST["mail"]);
					if ($object["user"]->rec_request_code == 1) {
							$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							if($object["mail"]->send($_POST["mail"], $_POST["mail"], $object["lang"]->translate("hive_login_mail_title_rec"), $object["lang"]->translate("hive_login_mail_pre_rec")."<br /><a href='".$current_url."?rec_token=".$object["user"]->mail_ref_token."&rec_user=".$object["user"]->mail_ref_user."'>".$current_url."?rec_token=".$object["user"]->mail_ref_token."&rec_user=".$object["user"]->mail_ref_user."</a>", true, _SMTP_MAILS_FOOTER_, _SMTP_MAILS_HEADER_, false))
							{ return 1; } else { return "errmail"; }
					}
					//if ($object["user"]->rec_request_code == 3) { 
					//	$vartmp = round($object["user"]->recover_request_time($object["user"]->mail_ref_user) / 60, 0);
					//	if($message) {$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_rr_recwait")); }
					//	if($redirect) { Header("Location: ".$redirect.""); exit(); }}
					return @$object["user"]->rec_request_code;
				} else { }
			} return false;  					
		}				
	
	#################################################################################################################################################
	// Default Download Functionalitites
	#################################################################################################################################################

	function hive__download_mimeTypes() { 
		/* Just add any required MIME type if you are going to download something not listed here.*/ 
		$mime_types = array("323" => "text/h323", 
			"acx" => "application/internet-property-stream", 
			"ai" => "application/postscript", 
			"aif" => "audio/x-aiff", 
			"aifc" => "audio/x-aiff", 
			"aiff" => "audio/x-aiff", 
			"asf" => "video/x-ms-asf", 
			"asr" => "video/x-ms-asf", 
			"asx" => "video/x-ms-asf", 
			"au" => "audio/basic", 
			"avi" => "video/x-msvideo", 
			"axs" => "application/olescript", 
			"bas" => "text/plain", 
			"bcpio" => "application/x-bcpio", 
			"bin" => "application/octet-stream", 
			"bmp" => "image/bmp", 
			"c" => "text/plain", 
			"cat" => "application/vnd.ms-pkiseccat", 
			"cdf" => "application/x-cdf", 
			"cer" => "application/x-x509-ca-cert", 
			"class" => "application/octet-stream", 
			"clp" => "application/x-msclip", 
			"cmx" => "image/x-cmx", 
			"cod" => "image/cis-cod", 
			"cpio" => "application/x-cpio", 
			"crd" => "application/x-mscardfile", 
			"crl" => "application/pkix-crl", 
			"crt" => "application/x-x509-ca-cert", 
			"csh" => "application/x-csh", 
			"css" => "text/css", 
			"dcr" => "application/x-director", 
			"der" => "application/x-x509-ca-cert", 
			"dir" => "application/x-director", 
			"dll" => "application/x-msdownload", 
			"dms" => "application/octet-stream", 
			"doc" => "application/msword", 
			"dot" => "application/msword", 
			"dvi" => "application/x-dvi", 
			"dxr" => "application/x-director", 
			"eps" => "application/postscript", 
			"etx" => "text/x-setext", 
			"evy" => "application/envoy", 
			"exe" => "application/octet-stream", 
			"fif" => "application/fractals", 
			"flr" => "x-world/x-vrml", 
			"gif" => "image/gif", 
			"gtar" => "application/x-gtar", 
			"gz" => "application/x-gzip", 
			"h" => "text/plain", 
			"hdf" => "application/x-hdf", 
			"hlp" => "application/winhlp", 
			"hqx" => "application/mac-binhex40", 
			"hta" => "application/hta", 
			"htc" => "text/x-component", 
			"htm" => "text/html", 
			"html" => "text/html", 
			"htt" => "text/webviewhtml", 
			"ico" => "image/x-icon", 
			"ief" => "image/ief", 
			"iii" => "application/x-iphone", 
			"ins" => "application/x-internet-signup", 
			"isp" => "application/x-internet-signup", 
			"jfif" => "image/pipeg", 
			"jpe" => "image/jpeg", 
			"jpeg" => "image/jpeg", 
			"jpg" => "image/jpeg", 
			"js" => "application/x-javascript", 
			"latex" => "application/x-latex", 
			"lha" => "application/octet-stream", 
			"lsf" => "video/x-la-asf", 
			"lsx" => "video/x-la-asf", 
			"lzh" => "application/octet-stream", 
			"m13" => "application/x-msmediaview", 
			"m14" => "application/x-msmediaview", 
			"m3u" => "audio/x-mpegurl", 
			"man" => "application/x-troff-man", 
			"mdb" => "application/x-msaccess", 
			"me" => "application/x-troff-me", 
			"mht" => "message/rfc822", 
			"mhtml" => "message/rfc822", 
			"mid" => "audio/mid", 
			"mny" => "application/x-msmoney", 
			"mov" => "video/quicktime", 
			"movie" => "video/x-sgi-movie", 
			"mp2" => "video/mpeg", 
			"mp3" => "audio/mpeg", 
			"mpa" => "video/mpeg", 
			"mpe" => "video/mpeg", 
			"mpeg" => "video/mpeg", 
			"mpg" => "video/mpeg", 
			"mpp" => "application/vnd.ms-project", 
			"mpv2" => "video/mpeg", 
			"ms" => "application/x-troff-ms", 
			"mvb" => "application/x-msmediaview", 
			"nws" => "message/rfc822", 
			"oda" => "application/oda", 
			"p10" => "application/pkcs10", 
			"p12" => "application/x-pkcs12", 
			"p7b" => "application/x-pkcs7-certificates", 
			"p7c" => "application/x-pkcs7-mime", 
			"p7m" => "application/x-pkcs7-mime", 
			"p7r" => "application/x-pkcs7-certreqresp", 
			"p7s" => "application/x-pkcs7-signature", 
			"pbm" => "image/x-portable-bitmap", 
			"pdf" => "application/pdf", 
			"pfx" => "application/x-pkcs12", 
			"pgm" => "image/x-portable-graymap", 
			"pko" => "application/ynd.ms-pkipko", 
			"pma" => "application/x-perfmon", 
			"pmc" => "application/x-perfmon", 
			"pml" => "application/x-perfmon", 
			"pmr" => "application/x-perfmon", 
			"pmw" => "application/x-perfmon", 
			"pnm" => "image/x-portable-anymap", 
			"pot" => "application/vnd.ms-powerpoint", 
			"ppm" => "image/x-portable-pixmap", 
			"pps" => "application/vnd.ms-powerpoint", 
			"ppt" => "application/vnd.ms-powerpoint", 
			"prf" => "application/pics-rules", 
			"ps" => "application/postscript", 
			"pub" => "application/x-mspublisher", 
			"qt" => "video/quicktime", 
			"ra" => "audio/x-pn-realaudio", 
			"ram" => "audio/x-pn-realaudio", 
			"ras" => "image/x-cmu-raster", 
			"rgb" => "image/x-rgb", 
			"rmi" => "audio/mid", 
			"roff" => "application/x-troff", 
			"rtf" => "application/rtf", 
			"rtx" => "text/richtext", 
			"scd" => "application/x-msschedule", 
			"sct" => "text/scriptlet", 
			"setpay" => "application/set-payment-initiation", 
			"setreg" => "application/set-registration-initiation", 
			"sh" => "application/x-sh", 
			"shar" => "application/x-shar", 
			"sit" => "application/x-stuffit", 
			"snd" => "audio/basic", 
			"spc" => "application/x-pkcs7-certificates", 
			"spl" => "application/futuresplash", 
			"src" => "application/x-wais-source", 
			"sst" => "application/vnd.ms-pkicertstore", 
			"stl" => "application/vnd.ms-pkistl", 
			"stm" => "text/html", 
			"svg" => "image/svg+xml", 
			"sv4cpio" => "application/x-sv4cpio", 
			"sv4crc" => "application/x-sv4crc", 
			"t" => "application/x-troff", 
			"tar" => "application/x-tar", 
			"tcl" => "application/x-tcl", 
			"tex" => "application/x-tex", 
			"texi" => "application/x-texinfo", 
			"texinfo" => "application/x-texinfo", 
			"tgz" => "application/x-compressed", 
			"tif" => "image/tiff", 
			"tiff" => "image/tiff", 
			"tr" => "application/x-troff", 
			"trm" => "application/x-msterminal", 
			"tsv" => "text/tab-separated-values", 
			"txt" => "text/plain", 
			"uls" => "text/iuls", 
			"ustar" => "application/x-ustar", 
			"vcf" => "text/x-vcard", 
			"vrml" => "x-world/x-vrml", 
			"wav" => "audio/x-wav", 
			"wcm" => "application/vnd.ms-works", 
			"wdb" => "application/vnd.ms-works", 
			"wks" => "application/vnd.ms-works", 
			"wmf" => "application/x-msmetafile", 
			"wps" => "application/vnd.ms-works", 
			"wri" => "application/x-mswrite", 
			"wrl" => "x-world/x-vrml", 
			"wrz" => "x-world/x-vrml", 
			"xaf" => "x-world/x-vrml", 
			"xbm" => "image/x-xbitmap", 
			"xla" => "application/vnd.ms-excel", 
			"xlc" => "application/vnd.ms-excel", 
			"xlm" => "application/vnd.ms-excel", 
			"xls" => "application/vnd.ms-excel", 
			"xlt" => "application/vnd.ms-excel", 
			"xlw" => "application/vnd.ms-excel", 
			"xof" => "x-world/x-vrml", 
			"xpm" => "image/x-xpixmap", 
			"xwd" => "image/x-xwindowdump", 
			"z" => "application/x-compress", 
			"rar" => "application/x-rar-compressed", 
			"zip" => "application/zip"); 
		return $mime_types;                     
	} 	
	
	function hive__download($filePath) {     
		if (!empty($filePath) && file_exists($filePath)) 
		{ 
			$fileInfo = pathinfo($filePath); 
			$fileName = $fileInfo['basename']; 
			$fileExtension = strtolower($fileInfo['extension']); 
			$defaultContentType = "application/octet-stream"; 
			$contentTypesList = hive__download_mimeTypes(); 
			$contentType = $contentTypesList[$fileExtension] ?? $defaultContentType; 

			$size = filesize($filePath); 
			$offset = 0; 
			$length = $size; 

			if (isset($_SERVER['HTTP_RANGE'])) 
			{ 
				if (preg_match('/bytes=(\d+)-(\d+)?/', $_SERVER['HTTP_RANGE'], $matches)) 
				{ 
					$offset = intval($matches[1]); 
					$length = (isset($matches[2]) ? intval($matches[2]) : $size) - $offset; 
					$length = max($length, 0); 
					$size = $size; 
				} 
				else 
				{ 
					header('HTTP/1.1 400 Invalid Range'); 
					exit; 
				} 
			} 

			// Headers for download
			header('Content-Type: ' . $contentType); 
			header('Content-Disposition: attachment; filename="' . $fileName . '"'); 
			header('Accept-Ranges: bytes'); 
			header('Cache-Control: no-cache, must-revalidate'); 
			header('Pragma: no-cache'); 
			header('Expires: 0'); 

			if ($offset > 0 || $length < $size) 
			{ 
				header('HTTP/1.1 206 Partial Content'); 
				header('Content-Range: bytes ' . $offset . '-' . ($offset + $length - 1) . '/' . $size); 
				header('Content-Length: ' . $length); 
			} 
			else 
			{ 
				header('Content-Length: ' . $size); 
			} 

			// Output file content
			$chunkSize = 8 * 1024 * 1024; // 8MB
			$handle = fopen($filePath, 'rb'); 

			if ($handle === false) 
			{ 
				header('HTTP/1.1 500 Internal Server Error'); 
				exit; 
			} 

			if ($offset > 0) 
			{ 
				fseek($handle, $offset); 
			} 

			while (!feof($handle) && (connection_status() === CONNECTION_NORMAL)) 
			{ 
				echo fread($handle, $chunkSize); 
				ob_flush(); 
				flush(); 
			} 

			fclose($handle); 
		} 
		else 
		{ 
			header('HTTP/1.1 404 Not Found'); 
			echo 'File does not exist or path is empty!'; 
		} 
	}