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
			You can include this Files in <img> tags on your website to easily display captchas. The Constants used below can 
			be adjusted by your site modules config.php setup. Code will be stored in $_SESSION[_HIVE_SITE_COOKIE_."captcha.login"].
	*/
	if(file_exists("../../settings.php")) { require_once("../../settings.php"); }
		else { echo "/* This CMS is not yet installed. Please install this CMS by visiting the websites root folder! */"; }
	if(_CAPTCHA_FONT_PATH_ != false) {$font_path = _CAPTCHA_FONT_PATH_;} else {$font_path = "../_font/font.captcha_fallback.ttf";}
	x_captcha(_HIVE_SITE_COOKIE_."captcha.login", _CAPTCHA_WIDTH_, _CAPTCHA_HEIGHT_, _CAPTCHA_LINES_, _CAPTCHA_SQUARES_, _CAPTCHA_COLORS_, $font_path, _CAPTCHA_CODE_);
