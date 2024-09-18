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
		
	*/ if(file_exists("../../settings.php")) { require_once("../../settings.php"); } else { @http_response_code(404); Header("Location: ../"); exit(); } 

	
	if(!$object["user"]->user_loggedIn) {
		$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."__login_csrf");
		hive__volt_header($object, "Error", '<link rel="icon" type="image/x-icon" href="'._HIVE_URL_REL_.'/_core/_image/image.favicon.ico">', "dark");
		?>
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center form-bg-image" > <!-- data-background-lg="../../assets/img/illustrations/signin.svg"-->
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
							You cannot enter this site, while you are not logged in!
							<br /><br /><a href="../../">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>					
		<?php 
		hive__volt_footer($object, "");
		exit();
	}
	
	session_destroy();
	
	function removeAllCookies() {
		if (isset($_SERVER['HTTP_COOKIE'])) {
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			
			foreach($cookies as $cookie) {
				$parts = explode('=', $cookie);
				$name = trim($parts[0]);
				setcookie($name, '', time() - 3600, $path);
				setcookie($name, '', time() - 3600, '/');
			}
		}
	}
	
	removeAllCookies();
	session_start();
	$object["eventbox"]->ok($object["lang"]->translate("hive_login_msg_logout"));
	Header("Location: ./user_login.php");