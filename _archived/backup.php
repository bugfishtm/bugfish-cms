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
	if(!hive__access($object, "admin_backup", false)) {
		define("_ADM_ERROR_401_", "true");
	} else {	
		// Header Loadup
		adminbsb_header($object);
		adm_styling_head($object["lang"]->translate("adm_nav_backup"), $object["lang"]->translate("adm_nav_backup_descr")); ?>
		
		<div class="card">
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#full" data-toggle="tab" aria-expanded="false"><?php echo $object["lang"]->translate("adm_backup_full_backup"); ?></a></li>
                                <li role="presentation" class=""><a href="#site" data-toggle="tab" aria-expanded="false"><?php echo $object["lang"]->translate("adm_backup_site_backup"); ?></a></li>
                                <li role="presentation" class=""><a href="#image" data-toggle="tab" aria-expanded="true"><?php echo $object["lang"]->translate("adm_backup_image_backup"); ?></a></li>
                                <li role="presentation" class=""><a href="#docker" data-toggle="tab" aria-expanded="true"><?php echo $object["lang"]->translate("adm_backup_docker_backup"); ?></a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade" id="site">
                                    <p>
										<?php echo $object["lang"]->translate("string_coming_soon"); ?>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade active in" id="full">
                                    <p>
										<?php echo $object["lang"]->translate("string_coming_soon"); ?>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="image">
                                    <p>
                                        <?php echo $object["lang"]->translate("string_coming_soon"); ?>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="available">
                                    <p>
                                        <?php echo $object["lang"]->translate("string_coming_soon"); ?>.
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="docker">
                                    <p>
										<?php echo $object["lang"]->translate("string_coming_soon"); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
		<?php
	} 