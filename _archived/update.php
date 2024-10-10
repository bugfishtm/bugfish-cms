<?php
	/* 	__________ ____ ___  ___________________.___  _________ ___ ___  
		\______   \    |   \/  _____/\_   _____/|   |/   _____//   |   \ 
		 |    |  _/    |   /   \  ___ |    __)  |   |\_____  \/    ~    \
		 |    |   \    |  /\    \_\  \|     \   |   |/        \    Y    /
		 |______  /______/  \______  /\___  /   |___/_______  /\___|_  / 
				\/                 \/     \/                \/       \/  	
							www.bugfish.eu
							
	    Bugfish Fast PHP Page Framework
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
	*/
	if(!is_array($object)) { @http_response_code(404); Header("Location: ../"); exit(); } 
	if(!hive__access($object, "admin_system", false)) {
		define("_ADM_ERROR_401_", "true");
	} else {	
		$_SESSION[_HIVE_SITE_COOKIE_."section_admin_change"] = _HIVE_MODE_;
		adminbsb_header($object);
		adm_styling_head($object["lang"]->translate("adm_nav_system_info"), $object["lang"]->translate("adm_nav_system_info_exp"));	
		
		

		// Core Version Informations
		echo hive__adminbsb_box_start("<h2>".$object["lang"]->translate("adm_nav_system_info_c")."</h2>");
			$curl = adm_store_curl_array(_HIVE_SERVER_CORE_."/_store/core.php");
			if(is_array($curl)) {
				$curl = substr($curl[0], 0, strpos($curl[0], "_"));
				$avver = $curl;
			} else {
				$avver = false;
			}
			
			if($avver) { 
				if($avver == $object["core_mode"]["version"]) { 
					echo '<div class="alert alert-success">'.$object["lang"]->translate("adm_nav_system_info_curd").'</div>';
				} else {
					echo '<div class="alert alert-warning">'.$object["lang"]->translate("adm_nav_system_info_cuwd").'</div>';
				}
			} else {
				echo '<div class="alert alert-danger">'.$object["lang"]->translate("adm_nav_system_info_cuerr").'</div>';
			}
			
			echo '<b>'.$object["lang"]->translate("adm_nav_system_info_cver").'</b>: ';
			echo htmlspecialchars($object["core_mode"]["version"]);
			echo '<br />';
			if($avver) { 	echo '<b>'.$object["lang"]->translate("adm_nav_system_info_cverav").'</b>: ';
							echo htmlspecialchars($avver);
							echo '<br />'; }
			echo '<b>'.$object["lang"]->translate("adm_nav_system_info_cserver").'</b>: ';
			echo htmlspecialchars(_HIVE_SERVER_CORE_);
			echo '<br />';
		
		
		echo hive__adminbsb_box_end();
		
		// Framework Version Informations
		echo hive__adminbsb_box_start("<h2>".$object["lang"]->translate("adm_nav_system_info_f")."</h2>");
			echo '<div class="alert adm_accent_box">'.$object["lang"]->translate("adm_nav_system_info_finfo").'</div>';
			$temp = new x_class_version();
			echo '<b>'.$object["lang"]->translate("adm_nav_system_info_fautor").'</b>: ';
			echo $temp->autor;
			echo '<br />';
			echo '<b>'.$object["lang"]->translate("adm_nav_system_info_fcontact").'</b>: ';
			echo $temp->contact;
			echo '<br />';
			echo '<b>'.$object["lang"]->translate("adm_nav_system_info_fver").'</b>: ';
			if($temp->beta) { $v = $temp->version."-beta"; } else { $v = $temp->version; }
			echo $temp->version;
			echo '<br />';
			echo '<b>'.$object["lang"]->translate("adm_nav_system_info_fgithub").'</b>: ';
			echo $temp->github;
			echo '<br />';
			echo '<b>'.$object["lang"]->translate("adm_nav_system_info_fwebsite").'</b>: ';
			echo $temp->website;
			echo '<br />';
		echo hive__adminbsb_box_end();
		
		// Administration Interface Information
		echo hive__adminbsb_box_start("<h2>".$object["lang"]->translate("adm_nav_system_info_i")."</h2>");
		

		
		echo hive__adminbsb_box_end();
	} 