# Script Modules

## General Information

Script modules can be included in site modules that support them. An installed script module is ready to use for all CMS-installed site modules and is not related to a specific site module.

- Script modules serve as hardlinkable full HTML pages or restricted code injections that are not related to any site module.
- Script modules do not have auto-load functionalities like installing MySQL tables or similar.
- The `RNAME` of scripts must start with "scr" and should contain a maximum of 30 characters.
- Look up our example Script Module in our repository for more information about development.
- Script modules do not have any CMS-related auto-load functions, like installing tables or anything similar.

> See the example Script Module inside our GitHub repository to get insights about creating one yourself!

## Folder Structure

The zip file of the script module you want to deploy should look like this. Replace `RNAME` with the `RNAME` of your script module.

| File/Folder Name    | Description                                                                                             |
|---------------------|---------------------------------------------------------------------------------------------------------|
| `./RNAME/public.php`    | Public full HTML files in this code to be viewed via IFrame or hardlinked. (Optional)                  |
| `./RNAME/restricted.php` | Restricted script file to be injected in necessary areas. (Optional)                                    |
| `./RNAME/version.php`   | Versioning information of the module                                                                    |
| `./RNAME/changelog.php` | Changelog of the module                                                                                 |
| `./RNAME/preview.jpg`   | Preview image for the Administrator Module and store                                                    |

## Installation

### Method 1: Choose Module from Store

1. Login to the Administrator Site Module.
2. Navigate to "Store".
3. Download the desired script module through the web interface.
4. Navigate to the "Scripts" area of the Administrator Module.
5. Install the acquired script.
6. Use the script by hardlinking to the script's `public.php` or access it through the CMS administrator module `restricted.php` or internal functionalities.

### Method 2: Upload in Administrator Module

1. Open the Administrator Module in your web browser.
2. Login as Administrator or privileged user.
3. Go to the "Script Module" area and select "Upload Manually".
4. Upload the script's .zip file.
5. Install the acquired script.
6. Use the script by hardlinking to the script's `public.php` or access it through the CMS administrator module `restricted.php` or internal functionalities.

### Method 3: Upload Manually

1. Login to your web server with FTP/SFTP.
2. Unpack the required Script Modules folder.
3. Move the extracted folder to the `_script` directory of the BugfishCMS installation.
   - Use only alphanumeric characters and underscores (_), with _ only at the start.
4. Use the script by hardlinking to the script's `public.php` or access it through the CMS administrator module `restricted.php` or internal functionalities.

## Example Module

We have an example template image module for developers in our github repository in the _examples folder.

|Module| Description|
|---|----|
|_tplscript | Script Module example to be investigated for developers! |