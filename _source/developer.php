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
			File to easier control core functionalities during development.
		
	*/ if(file_exists("./settings.php")) { require_once("./settings.php"); } else { @http_response_code(404); Header("Location: ./"); exit(); } 
	
	if(!_HIVE_MOD_CHANGES_) { hive__error("Access Error", "Script is deactivated in ruleset.php! Enable _HIVE_MOD_CHANGES_ in ruleset.php or in the _administration interface to enable this files execution!", "", true, 401); }
	
	// Cookie Deletion
	if(@$_GET["operation"] == "cdestroy") { 
		if (isset($_SERVER['HTTP_COOKIE'])) {
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			foreach($cookies as $cookie) {
				$parts = explode('=', $cookie);
				$name = trim($parts[0]);
				setcookie($name, '', time()-1000);
				setcookie($name, '', time()-1000, '/');
			}
		}
		Header("Location: ./developer.php?proc=ok");
		exit();
	}
	
	// Session Deletion	
	if(@$_GET["operation"] == "sdestroy") { 
		session_destroy();
		Header("Location: ./developer.php?proc=ok");
		exit();
	}
	
	// PHPInfo
	if(@$_GET["operation"] == "phpinfo") { 
		echo '<link rel="icon" type="image/x-icon" href="'._HIVE_URL_REL_.'/_core/_image/image.favicon.ico">';
		echo '<title>PHP Informations - CMS</title>';
		echo "<center><a href='./developer.php'>Click here to go back!</a></center>";
		phpinfo();
		exit();
	}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Developer Tools - CMS</title>
		<meta name="robots" content="noindex, nofollow">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="data:image/png;base64,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AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKAAAADAAAABgAAAAAQAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABISEv8SEhL/EhIS/xISE/8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISE/8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISE/8SEhL/EhIS/xISEv8SEhL/EhIS/xISE/8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISEv8SEhL/EhIS/xISE/8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SExL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xEVHf8OKF//DS93/w0vd/8NL3f/DS93/w0vd/8NL3f/DS93/w0tcP8RGjD/EhIT/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISE/8SEhL/EhIS/xISEv8SExL/EhIS/xISEv8SExL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/w8mWP8IVPr/CFb//whW//8IVv//CFb//whW//8IV///CFb//whW/v8MOp3/EhQa/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISE/8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ERUc/xEWIv8SEhL/EhIS/xISEv8SExL/EhIS/w4sa/8IVv//CFb//whW//8IVv//CFb//whW//8IVv//CFb//whW//8LPq3/ERYe/xISEv8SEhL/EhIS/xISEv8SFBv/ERYf/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISEv8SEhL/EhIS/xISFP8QIUj/CU3h/wlQ7P8PJ13/EhMV/xISEv8SEhL/EhIS/w4sa/8IVv//CFb//xAZKf8RFR7/ERUe/xEVHv8RFR7/CkvZ/whW//8LPq3/EBYe/xISEv8SEhL/EhIS/xAcNf8KRMP/CFT6/w4rav8SFBj/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xAgRP8KSM//CVb+/whW/v8JTd//Dydd/xISEv8SEhL/ERou/ww4l/8IVv//CFb//xEVH/8SEhL/ExIS/xISEv8SEhL/CkvX/whW//8KRcX/ECBE/xISFP8SEhL/EB46/wpFxP8IVv//CFb//wlR7v8OLW//EhQY/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EB05/wlN3/8IV/7/CFb//whV/f8IVv//CVHt/w4rbf8MN5P/CEzc/whT9f8IVv//CFb//xEVHv8SEhL/EhIS/xISEv8SEhL/CkvX/whW/v8IVPn/CU/m/wtAtP8OK2v/CknR/whW//8IVv7/CFb//whW/v8JUe7/Dyhg/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISE/8QHz//CUzd/whW//8IU/b/DTWM/w4qZv8JUO7/CFb//whW//8IVv//CFb//whU+f8JUOj/C0Cx/xISEv8SEhL/EhIS/xISEv8SExL/DTOH/wlO5P8IU/T/CFb+/whW//8IVv//CFb//whU+/8MOp3/Ditr/wlR7v8IVv//CFT5/w4nXv8SExf/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xAePv8KRsn/CFb+/whT9v8MNY7/ERUd/xIUGP8OLXL/CVLw/whW//8IU/T/C0K6/w4wef8QIUb/EhQa/xISEv8SEhL/EhIS/xISEv8SExL/EhIU/xAdOf8OK2r/DDym/wlQ6v8IVv//CFb+/ww6nv8RGCf/EhIS/w8oYf8JTuP/CFb//wlQ7P8OKmj/EhMX/xISEv8SEhL/ExIS/xISE/8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/ERov/wpL2v8IVv7/CFb//ww4mP8RFR7/EhIS/xISEv8SFBn/Dilj/ws+q/8PJln/ERcj/xISE/8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhUd/xAePv8MOJf/DTF+/xEVHv8SEhL/EhIS/xITFv8OK2X/CVHv/whW//8JUOn/DyVV/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/Cjuh/whW//8IVv//C0G2/xISFf8SEhL/EhIS/zg5Of87Ozv/FBQU/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/zMzM/8/Pz//FBQU/xISEv8SEhP/DTOF/whW/v8IVv//CknS/xISEv8SEhL/EhIS/xIS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Ev8SExL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/Hx8f/3J0df9nbHX/Fxoh/xISEv8SEhL/EhIS/xISEv8SFBr/DTKC/whW//8IVv//CkfK/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ERot/wtBt/8IVv7/CFb//ws8pv8RGSr/EhIS/xISEv8RFR//DTKC/wtDvP8NMX//ERsw/xISEv8SExL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/ERYh/w4qZv8LP67/DDqf/xEZK/8SEhL/EhIS/xIUGf8NL3n/CFLy/whW//8JStf/DyNM/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xEaLv8KQ7z/CFb//whV+/8MPKT/ERYf/xIUGf8MNYj/CFP2/whW//8IVPj/CU3h/ww6nv8QIkj/EhMW/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xEbMv8NM4T/C0nT/whS8v8IVv//CFb+/wpEwP8RGSr/EhIS/w4tb/8IU/H/CFb//wlP6P8PJVH/EhMU/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8QHDX/CkfL/whW//8IVv7/DDeU/w0we/8IVPn/CFb//wlS8P8IU/b/CFb//whW//8IVv//CkTB/xISFP8SExL/EhIS/xISEv8SEhL/DDaS/whW//8IVv//CFb//whV/P8JUe//CFX8/whW/f8LPq3/DS92/whV/f8IVv//CVDq/w8lUv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISE/8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EBw1/wpEwP8IVv//CFb+/whV+v8IVv//CkrX/w8nWv8OLnP/CkG0/wlR7P8IVv//CFb//xEVHP8SExL/EhIS/xISEv8SEhL/CkrW/whW//8IUvX/CkbG/w00iP8PJln/C0G4/whW//8IVPz/CVX7/whW//8JTNv/DyZW/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISEv8SEhL/EhIS/xAbM/8KRcT/CFb//whW//8KS9n/EB9C/xISEv8SEhT/ERYh/w0xff8IVv//CFb//xEVH/8SEhL/EhIS/xISEv8SEhL/C0vX/whW/v8LQbj/ERsx/xITFf8SEhL/ERcl/wtCuf8IVv//CFb//wlR7f8PJlz/ExMV/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8QHjr/CkfJ/wpJ0/8PI1D/EhIS/xISEv8SEhL/EhIS/w4sa/8IVv//CVb//xAfPv8QHDX/EBw1/xAcNf8QHDX/CUzd/whW/v8LPq3/ERYe/xISEv8SExL/ExIS/xEXJv8LQbP/CE3f/w8nXv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISE/8SEhL/EhIS/xISEv8SExL/EBcl/xEZK/8SEhL/EhIS/xISE/8SEhL/EhIS/w4sa/8IVv//CFb//whS8f8IUfD/CFHw/whR8P8IUfD/CFX8/whW//8LPq3/ERYe/xISEv8SEhL/EhIS/xISEv8RFiD/ERkq/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/w8lVf8IVfz/CFb//whW//8IVv//CFb//whW/v8IVv//CFb//whW/v8MOZz/EhQZ/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISE/8SEhL/EhIS/xISEv8SEhL/EhIS/xISE/8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xIUGP8PI1D/Dipo/w4qaP8OK2j/Dipo/w4qaP8OKmj/Dipo/w4oYP8RGSf/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISE/8SEhL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SExL/ExIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/xISEv8SEhL/EhIS/wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA==">
        <style type="text/css">
            body { text-align: center; padding: 5%; font: 20px Helvetica, sans-serif; color: #333; background: #EEEEEE;  padding-top: 0px; padding-bottom: 25px;  }
            h1 { font-size: 32px; margin: 0; }
            article { display: block; text-align: left; max-width: 650px; margin: 0 auto; padding-top: 15px; margin-top: 15px;}
            a { color: #FF5707; text-decoration: none; }
            a:hover { color: #333; text-decoration: none; }
            @media only screen and (max-width : 480px) {
                h1 { font-size: 26px; }
            }
			.card {
				box-sizing: border-box;
				background: #FFFFFF;
				border-radius: 5px;
				padding: 15px;
				font-size: 14px;
				margin-bottom: 15px;
			}
			
			.btn {
				background: #FF5707;
				background: #EEEEEE;
				color: black;
				padding: 15px;
				border-radius: 5px;
				cursor: pointer;
				border: none;
			}
			
			.btn:hover {
				background: black;
				color: white;
			}
			
			.btn-fr {
				float: right;
			}
			
			table {
				width: 100%;
				border: none;
			}
			table td {
				width: 100%;
			}
			
			table tr:last-child td {
				border-bottom: 0px;
			}
			
			input[type="text"], input[type="number"], input[type="password"] {
				box-sizing: border-box;
				width: 100%;
				border-radius: 5px;
				border-color: #CCCCCC;
				border-style: solid;
				border: 1px solid #CCCCCC;
				padding: 5px;
			}
			
			.containererror {
				padding: 5px; 
				background: red; 
				color: white;
				font-weight: normal;
				border-radius: 5px;
				margin-bottom: 5px;
				margin-top: 5px;
			}
			.containererrorg {
				padding: 5px; 
				background: green; 
				color: white;
				font-weight: normal;
				border-radius: 5px;
				margin-bottom: 5px;
				margin-top: 5px;
			}
        </style>
    </head>
    <body>
        <article>
	
	

	<?php
	
		if(@$_GET["proc"] == "ok") {
			?>
			<div class="card" style="background: lime; color: black;">
					The operation has been executed successfully!	
			</div>			
			<?php
		}
	
	?>

	<div class="card">
			<b style='font-size:36px; padding-bottom: 10px;'>Backend Tools</b><br />
			Empower your browsing experience with personalized control through our user-centric settings customization feature. Modify website settings exclusively for your sessions, ensuring that changes remain confined to your individual preferences without any impact on global configurations. These developer tools provide a comprehensive suite for inspecting various backend functionalities, facilitating a more streamlined understanding and navigation during the development process. For optimal usage, consider disabling this functionality by turning off HIVE_MOD_CHANGES in ruleset.php or utilizing an associated admin interface designed for this purpose. Your seamless browsing experience starts with tailored settings and efficient developer tools.<br />	
	</div>
	<div class="card">
		<b>Operational URLs:</b><br />Explore a suite of invaluable backend tools through the following links, designed to enhance your development and optimization processes!<br /><br /><br />
		<a href="./developer.php?operation=sdestroy" class="btn">Session Destroy</a> 
		<a href="./developer.php?operation=cdestroy" class="btn">Cookie Destroy</a> <br /><br /><br />
		<a href="./developer.php?operation=phpinfo" class="btn">PHPInfo</a> 
		<a href="./_core/_action/admin_switch.php" class="btn">Backend/Frontend Switch</a>
		<a href="./_core/_action/token_switch.php" class="btn">Token Switch</a>
		<br /><br />
	</div>
	<div class="card">
        <b>Change website mode:</b><br />Tailor your browsing experience effortlessly with our website's rewriting feature. Easily redefine the landing page based on conditions such as the current browser URL or active user session. Switch seamlessly between different sites (Site Modules) using the administration backend or by configuring ruleset.php through straightforward rewriting and setup. This rewriting capability allows you to personalize your online environment according to your preferences, ensuring a customized and efficient browsing experience!<br /><br />
		<b>Current Site-Module</b>: <?php echo _HIVE_MODE_; ?><br />
		<b>Session Site-Module</b>: <?php echo @$_SESSION[_HIVE_COOKIE_."hive_mode"]; ?><br />
		<b>Default Site-Module</b>: <?php echo _HIVE_MODE_DEFAULT_; ?><br />
		<b>Available Site-Modules</b>: <span style='word-break: break-all;'><?php if(is_array(@_HIVE_MODE_ARRAY_)) { foreach(_HIVE_MODE_ARRAY_ as $key => $value) { if($key != 0) {echo ", ";} echo htmlspecialchars($value ?? '');  } }?></span><br /><br />
		<?php 
			if(@is_string(@$_POST["mod_change"]) AND @in_array(@$_POST["mod_change"], @_HIVE_MODE_ARRAY_)) {
				$_SESSION[_HIVE_COOKIE_."hive_mode"] = @$_POST["mod_change"];
				echo "<script>window.location.href = window.location.href;</script>";
			}
		?>
		<form method="post">
			<select name="mod_change" class="btn">
				<option value="<?php echo htmlentities($_SESSION[_HIVE_COOKIE_."hive_mode"]  ?? ''); ?>">Active: <?php echo htmlentities($_SESSION[_HIVE_COOKIE_."hive_mode"] ?? '' ); ?></option>
				<?php
					foreach(_HIVE_MODE_ARRAY_ as $key => $value) {
						echo "<option value='".@htmlspecialchars($value ?? '')."'>".@htmlspecialchars($value ?? '')."</option>";
					}
				?>
			</select>
			<input type="hidden" name="update_start" value="set">
			<button type="submit" class="btn">Change Site</button> 		
		</form>		
		
		<br /><b>Current Site Informations</b>:<br />
		Version: <?php echo @htmlspecialchars(@$object["hive_mode"]["version"] ?? ''); ?><br />
		Build: <?php echo @htmlspecialchars(@$object["hive_mode"]["build"] ?? ''); ?><br />
		Rname: <?php echo @htmlspecialchars(@$object["hive_mode"]["rname"] ?? ''); ?><br />
		Name: <?php echo @htmlspecialchars(@$object["hive_mode"]["name"] ?? ''); ?><br />
		Short Description: <?php echo @htmlspecialchars(@$object["hive_mode"]["short"] ?? ''); ?><br />
	</div>
	<div class="card">
		<b>Change website language:</b><br />Customize your language preferences effortlessly on our website. Explore available languages configured within the current activated site modules configuration files. Take control of your linguistic experience, ensuring seamless navigation in a language that suits your preferences. Switch between languages with ease, making your interaction with the website a personalized and user-friendly journey. This functionality is available, if the current loaded site module has different languages enabled.<br /><br />
		<b>Current Language</b>: <?php echo htmlspecialchars(_HIVE_LANG_ ?? ''); ?><br />
		<b>Session Language</b>: <?php echo htmlspecialchars(@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] ?? ''); ?><br />
		<b>Default Language</b>: <?php echo htmlspecialchars(_HIVE_LANG_DEFAULT_ ?? ''); ?><br />
		<b>Available Languages</b>: <span style='word-break: break-all;'><?php if(is_array(@_HIVE_LANG_ARRAY_)) { foreach(_HIVE_LANG_ARRAY_ as $key => $value) { if($key != 0) {echo ", ";} echo htmlspecialchars($value ?? '');  } }?></span>
		<br />
		<?php 
			if(@is_string(@$_POST["lang_change"]) AND @in_array(@$_POST["lang_change"], @_HIVE_LANG_ARRAY_)) {
				@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = @$_POST["lang_change"];
				echo "<script>window.location.href = window.location.href;</script>";
			}
		?>
		<form method="post">
			<select name="lang_change" class="btn">
				<option value="<?php echo htmlentities(@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] ?? ''); ?>">Active: <?php echo htmlentities(@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] ?? ''); ?></option>
				<?php
					foreach(_HIVE_LANG_ARRAY_ as $key => $value) {
						echo "<option value='".htmlspecialchars($value ?? '')."'>".htmlspecialchars($value ?? '')."</option>";
					}
				?>
			</select>
			<input type="hidden" name="update_start" value="set">
			<button type="submit" class="btn">Change Language</button>
		</form>		
	</div>
	<div class="card">
		<b>Change website theme:</b><br />Elevate your visual experience by selecting a theme that resonates with your style on our website. Explore the array of available themes configured within the current activated site modules configuration files. Tailor the website's appearance to match your preferences, with the flexibility to seamlessly switch between different themes. Immerse yourself in a personalized and visually appealing online environment, where your chosen theme enhances the overall aesthetic and usability of the site! This functionality is available, if the current loaded site module has different themes enabled.<br /><br />
		<b>Current Theme</b>: <?php echo htmlspecialchars(_HIVE_THEME_ ?? ''); ?><br />
		<b>Session Theme</b>: <?php echo htmlspecialchars(@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] ?? ''); ?><br />
		<b>Default Theme</b>: <?php echo htmlspecialchars(_HIVE_THEME_DEFAULT_ ?? ''); ?><br />
		<b>Available Themes</b>: <span style='word-break: break-all;'><?php if(is_array(@_HIVE_THEME_ARRAY_)) { foreach(_HIVE_THEME_ARRAY_ as $key => $value) { if($key != 0) {echo ", ";} echo htmlspecialchars($value ?? '');  } }?></span>	
		<br />
		<?php 
			if(@is_string(@$_POST["thm_change"]) AND @in_array(@$_POST["thm_change"], @_HIVE_THEME_ARRAY_)) {
				@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] = @$_POST["thm_change"];
				echo "<script>window.location.href = window.location.href;</script>";
			}
		?>
		<form method="post">
			<select name="thm_change" class="btn">
			<option value="<?php echo @htmlentities(@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"]); ?>">Active: <?php echo @htmlentities(@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] ?? ''); ?></option>
				<?php
					foreach(_HIVE_THEME_ARRAY_ as $key => $value) {
						echo "<option value='".htmlspecialchars($value ?? '')."'>".htmlspecialchars($value ?? '')."</option>";
					}
				?>
			</select>
			<input type="hidden" name="update_start" value="set">
			<button type="submit" class="btn">Change Theme</button> 
		</form>
	</div>		
	<div class="card">
		<b>Change website color:</b><br />Immerse yourself in a vibrant online experience by customizing the website's color palette dynamically. Explore a spectrum of colors available within the current activated site modules configuration files, extending beyond predefined options. Your color choices are not restricted, allowing for limitless personalization. Transform the visual aesthetics of the website effortlessly, adapting to your mood and preferences. Embrace the freedom to infuse your online journey with a burst of color that resonates with your unique style and enhances the dynamic themes at your fingertips! This functionality is available, if the current loaded site module has dynamic theme colors enabled.<br /><br />
		<b>Current Color</b>: <?php echo htmlspecialchars(_HIVE_COLOR_ ?? ''); ?><br />
		<b>Session Color</b>: <?php echo htmlspecialchars(@$_SESSION[_HIVE_SITE_COOKIE_."hive_color"] ?? ''); ?><br />	
		<b>Default Color</b>: <?php echo htmlspecialchars(_HIVE_THEME_COLOR_DEFAULT_ ?? ''); ?><br />		
		<br />
		<?php 
			if(@is_string(@$_POST["ctsd_change"])) {
				@$_SESSION[_HIVE_SITE_COOKIE_."hive_color"] = @$_POST["ctsd_change"];
				echo "<script>window.location.href = window.location.href;</script>";
			}
		?>
		<form method="post">
			<input type="color" name="ctsd_change" value='<?php echo htmlspecialchars(_HIVE_COLOR_ ?? ''); ?>'>
			<input type="hidden" name="update_start" value="set">
			<button type="submit" class="btn">Change Theme Color</button> 
		</form>
	</div>
			
				<center><font size="-1"><?php echo _HIVE_CREATOR_; ?></font></center>
			</article>
    </body>
</html>