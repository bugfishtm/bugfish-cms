# Cronjobs

## Installation
During installation, you will be prompted to set up our cronjobs to run at various intervals, according to the name of the scripts in the _cron folder.

## Site Modules Cronjobs
The code to be executed will be placed in the site modules cronjob folder and will be run collectively by the cronjob handler files located in _cron. For more information, refer to the developers' documentation in the Site Modules Area.

Each subfolder within the `_cron` folder corresponds to a specific cron job interval. These subfolders include:

- **`_daily`**: Contains cron jobs that run daily.
- **`_monthly`**: Contains cron jobs that run monthly.
- **`_hourly`**: Contains cron jobs that run hourly.
- **`_weekly`**: Contains cron jobs that run weekly.
- **`_yearly`**: Contains cron jobs that run yearly.

Developers can add their own cron job files in the appropriate subfolders. The files must follow the naming convention `cron.*.php` to be auto-included by the core system.

Cron Files will be executed by CLI and so no Site Module is initialized when cron starts. You need to fetch required data and variables out of the database to work with them. You have access to following information:  

**Site Module Info**

|Variable|Description|
|-----|-----|
|`$object["hive_mode_config"]["info"]`|Array Information from current Site Modules version.php File|
|`$object["hive_mode_config"]["path"]`|Full Folder Path to current used Site Module Cronjob|
|`$object["hive_mode_config"]["name"]`|Site Module Current Folder Name in _site|
|`$object["hive_mode_config"]["prefix"]`| Current Site Module Table Prefix|
|`$object["hive_mode_config"]["cookie"]`| Current Site Module Cookie Prefix|

**Site Module Data**

|Variable|Description|
|-----|-----|
|`$object["var"]` | Variable Object for Current Site Modules Variables|
|`$object["mail"]` | Mail Object for Current Site Module if SMTP Constants in Variable Object are Set. |
|`$object["mail_template"]` | Current Mail Template Object if current Cronjobs Site Module.|
|`$object["mail_template"]` | Current Mail Template Object if current Cronjobs Site Module.|

**Constants**  
Besides the listed constants below, there may be core and site module variables set during the cronjob execution process which are not listed here.

|Variable|Description|
|-----|-----|
|\_CRON_SPACE\_| Spacer Break or Newline Tag for Newlines in Cronjob Logging Output.|



## Extension Cronjobs
The code to be executed will be placed in the extension modules cronjob folder and will be run collectively by the cronjob handler files located in _cron. For more details, see the developers' documentation in the Extension Modules Area.

If the executed cronjob is an extension of a site module you will have following additional data.

|Variable|Description|
|-----|-----|
|`$object["extension"]["info"]`| Current Extension version.php Array |
|`$object["extension"]["path"]`| Current Extension Folder Path |
|`$object["extension"]["name"]`| Current Extension Name |
|`$object["extension"]["prefix"]`| Current Extension Table Prefix |
|`$object["extension"]["cookie"]`| Current Extension Cookie Prefix |