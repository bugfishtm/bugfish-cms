# Docker Modules

## General Information

This CMS simplifies the process of container orchestration by offering an easy-to-use interface for setting up and managing Dockerized applications with Docker Modules.

## File Structure
- **version.php**: Contains version information of the module.
- **preview.jpg**: A preview image displayed in the CMS store or module overview.
- **changelog.php**: A changelog file that tracks all updates and changes made to the module.
- **index.php**: A file that prevents directory listing and secures the module directory.
- **docker-compose.yml**: The Docker Compose file that defines the services, networks, and volumes for your Docker environment. This file includes dynamic substitutions, which can be configured via the CMS admin interface. Each substitution key must be followed by a description explaining its purpose.

## Example of Dynamic Substitution
```yaml
ports:
  - <<!!Exposed_Port:The exposed port to be used for MySQL remote connections.!!>>:3306
```
In the example above, the `<<!!Exposed_Port:The exposed port to be used for MySQL remote connections.!!>>` placeholder is dynamically set in the CMS interface. The description following the key provides clarity on its purpose, making it easier for users to configure the necessary settings. Exposed_Port is the key, following after : is the keys description for the administrator interface.

## Installation

### Method 1: Choose Module from Store

1. Login to the Administrator Site Module.
2. Navigate to "Docker" and Select the "Store Tab".
3. Download the desired script module through the web interface.
4. Install through or docker integration interface in "Templates" Tab.

### Method 2: Upload in Administrator Module

1. Open the Administrator Module in your web browser.
2. Login as Administrator or privileged user.
3. Go to the "Docker" area and select "Upload".
4. Upload the docker module's .zip file.
5. Install through or docker integration interface in "Templates" Tab.

## Example Module

We have an example template image module for developers in our github repository in the _examples folder.

|Module| Description|
|---|----|
|_tplmysql | Docker Module example to be investigated for developers! This is an Image to Deploy MySQL 8.0 for Remote Connections. |
|_tplkimai | Docker Module example to be investigated for developers! This is an Image to Deploy Kimai Time Tracking Software.|