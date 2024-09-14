# Extension Modules

## General Information

Extension modules can extend the functionality of single site modules. An extension module always fits a specific site module to be executed and used there. It may change navigation/permission entries and much more, depending on the module. Extension modules extend the functionality of existing site modules without editing the site module's code itself.

- The `RNAME` of extension modules should start with "ext" and contain no more than 10 characters.
- Extension modules are designed to extend already installed site modules. Depending on the site module's `RNAME` and the extension's parent setting, an extension will be available for a deployed site module with the valid `RNAME` in the extension's parent `RNAME` setting.
- An extension can only be installed once per site module it is valid for.
- Site extensions will have some pre-defined variables, which you can look up in the comments of example files.

> See the example Extension Module for the Administrator Interface inside our GitHub repository to get insights about creating one yourself! This area is not yet documented here!


## Folder Structure

Organize your site module ZIP file as follows. Replace `RNAME` with your module name.

### _admin
See inside folders readme.md for more information.

```
./RNAME/_admin/
├── mod_setting.php (Module settings script)
```

### _config
See inside folders readme.md for more information.

```
./RNAME/_config/
├── config_pre.php (Pre-startup configuration)
├── config_post.php (Post-startup configuration)
└── config.php (Main configuration file)
```

### _cron
Store your Code for cronjobs in this folder. See example files in our example site module _tplsite which you can obtain in our official store at store.bugfish.eu!

```
./RNAME/
├── _cron/
│   ├── _daily/* (Daily cronjob injection scripts)
│   ├── _hourly/* (Hourly cronjob injection scripts)
│   ├── _weekly/* (Weekly cronjob injection scripts)
│   ├── _yearly/* (Yearly cronjob injection scripts)
│   └── _monthly/* (Monthly cronjob injection scripts)
```

### _css
See inside folders readme.md for more information.

```
./RNAME/_css/ (Add CSS files here)
```

### _js
See inside folders readme.md for more information.

```
./RNAME/_js/ (Add JS files here)
```

### _lib
See inside folders readme.md for more information.

```
./RNAME/_lib/ (Add library files here)
```

### _mysql
See inside folders readme.md for more information.

```
./RNAME/_mysql/ (Add SQL files here for auto-installation)
```

### _wfc
See inside folders readme.md for more information.

```
./RNAME/_wfc/ (Add site widgets here)
```

### Files

```
./RNAME/
├── version.php (Versioning info)
├── changelog.php (Changelog info)
└── preview.jpg (Preview image)
```




## Installation

### Method 1: Choose Module from Store

1. Login to the Administrator Site Module.
2. Navigate to "Store".
3. Download the desired extension through the web interface.
4. Navigate to the "Website Module" area of the Administrator Module.
5. Activate the desired extension on the desired site module.

### Method 2: Upload in Administrator Module

1. Open the Administrator Module in your web browser.
2. Login as Administrator or privileged user.
3. Go to the "Extensions" area and select "Upload Manually".
4. Upload the extension's .zip file.
5. Navigate to the "Website Module" area of the Administrator Module.
6. Activate the desired extension on the desired site module.

### Method 3: Upload Manually

1. Login to your web server with FTP/SFTP.
2. Unpack the required extension modules folder.
3. Move the extracted folder to the `_data/SITEMODNAME/_extension/EXTNAME` directory of the BugfishCMS installation.
   - Use only alphanumeric characters and underscores (_), with _ only at the start.
4. The site module is activated automatically if moved inside that folder. Installation with the Administrator Module is recommended.

## Example Module

We have an example template image module for developers in our github repository in the _examples folder.

|Module| Description|
|---|----|
|_tplext | Extension Module example to be investigated for developers! This extension module is dedicated and useable in the _administrator default integrated module. |





