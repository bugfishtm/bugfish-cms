# Folder Structure

Here you can see the folder structure  of the CMS. For information about the modules folder structure see the different modules sections in this documentation.

## _cron

Contains cronjob files. Execute these files according to their time period (e.g., `cron.daily` for daily tasks). 


## _script
Contains installed and active script modules. Manage these through the Administrator Interface; manual edits are not advised. See the documentation for module development details.

## _site

Holds installed and active site modules. Use the Administrator Interface for management; manual edits are not advised. Refer to the documentation for more information.

## _image
Contains installed and active image modules. It's recommended to manage these through the Administrator Interface; manual edits are not advised. Refer to the documentation for module development.

## _core

The `_core` folder contains core code and will be overwritten during core updates.

| Folder Structure | Description | 
|----|----|
| **_core** | Holds all core-related files. This folder is upgraded during core updates, and changes here are not persistent. |
| **_core/_action** | Stores external actions requested by CMS PHP scripts. |
| **_core/_captcha** | Contains captcha images for inclusion in your project. Refer to the documentation for session variable details to store captcha tokens. |
| **_core/_error** | Default error templates used in `.htaccess` and for project integration. Use as full-page templates to include HTTP error codes. |
| **_core/_font** | Stores included font files. Check the license for each font in the documentation or the `_licenses` folder. |
| **_core/_framework** | Contains Bugfish Framework files included automatically in `javascript.php` and `stylesheet.php` during initialization. |
| **_core/_image** | Default JPG/PNG/ICO images used in various CMS sections. |
| **_core/_lang** | Default language translation files. Automatically loaded based on the `_HIVE_LANG_` constant, which controls the displayed language. |
| **_core/_lib** | Core function library of the CMS, included automatically during site initialization. |
| **_core/_mysql** | Contains MySQL core system tables installed during site initialization, as specified in `initialize.php`. |
| **_core/_vendor** | 3rd party scripts, functions, and templates. Include these in your module to add new functionalities or UX features. Licenses can be found in the documentation or `_licenses` folder. |
| **_core/initialize.php** | Initializes site functionalities and includes variables, referenced by `settings.php`. |
| **_core/javascript.php** | JavaScript loader for framework, module, and extension-related scripts. Include this file in your project's header as a standard JS script file. |
| **_core/stylesheet.php** | CSS loader for framework, module, and extension-related stylesheets. Include this file in your project's header as a standard CSS file. |
| **_core/version.php** | Contains versioning information for the core system. |

## _data

The `_data` folder contains all dynamic data for site modules and their extensions. Within the `_data` directory, a corresponding folder for each site module (based on the module's folder name in `_site`) is automatically created to store this data. This includes all on-site uploads and data that are not part of the module's source code, which remains in `_site`. If these folders are deleted, they will be automatically recreated by the CMS. Upgrades won't touch this folder.

| Folder Structure | Description | 
|----|----|
| **_data** | Stores module-related files, including public, private, extensions, and dynamic files for site modules. For more details, see the documentation or module folder structure section below |
| **_data/MODULE** | A folder matching the site module name in `_site` is created here to store its data. If the `_site` module folder is renamed, this `_data` folder must also be renamed to maintain the connection between the module and its data during CMS initialization. |
| **_data/MODULE/_public** | Stores public data for site modules, accessible without PHP scripts. This folder is not HTACCESS secured, allowing hardlinking. |
| **_data/MODULE/_private** | Contains private data for the module, protected by HTACCESS. Access to this data requires PHP handlers with appropriate access controls or predefined scripts. |
| **_data/MODULE/_extension** | Stores active extensions for the site module. |
| **_data/MODULE/_extension_disabled** | Stores inactive extensions for the site module. |
| **_data/MODULE/_domain** | Used for storing site module-related domain files like sitemaps, robots.txt, and other linked files. |

## _disabled

The `_disabled` folder contains disabled modules and is not affected by core updates.

| Folder Structure | Description | 
|----|----|
| **_disabled** | Stores inactive modules. |
| **_disabled/_image** | Stores installed but inactive image modules. |
| **_disabled/_script** | Stores installed but inactive script modules. |
| **_disabled/_site** | Stores installed but inactive site modules. |

## _store

The `_store` folder manages cache files from downloaded items via the internal store, as well as files for deploying modules, core versions, or software through the CMS. Core updates do not affect this folder, except for PHP files in `_store/*.php` which may be updated during core releases.

| Folder Structure | Description | 
|----|----|
| **_store** | Manages store-related data for deployments and downloads. |
| **_store/_temp** | Stores temporary data related to the store. |
| **_store/_hub** | Contains data for bugfishHUB software deployment. |
| **_store/_hub/_release** | Holds software releases for bugfishHUB. |
| **_store/_hub/_changelog** | Contains changelogs for bugfishHUB software releases. |
| **_store/_hub/_download** | Manages the bugfishHUB software download library. |
| **_store/_hub/_download/_image** | Stores images for the bugfishHUB download library. |
| **_store/_hub/_download/_changelog** | Contains changelogs for downloads in the bugfishHUB library. |
| **_store/_hub/_download/_cache** | Stores cache files for the bugfishHUB download library. |
| **_store/_hub/_download/_release** | Holds release files for the bugfishHUB download library. |
| **_store/_core** | Manages data for bugfishCMS core deployment. |
| **_store/_core/_release** | Contains release files for bugfishCMS core. |
| **_store/_core/_changelog** | Holds changelogs for bugfishCMS core releases. |
| **_store/_app** | Manages data for bugfishApp deployment. |
| **_store/_app/_release** | Contains release files for bugfishApp. |
| **_store/_app/_changelog** | Holds changelogs for bugfishApp releases. |
| **_store/_module** | Manages data for bugfishCMS module deployment. |
| **_store/_module/_release** | Contains release files for bugfishCMS modules. |
| **_store/_module/_image** | Stores images for bugfishCMS module releases. |
| **_store/_module/_changelog** | Holds changelogs for bugfishCMS module releases. |
| **_store/_module/_cache** | Manages cache for bugfishCMS module releases. |
| **_store/_tpl** | Contains available modules for installation via the administrator module. |
| **_store/_tpl/_site** | Contains available site modules for installation. |
| **_store/_tpl/_image** | Stores available site images for installation. |
| **_store/_tpl/_docker** | Manages available Docker images for installation. |
| **_store/_tpl/_extension** | Contains available module extensions for installation. |
| **_store/_tpl/_script** | Manages available script extensions for installation. |
| **_store/app_fetch_all.php** | API to fetch all available bugfishAPP versions. |
| **_store/app_fetch_latest.php** | API to fetch the latest bugfishAPP version. |
| **_store/core_fetch_all.php** | API to fetch all available core versions. |
| **_store/core_fetch_latest.php** | API to fetch the latest core version. |
| **_store/hub_fetch_all.php** | API to fetch all available bugfishHUB versions. |
| **_store/hub_fetch_latest.php** | API to fetch the latest bugfishHUB software version. |
| **_store/hub_fetch_download.php** | API to fetch deployed Hub modules. |
| **_store/module_fetch_all.php** | API to fetch all deployed store modules. |



## cfg_ruleset_sample.php
Sample configuration file for developers to modify CMS settings. Rename to `cfg_ruleset.php` to apply changes. Check the file for configuration parameters.

## index.php
Main index file to initialize the CMS and load the current website section. 

## .htaccess
Automatically created file for server configuration. Changes to this file will be persistent and include explanations for usable configurations.

## updater.php
Script for deploying site mode build updates. Further details can be found in the documentation.
## developer.php
Files for developers to control site functionalities during development. More details are available in the documentation.

## settings.php
 Created after a successful installation using `installer.php` or by manually editing and renaming `settings_sample.php`. 

## robots.txt
Automatically created file for managing search engine robots. Changes to this file will be persistent.
## settings_sample.php
Sample settings file used if the installer fails to create `settings.php`. Manual changes are not required if using the default installer.
## installer.php

Installation script to set up the CMS on the web server and create the `settings.php` file if it does not exist.





















