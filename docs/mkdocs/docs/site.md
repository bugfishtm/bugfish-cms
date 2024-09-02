## Site Modules

Website modules can be run as standalone websites or alongside other installed website modules. They can be distributed across various domains and virtual hosts, using integrated functionalities to display many websites with just one instance. This allows for full control over our administration or another administration module, according to your needs!

<div class="alert alert-info">Explore our example site modules to get more insights for developers! Mind the comments in the files as they will help you to understand everything.</div>

### General Information

- Site Modules are fully deployed websites integrated inside this CMS system. They can be extended using script or extension modules.
- **Name** of Site Modules must start with an a-z character and should contain at most 10 characters.
- Lookup our example Site Module in our repository to get more information about development.

### 👆 Folder Structure

Here you can find the folder structure for Site Modules which can be applied to use core functions and let files automatically be executed. All these folders are optional to create and use. See inside the `_site/_administrator` Module to see implementations and files in different folders with explanations!

| **Folder Name**             | **Description**                                                                                                                                                                           |
|-----------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **CMS Cronjob Injection**   | You will have the following variables to work with relative to your site module. All CMS Core Variables will also be available:                                                            |
|                             | `$object["cron_mail"]` - Current Site Module's Cron Mail Object<br />`$object["cron_var"]` - Current Site Module's Cron Variables Object<br />`$object["cron_mail_template"]` - Current Site Module's Cron Mail Template Object<br />`$hive_mode_cron` - Current Cron Hive Mode Folder Name |
| `_cron`                     | Folder for Cronjobs to be injected.                                                                                                                                                         |
| `_cron/_daily/*`            | Daily Cronjob Injection Scripts (See the core cronjob file for insights on how these injections are handled)                                                                                |
| `_cron/_hourly/*`           | Hourly Cronjob Injection Scripts (See the core cronjob file for insights on how these injections are handled)                                                                               |
| `_cron/_weekly/*`           | Weekly Cronjob Injection Scripts (See the core cronjob file for insights on how these injections are handled)                                                                              |
| `_cron/_yearly/*`           | Yearly Cronjob Injection Scripts (See the core cronjob file for insights on how these injections are handled)                                                                             |
| `_cron/_monthly/*`          | Monthly Cronjob Injection Scripts (See the core cronjob file for insights on how these injections are handled)                                                                            |
| **CSS Injection Folder**    |                                                                                                                                                                                           |
| **Administrator Module Hooks** |                                                                                                                                                                                           |
| `_admin`                    | Folder to store executable files for the Administrator Module (See Administrator Site Module for more details)                                                                           |
| `_admin/mod_setting.php`    | Easy Settings Script for Modules Page (See Administrator Site Module for more details)                                                                                                    |
| **JS Injection Folder**     |                                                                                                                                                                                           |
| `_js`                       | Put your JS files here. Files in this folder will be included when including `javascript.php` in the website's root folder. JavaScript.php will only load CSS files for the current chosen Site Module. Pay attention to the naming scheme to ensure your files are injected correctly. (See Administrator Site Module for more details) |
| **Language Loadup Folder**  |                                                                                                                                                                                           |
| `_lang`                     | Put your Language Files here. Files in this folder will be included at site startup. Language File for Site Mode will be loaded depending on the current active Site Mode and User Language / Existing Language File. Translation can also be done via the database translation key functionality. If you choose the database functionality, site modules language files will be loaded first. (See Administrator Site Module for more details) |
| **WFC Loadup Folder**       |                                                                                                                                                                                           |
| `_wfc`                      | Loadup folder for Site Widgets if the Site Module is using any. (See Administrator Site Module for more details)                                                                         |
| **Functions Loadup Folder** |                                                                                                                                                                                           |
| `_lib`                      | Put your Library Files here. Files in this folder will be included at site startup. Lib files will be loaded if the related Site Mode is activated for the User. Pay attention to the naming scheme to ensure your files are injected automatically at runtime. (See Administrator Site Module for more details) |
| **MySQL Loadup Folder**     |                                                                                                                                                                                           |
| `_mysql`                    | Put SQL Files here. Files in this folder will be loaded on execution of a site with the related site mode by a visiting user. Auto Installation and Check if all Database exists will take place on every site loadup. Pay attention to the naming schemes to let your files be installed automatically. (See Administrator Site Module for more details) |
| **Themes Loadup Folder**    |                                                                                                                                                                                           |
| `_theme`                    | Folder dedicated to your website theme files.                                                                                                                                              |
| **Update Loadup Folder**    |                                                                                                                                                                                           |
| `_update`                   | Folder for updates depending on the build number. See `updater.php` script or example site for more information. You can place updates for databases and more here. Mind the sample files as there is information inside them. Check the example site for how updating works, as there is a dummy update included! You can use files like `BUILDNUMBER.php` to make changes to the database if updating from a previous build number. |
| **Config Loadup Folder**    |                                                                                                                                                                                           |
| `_config/`                  | Folder for Site Module Configuration Files (See Administrator Site Module for more details)                                                                                               |
| `_config/config_pre.php`    | Configuration to be loaded before Initial Site Startup (optional). This file mostly defines constants.                                                                                   |
| `_config/config_post.php`   | Configuration to be loaded after Initial Site Startup (optional). This file mostly defines constants.                                                                                   |
| `_config/config_global_pre.php` | Configuration to be loaded before Initial Site Startup globally for every Site Module.                                                                                                   |
| `_config/permission.php`    | Declare permission set with `object[permission]` here. This will give the administrator module the ability to control permissions (if implemented).                                    |
| `_config/config_global_post.php` | Configuration to be loaded globally for every Site Module before Initial Site Startup.                                                                                                   |
| `_config/config.php`        | Configuration for your Site Module. See example site module in `_site` folder for information on setting up this file. This file mostly defines constants.                             |
| **Site Modules Index Files**|                                                                                                                                                                                           |
| `/load.php`                 | Site loadup file if the related Site Module is chosen (Startup File). This file will be executed as the start file if the related Site Module is chosen.                               |
| `/version.php`              | Versioning information about the deployed site module.                                                                                                                                   |
| `/changelog.php`            | Changelog information about the deployed site module.                                                                                                                                   |
| `/preview.jpg`              | Site Module preview image.                                                                                                                                                                |


## 👆 Pre-Defined Variables

Here you find a set of constants declared to make it easier to produce and develop site modules! These constants are always relative to your site Module and will come in handy, making your life easier when developing with this CMS! See inside the `_site/_administrator` Module to see implementations and files in different folders with explanations!

| **Constant Name**              | **Description**                                                                                                                                                                  |
|--------------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `_HIVE_SITE_PATH_`             | Path to Site Modules Folder (Full). This constant can be used inside your site modules development, as it will be relative to the current visible front module.                  |
| `_HIVE_SITE_PUBLIC_`           | Path to absolute Site Data Public folder!                                                                                                                                         |
| `_HIVE_SITE_EXT_`              | Site's Extension Folder!                                                                                                                                                           |
| `_HIVE_SITE_PRIVATE_`          | Path to absolute Site Data Private/Restricted folder!                                                                                                                             |
| `_HIVE_SITE_REL_`              | Relative Path to Website Site Folder for URL Redirects!                                                                                                                           |
| `_HIVE_SITEC_REL_`             | Relative Path to Website Site Folder for URL Redirects, without HTTPS and host part!                                                                                              |
| `_HIVE_SITE_COOKIE_`           | Cookie Prefix to use for Site Module. This constant can be used inside your site modules development, as it will be relative to the current visible front module.                |
| `_HIVE_SITE_PREFIX_`           | Database Prefix to use for Site Module. This constant can be used inside your site modules development, as it will be relative to the current visible front module.              |
| `_HIVE_MODE_`                  | Currently active User Site Mode. This constant can be used inside your site modules development, as it will be relative to the current visible front module.                    |
| `_HIVE_THEME_`                 | Currently active User Theme. This constant can be used inside your site modules development, as it will be relative to the current visible front module.                         |
| `_HIVE_COLOR_`                 | Currently active User Theme Color. This constant can be used inside your site modules development, as it will be relative to the current visible front module.                  |
| `_HIVE_LANG_`                  | Currently active User Language. This constant can be used inside your site modules development, as it will be relative to the current visible front module.                     |
| `_HIVE_URL_CUR_`               | Currently defined values for URL Location Levels in the Name Array. This constant can be used inside your site modules development, as it will be relative to the current visible front module. |



## 👆 Setup Constants

Here you can find settings which can be applied in your site `Modules config.php` file! **Be sure to define all these values, otherwise this can lead to unforeseen errors!** See inside the `_skeleton` example Site Module to see default configurations and more! See inside the `_site/_skeleton` Module to see implementations and files in different folders with explanations!

| **Constant Name**                       | **Description**                                                                                                                        |
|----------------------------------------|----------------------------------------------------------------------------------------------------------------------------------------|
| `_HIVE_BUILD_`                         | Current Build Number of your script, this is important if you want to use our updater script with your website module! Just set this to "1" if you are not sure what to do. |
| `_HIVE_TITLE_`                         | Title for the Site Modules Web Page used in Tab Titles and in Themes for more.                                                        |
| `_HIVE_TITLE_SPACER_`                  | Spacer for the title and name of page in tab title and other areas!                                                                    |
| `_HIVE_PHP_DEBUG_`                     | If you set this to `true(1)`, PHP Errors will be displayed on page! It is advised to set this to `false(0)` on a productive version! |
| `_HIVE_PHP_MODS_`                      | Here you can set which modules in PHP need to be installed to run your site module. If a module is missing an error page will be shown. Example: `array("gd", "mbstring", "modulename")` |
| `_HIVE_MYSQL_DEBUG_`                   | If you set this to `true(1)`, MySQL Errors will be displayed on page! It is advised to set this to `false(0)` on a productive version! |
| `_HIVE_CURL_LOGGING_`                  | Log CURL Class Requests? (`true/false`)                                                                                                 |
| `_HIVE_IP_LIMIT_`                     | Block IPs after X Failures                                                                                                                |
| `_HIVE_IP_REFERER_`                   | Log Referers? (`true/false`)                                                                                                              |
| `_HIVE_CSRF_TIME_`                    | Default CSRF Code Valid Time in Seconds                                                                                                    |
| `_CRON_ONLY_CLI_`                      | `True` - Only Cronjob Execution from Command Line | `False` - Allow Cronjob Execution in Browser                                        |
| `$object["set"]["permission"]`         | Here you can add permissions to easily be used with the administrator interface or other modules of your site! Check the example `_skeleton` in the `_site` directory to see how you need to set up this variable. In the `_administrator` site you can see an implementation of this functionality. |
| `$object["nav"]`                       | Array to create easy navigations on templates! See `_skeleton` or other sites as examples on how to use this array. It is stored in the `config.php` files of a site! |


| **User Settings**                                                        |                                                                         |
|---------------------------------------------------------------------------|-------------------------------------------------------------------------|
| `_USER_MAX_SESSION_`                                                     | Maximum Days Sessions/Cookies are Valid                                |
| `_USER_TOKEN_TIME_`                                                       | Time in Minutes token out of Activation Mails are Valid                 |
| `_USER_AUTOBLOCK_`                                                         | Block Users after X Fail Logins (can be false)                          |
| `_USER_WAIT_COUNTER_`                                                      | Time in Minutes User has to wait between Requests (anti flood)          |
| `_USER_LOG_SESSIONS_`                                                       | Log old sessions? (Logins, Recoverys, Activations, Mail Changes) (true/false) |
| `_USER_LOG_IP_`                                                             | Log User IPs in Database (true/false)                                   |
| `_USER_REC_DROP_`                                                           | True - Remove Recovery Keys after user Successfully Logged In | false - Preserve Keys |
| `_USER_MULTI_LOGIN_`                                                        | True - Allow Multi Login | false - Disable Multi Login (old session logout) |
| `_USER_PF_SIGNS_`                                                           | Passwordfilter: Min Signs                                               |
| `_USER_PF_CAPSIGNS_`                                                        | Passwordfilter: Min Capital Signs                                       |
| `_USER_PF_SMSIGNS_`                                                          | Passwordfilter: Min Small Signs                                         |
| `_USER_PF_SPSIGNS_`                                                          | Passwordfilter: Min Special Signs                                       |
| `_USER_PF_NUMSIGNS_`                                                         | Passwordfilter: Min Numeric Signs                                       |

| **Default Activation Scripts Config**                                    |                                                                         |
|---------------------------------------------------------------------------|-------------------------------------------------------------------------|
| `_HIVE_USR_ACT_DISABLE_`                                                   | Disable the general User Activation page? (0/1)                        |
| `_HIVE_USR_ACT_REFER_`                                                     | Refer to this path if you want to use special User Activation page for Site Mode |
| `_HIVE_USR_REC_REFER_`                                                     | Refer to this path if you want to use special Recover Execution page for Site Mode |
| `_HIVE_USR_REC_DISABLE_`                                                   | Disable the general Recover Activation page? (0/1)                     |
| `_HIVE_USR_MC_REFER_`                                                       | Refer to this path if you want to use special Mail Activation page for Site Mode |
| `_HIVE_USR_MC_DISABLE_`                                                     | Disable the general Mail Activation page? (0/1)                        |

| **Create Initial Files**                                                   |                                                                         |
|---------------------------------------------------------------------------|-------------------------------------------------------------------------|
| `_HIVE_HTACCESS_WRITE_`                                                     | 1 - Create HTAccess | 0 - Do Not Create HTAccess                       |
| `_HIVE_HTACCESS_HTTPS_FORWARD_`                                              | 1 - Forward to HTTPS | 0 - Not Forward                                |
| `_HIVE_HTACCESS_WWW_FORWARD_`                                                | 1 - Forward to HTTPS | 0 - Not Forward                                |
| `_HIVE_HTACCESS_REFRESH_`                                                    | 1 - REFRESH MODULE | 0 - Not Refresh Module                          |
| `_HIVE_SITEMAP_URL_`                                                         | 1 - URL TO SITEMAP | 0 - NO URL IN SITEMAP IN ROBOTS.TXT           |
| `_HIVE_ROBOT_SPAWN_`                                                          | 1 - Allow All | 2 - Allow nothing /| 0 Do not Spawn robots.txt      |

| **TinyMCE**                                                                |                                                                         |
|---------------------------------------------------------------------------|-------------------------------------------------------------------------|
| `_TINYMCE_PLUGINS_`                                                          | TinyMCE Plugin Items                                                    |
| `_TINYMCE_MENU_BAR_`                                                         | TinyMCE Menu Items                                                       |
| `_TINYMCE_TOOL_BAR_`                                                          | TinyMCE Toolbar Items                                                    |

| **Captcha**                                                                |                                                                         |
|---------------------------------------------------------------------------|-------------------------------------------------------------------------|
| `_CAPTCHA_CODE_`                                                             | Random Code for Captcha                                                 |
| `_CAPTCHA_LINES_`                                                            | Count of Lines in Captcha                                               |
| `_CAPTCHA_SQUARES_`                                                          | Count of Squares in Captcha                                             |
| `_CAPTCHA_HEIGHT_`                                                           | Captcha Height Image                                                    |
| `_CAPTCHA_WIDTH_`                                                            | Captcha Width Image                                                     |
| `_CAPTCHA_COLORS_`                                                           | Colors for Captcha (Optional, can be false)                             |




### MAIL

| **Parameter**             | **Description**                                                                                                               |
|---------------------------|-------------------------------------------------------------------------------------------------------------------------------|
| _SMTP_HOST_               | Set SMTP Host for Site Module [Initial Mail Connection Settings will be set in settings.php but can be overwritten by Site Module! Look there for required Constants to define!] |
| _SMTP_PORT_               | Set SMTP Port for Site Module [Initial Mail Connection Settings will be set in settings.php but can be overwritten by Site Module! Look there for required Constants to define!] |
| _SMTP_AUTH_               | Set SMTP Auth for Site Module (ssl/tls/false) [Initial Mail Connection Settings will be set in settings.php but can be overwritten by Site Module! Look there for required Constants to define!] |
| _SMTP_USER_               | Set SMTP User for Site Module [Initial Mail Connection Settings will be set in settings.php but can be overwritten by Site Module! Look there for required Constants to define!] |
| _SMTP_PASS_               | Set SMTP Pass for Site Module [Initial Mail Connection Settings will be set in settings.php but can be overwritten by Site Module! Look there for required Constants to define!] |
| _SMTP_SENDER_MAIL_        | Default Sender Mail Adr [Initial Mail Connection Settings will be set in settings.php but can be overwritten by Site Module! Look there for required Constants to define!] |
| _SMTP_SENDER_NAME_        | Default Sender Mail Name [Initial Mail Connection Settings will be set in settings.php but can be overwritten by Site Module! Look there for required Constants to define!] |
| _SMTP_MAILS_IN_HTML_      | All Mails sended as HTML? (false/true) [Initial Mail Connection Settings will be set in settings.php but can be overwritten by Site Module! Look there for required Constants to define!] |
| _SMTP_DEBUG_              | Mail Debug Mode (0, 1, 2, 3) - Use 0 for Production as this will result Debug Output on site! [Initial Mail Connection Settings will be set in settings.php but can be overwritten by Site Module! Look there for required Constants to define!] |
| _SMTP_MAILS_HEADER_       | Default Header for Mails [Initial Mail Connection Settings will be set in settings.php but can be overwritten by Site Module! Look there for required Constants to define!] |
| _SMTP_MAILS_FOOTER_       | Default Footer for Mails [Initial Mail Connection Settings will be set in settings.php but can be overwritten by Site Module! Look there for required Constants to define!] |
| _SMTP_INSECURE_           | Allow insecure SSL Connections? (true/false) [Initial Mail Connection Settings will be set in settings.php but can be overwritten by Site Module! Look there for required Constants to define!] |

### REDIS

| **Parameter**             | **Description**                  |
|---------------------------|----------------------------------|
| _REDIS_                   | Redis Activated? False/True      |
| _REDIS_HOST_              | Redis Host                       |
| _REDIS_PORT_              | Redis Port                       |
| _REDIS_PREFIX_            | Redis Prefix                     |

### Updater Settings

| **Parameter**             | **Description**                  |
|---------------------------|----------------------------------|
| _UPDATER_TITLE_           | Title for the Updater on this Site |
| _UPDATER_CODE_            | Code needed for Update execution? (can be false) |

### Language Settings

| **Parameter**             | **Description**                                          |
|---------------------------|----------------------------------------------------------|
| _HIVE_LANG_DEFAULT_       | Array with Default Language                             |
| _HIVE_LANG_ARRAY_         | Array with valid Languages                              |
| _HIVE_LANG_DB_            | False = Use Language Files in SITE/_lang / True = Use Language Database |

### Theme Settings

| **Parameter**             | **Description**                   |
|---------------------------|-----------------------------------|
| _HIVE_THEME_DEFAULT_      | Default Used Theme                |
| _HIVE_THEME_ARRAY_        | Array with valid Themes           |
| _HIVE_THEME_COLOR_DEFAULT_| Default Color for Dynamic Theme Colors |

### URL Settings

| **Parameter**             | **Description**                                                                                           |
|---------------------------|-----------------------------------------------------------------------------------------------------------|
| _HIVE_URL_SEO_            | STRING - GET VARIABLE SEO IN HTACCESS  | 0 - No SEO URLs Using                                          |
| _HIVE_URL_GET_            | Only needed if _HIVE_URL_SEO_ == false [Array with Name for Get Location Level GET Variables]          |
| _HIVE_URL_                | Hive System URL, which is provided at installation! Otherwise if one is set in Site Module, the one set in Site Module config will be used (this is meant for Multi site, otherwise you won't need to set this. Multi Site is for Multi Management Systems with multiple URLs on one system.] |





## 👆 Installation

Here you can find information on how to install a Site Module.

### Method 1: Choose Module from Store

1. Login to the Administrator Site Module.
2. Navigate to "Store"
3. Download the desired module through the web interface.
4. Navigate to the "Website Module" Area of the Administrator Module.
5. Install the uploaded module template with a desired name.
6. Open the site module once to initialize required data and variables in the database.

### Method 2: Upload in Administrator Module

1. Open the Administrator Module in your web browser.
2. Login as Administrator or Privileged user.
3. Go to the "Website Module" area and select "Upload Manually."
4. Upload the module's .zip file.
5. Install the uploaded module template with a desired name.
6. Open the site module once to initialize required data and variables in the database.

### Method 3: Upload Manually

1. Login to your webserver with FTP/SFTP.
2. Unpack the required Site Modules folder.
3. Move the extracted folder to the `_site` directory of the BugfishCMS installation.
   - Use only alphanumeric characters and underscores (`_`), but `_` only at the start.
4. Use the administrator module or `./developer.php` script (ensure it's activated in `cfg_ruleset.php`) to use the new site module.
