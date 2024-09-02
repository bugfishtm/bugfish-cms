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
			Stylesheet Loader file to load Files out of Site Module Directory 
			reltated to current active site mode into this file to be included in 
			the website. You can include this stylesheet in your site modules header
			and it will include all your _css/css.* files and extension css files
			automatically.
	*/
	// Include Settings.php
	if(file_exists("../settings.php")) { require_once("../settings.php"); }
		else { echo "/* This CMS is not yet installed. Please install this CMS by visiting the websites root folder! */"; }
	  
	// Cache Setup
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	  
	// Content is Text/CSS
	header('Content-Type: text/css'); 
  
    // Include Necessary CSS Files into this File
	foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_css/css.*") as $filename){ 
		hive__require_once($object, $filename); 
	}
	
	// Include Extension Scripts
	foreach (_HIVE_SITE_EXT_ as $filename) {
		if (is_dir($filename."/_css")) {
			$object["extension"] = array(); 
			$object["extension"]["info"]   = hive__require_x($filename."/version.php");
			$object["extension"]["path"]   = $filename;
			$object["extension"]["name"]   = basename($filename);
			$object["extension"]["prefix"] = _HIVE_PREFIX_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
			$object["extension"]["cookie"] = _HIVE_COOKIE_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
			foreach (glob($filename."/_css/css.*") as $filenamex){ 
				hive__require_once($object, $filenamex);
			}
		}	
	} unset($object["extension"]);
	  
	// Include Framework CSS File
	hive__require_once($object, "./_framework/css/xcss_xfpe.css"); 