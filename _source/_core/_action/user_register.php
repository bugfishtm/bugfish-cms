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
	
	// Check for Activation of this Action Section and IP Bans
	if($object["ipbl"]->blocked()) { 
			$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."__login_csrf");
			hive__volt_header($object, "Error", '<link rel="icon" type="image/x-icon" href="'._HIVE_URL_REL_.'/_core/_image/image.favicon.ico">', "dark");
			?>
			<section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
				<div class="container mb-5">
					<div class="row justify-content-center form-bg-image" > <!-- data-background-lg="../../assets/img/illustrations/signin.svg"-->
						<div class="col-12 d-flex align-items-center justify-content-center">
							<div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
								Your IP-Adress is currently blocked!<br />Please try again later or contact our support team.
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
	if(defined("_HIVE_ACTION_REGISTER_")) { 
		if(!_HIVE_ACTION_REGISTER_) { 
			$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."__login_csrf");
			hive__volt_header($object, "Error", '<link rel="icon" type="image/x-icon" href="'._HIVE_URL_REL_.'/_core/_image/image.favicon.ico">', "dark");
			?>
			<section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
				<div class="container mb-5">
					<div class="row justify-content-center form-bg-image" > <!-- data-background-lg="../../assets/img/illustrations/signin.svg"-->
						<div class="col-12 d-flex align-items-center justify-content-center">
							<div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
								Functionality disabled by cms site module! [_HIVE_ACTION_REGISTER_]
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
	} else {
		$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."__login_csrf");
		hive__volt_header($object, "Error", '<link rel="icon" type="image/x-icon" href="'._HIVE_URL_REL_.'/_core/_image/image.favicon.ico">', "dark");
		?>
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container mb-5">
                <div class="row justify-content-center form-bg-image" > <!-- data-background-lg="../../assets/img/illustrations/signin.svg"-->
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
							Functionality disabled by cms site module! [_HIVE_ACTION_REGISTER_]
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
	
	if($object["user"]->user_loggedIn) {
		$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."__login_csrf");
		hive__volt_header($object, "Error", '<link rel="icon" type="image/x-icon" href="'._HIVE_URL_REL_.'/_core/_image/image.favicon.ico">', "dark");
		?>
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container mb-5">
                <div class="row justify-content-center form-bg-image" > <!-- data-background-lg="../../assets/img/illustrations/signin.svg"-->
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
							You cannot enter this site, while you are logged in!
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
	
		$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."__login_csrf");
		// Registration Execution
		if(hive__trim(@$_POST["usermail"]) != "") { 
			if($object["csrf"]->check(@$_POST["token"])) { 
				if(hive__trim(@$_POST["password"]) != "") { 
					if(hive__trim(@$_POST["password_confirm"]) != "") { 
						if($object["user"]->passfilter_check(@$_POST["password"])) { 
							if(@$_POST["password_confirm"] == @$_POST["password"]) { 
								$return = $object["user"]->addUser($_POST["usermail"], $_POST["usermail"], $_POST["password"]);
								if($return) { 
									$bind = array();
									$bind[0]["value"] = hive__trim($_POST["usermail"]);
									$bind[0]["value"] = strtolower($bind[0]["value"]);
									$newuser = $object["mysql"]->select("SELECT * FROM "._TABLE_USER_." WHERE LOWER(user_mail) = ?", false, $bind);
									if(is_array($newuser)) {
										$return = $object["user"]->activation_request($bind[0]["value"]);
										if($return) {
											$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
											if($object["mail"]->send($_POST["usermail"], $_POST["usermail"], $object["lang"]->translate("hive_login_mail_title_register"), $object["lang"]->translate("hive_login_mail_pre_register")."<br /><a href='".$current_url."/_core/_action/user_activate.php?act_token=".$object["user"]->mail_ref_token."&act_user=".$object["user"]->mail_ref_user."'>".$current_url."/_core/_action/user_activate.php?act_token=".$object["user"]->mail_ref_token."&act_user=".$object["user"]->mail_ref_user."</a>", true, _SMTP_MAILS_FOOTER_, _SMTP_MAILS_HEADER_, false))
											{ $object["eventbox"]->ok($object["lang"]->translate("hive_login_msg_register_ok")); } else { $object["eventbox"]->error($object["lang"]->translate("hive_login_mail_serror")); }
										} else { 
											$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_noadr"));
										}
									} else {
										$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_noadr"));
									}
								} else {
									$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_noadr"));
								}
							} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_nomatchpass")); }
						} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_passfiltererror")); }
					} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_empty")); }
				} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_empty")); }
			} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); }
		} 
		
		// Registration Form
		hive__volt_header($object, $object["lang"]->translate("string_register"), '<link rel="icon" type="image/x-icon" href="'._HIVE_URL_REL_.'/_core/_image/image.favicon.ico">', "dark"); ?>
		<style>
			/*-----------------------------------------*/
			/* Eventbox Admin Template Stylesheet */
			/*-----------------------------------------*/

			/******************************************************* x_class_eventbox  *********/
			.x_class_eventbox {
				position: fixed;
				top: 15px;
				right: 15px;
				z-index: 1000 !important;
			}

			.x_class_eventbox_inner {
				max-width: 500px;
			}
			.x_class_eventbox_msg {
				max-width: 500px;
				border-radius: 0px;
				padding: 15px;
				margin-top: 20px;
				border: 1px solid black;
			}
			.x_class_eventbox_msg_ok {
				background: #2B982B;
				color: white;
			}
			.x_class_eventbox_msg_error {
				background: #FB483A;
				color: white;
			}
			.x_class_eventbox_msg_warning {
				background: #FF9600;
			}
			.x_class_eventbox_msg_info {
				background: #00B0E4;
				color: white;
			}
			.x_class_eventbox_msg_close {
				background: #FB483A;
				border-radius: 0px;
				padding: 5px;
				color: white;
				cursor: pointer;
				width: 80px;
				font-weight: bold;
				font-size: 12px;
				position: absolute;
				float: right;
				right: 15px;
				border: 1px solid black;
			}
			.x_class_eventbox_msg_text { }
		</style>		
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container mb-5">
                <div class="row justify-content-center form-bg-image" > <!-- data-background-lg="../../assets/img/illustrations/signin.svg"-->
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3"><?php echo $object["lang"]->translate("string_register"); ?></h1>
                            </div>
                            <form action="./user_register.php" class="mt-4" method="post">
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="email"><?php echo $object["lang"]->translate("string_email"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                                        </span>
                                        <input type="email" name="usermail" class="form-control" value="<?php echo htmlentities(@$_POST["usermail"]); ?>" placeholder="<?php echo $object["lang"]->translate("string_email"); ?>" id="email" autofocus required>
                                    </div>  
                                </div>
                                <!-- End of Form -->
                                <div class="form-group">
									<b><?php echo $object["lang"]->translate("login_password_rules"); ?></b>
									<ul>
										<?php if (_USER_PF_SIGNS_ > 0) { ?><li><?php echo $object["lang"]->translate("login_password_sign"); ?> <?php echo _USER_PF_SIGNS_; ?></li><?php } ?>
										<?php if (_USER_PF_CAPSIGNS_ > 0) { ?><li><?php echo $object["lang"]->translate("login_password_cap"); ?> <?php echo _USER_PF_CAPSIGNS_; ?></li><?php } ?>
										<?php if (_USER_PF_SMSIGNS_ > 0) { ?><li><?php echo $object["lang"]->translate("login_password_small"); ?> <?php echo _USER_PF_SMSIGNS_; ?></li><?php } ?>
										<?php if (_USER_PF_SPSIGNS_ > 0) { ?><li><?php echo $object["lang"]->translate("login_password_special"); ?> <?php echo _USER_PF_SPSIGNS_; ?></li><?php } ?>
										<?php if (_USER_PF_NUMSIGNS_ > 0) { ?><li><?php echo $object["lang"]->translate("login_password_numeric"); ?> <?php echo _USER_PF_NUMSIGNS_; ?></li><?php } ?>
									</ul>
                                    <!-- Form -->
                                    <div class="form-group mb-4">
                                        <label for="password"><?php echo $object["lang"]->translate("string_password"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                            </span>
                                            <input type="password" name="password" placeholder="<?php echo $object["lang"]->translate("string_password"); ?>" class="form-control" id="password" required>
                                        </div>  
                                    </div>
									<input type="hidden" name="token" value="<?php echo $object["csrf"]->get(); ?>">
									<input type="hidden" name="loginbutton" value="1">
                                    <div class="form-group mb-4">
                                        <label for="password"><?php echo $object["lang"]->translate("login_password_confirm"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                            </span>
                                            <input type="password" name="password_confirm" placeholder="<?php echo $object["lang"]->translate("login_password_confirm"); ?>" class="form-control" id="password" required>
                                        </div>  
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-gray-800"><?php echo $object["lang"]->translate("string_register"); ?></button>
                                </div>
                            </form>
                            <div class="d-flex justify-content-center align-items-center mt-4">
								<?php if(defined("_HIVE_ACTION_LOGIN_")) { ?>
									<?php if(_HIVE_ACTION_LOGIN_) { ?>
									<span class="fw-normal">
									   <?php echo $object["lang"]->translate("login_haveaccount"); ?>
										<a href="<?php echo _HIVE_URL_REL_; ?>_core/_action/user_login.php" class="fw-bold"><?php echo $object["lang"]->translate("string_login"); ?></a>
									</span>
									<?php } ?>
								<?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	
	<?php
		$object["eventbox"]->show($object["lang"]->translate("string_close"));
		hive__volt_footer($object, "");
		exit();