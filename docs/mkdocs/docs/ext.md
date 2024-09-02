## Extension Modules

Extension modules can extend the functionality of single site modules. An extension module always fits a specific site module to be executed and used there. It may change navigation/permission entries and much more, depending on the module. Extension modules extend the functionality of existing site modules without editing the site module's code itself.

### Development

#### General Information

- The `RNAME` of extension modules should start with "ext" and contain no more than 10 characters.
- Extension modules are designed to extend already installed site modules. Depending on the site module's `RNAME` and the extension's parent setting, an extension will be available for a deployed site module with the valid `RNAME` in the extension's parent `RNAME` setting.
- An extension can only be installed once per site module it is valid for.
- Site extensions will have some pre-defined variables, which you can look up in the comments of example files.

> See the example Extension Module for the Administrator Interface inside our GitHub repository to get insights about creating one yourself! This area is not yet documented here!

#### Folder Structure

The zip file of the extension module you want to deploy should look like this. Replace `RNAME` with the `RNAME` of your extension module.

| File/Folder Name            | Description                                                                                                                         |
|-----------------------------|-------------------------------------------------------------------------------------------------------------------------------------|
| `./RNAME/_admin/mod_setting.php` | Page to control administrator page module settings for this site module's extension.                                             |
| `./RNAME/_admin/mod_index.php`   | Extends administration module's `load.php` by adding more available locations for indexing.                                        |
| `./RNAME/_config/config_post.php` | Addition for post-configuration if the extension is activated in the site module and the site module is active.                    |
| `./RNAME/_config/config_pre.php`  | Addition for pre-configuration if the extension is activated in the site module and the site module is active.                     |
| `./RNAME/_cron/*`                | Additions for related site module cron jobs. See example for usage.                                                               |
| `./RNAME/_css/css.*.php`          | Additions for related site module stylesheet `autoload` file.                                                                       |
| `./RNAME/_js/js.*.php`            | Additions for related site module JavaScript `autoload` file.                                                                       |
| `./RNAME/_mysql/mysql.*.php`      | Additions for related site module MySQL tables.                                                                                   |
| `./RNAME/_lib/lib.*.php`          | Additions for related site module library functionalities.                                                                          |
| `./RNAME/_wfc/wfc.*.php`          | Additions for related site module WFC functionalities.                                                                             |
| `./RNAME/version.php`            | Versioning information of the module.                                                                                               |
| `./RNAME/changelog.php`          | Changelog of the module.                                                                                                            |
| `./RNAME/preview.jpg`            | Preview image for the Administrator Module and store.                                                                             |

### Installation

#### Method 1: Choose Module from Store

1. Login to the Administrator Site Module.
2. Navigate to "Store".
3. Download the desired extension through the web interface.
4. Navigate to the "Website Module" area of the Administrator Module.
5. Activate the desired extension on the desired site module.

#### Method 2: Upload in Administrator Module

1. Open the Administrator Module in your web browser.
2. Login as Administrator or privileged user.
3. Go to the "Extensions" area and select "Upload Manually".
4. Upload the extension's .zip file.
5. Navigate to the "Website Module" area of the Administrator Module.
6. Activate the desired extension on the desired site module.

#### Method 3: Upload Manually

1. Login to your web server with FTP/SFTP.
2. Unpack the required extension modules folder.
3. Move the extracted folder to the `_ext/SITEMODFOLDERNAME` directory of the BugfishCMS installation.
   - Use only alphanumeric characters and underscores (_), with _ only at the start.
4. The site module is activated automatically if moved inside that folder. Installation with the Administrator Module is recommended.
