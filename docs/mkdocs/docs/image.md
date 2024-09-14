# Image Modules


## General Information

Image modules to be deployed can include full website projects not related to this CMS, such as WordPress and others.

- Image modules do not have auto-load functionalities like installing MySQL tables or similar.
- Important files to be present are `preview.jpg`, `changelog.php`, and `version.php` in the image folder. Place the website content you want to deploy with that image module in the `htdocs` folder inside your image module. BugfishCMS will create an identifier file for the deployed image module in its deployed folder. You can look it up for investigation. These files are only created if you are using the administrator module to deploy the image module, which is highly recommended.
- There are no controlling features for deployed website images inside the administrator module. These images are fully independent and can be served through dedicated Apache vhosts or by going to the folder inside the BugfishCMS structure, which is `_image/yourdeploymentname`.
- Stick as close as possible to the example files found in our repository; they will show you how things work. Mind the comments.

> See the example image module inside our GitHub repository to get insights about creating one yourself!

## Files and Folders
- `./htdocs`: Put the Website to be deployed in here, this can be any website (unziped source) which you can imagine. (wordpress for example or more) 
- `preview.jpg`: Preview image for the Administrator Module and Store.
- `changelog.php`: Document the module's changelog.
- `version.php`: Contains versioning information.

Place website content in the `htdocs` folder inside your image module.

## Deployment Identifier File
An identifier file is created if you use the Administrator Module to deploy the image module (recommended).

## Naming Conventions
- Max 20 characters for module name (`RNAME`).
- Start name with "img" (e.g., `imgwordpress`).

## Limitations
Image modules:
- Cannot alter/extend existing site modules or extensions.
- Serve to deploy projects like WordPress independently.
- No control features in the Administrator Module.


## Installation

### Method 1: Choose Module from Store

1. Login to the Administrator Site Module.
2. Navigate to "Store".
3. Download the desired image module through the web interface.
4. Navigate to the "Image Module" area of the Administrator Module.
5. Install the uploaded image template with a desired name.
6. Follow the required steps of the image module to deploy the website by navigating to the website images subfolder or Apache2 vhost created for this image template.

### Method 2: Upload in Administrator Module

1. Open the Administrator Module in your web browser.
2. Login as Administrator or privileged user.
3. Go to the "Image Module" area and select "Upload Manually".
4. Upload the image's .zip file.
5. Install the uploaded image template with a desired name.
6. Follow the required steps of the image module to deploy the website by navigating to the website images subfolder or Apache2 vhost created for this image template.

### Method 3: Upload Manually

1. Login to your web server with FTP/SFTP.
2. Unpack the required Site Modules folder.
3. Move the extracted folder containing the files like `version.php` to the `_image` directory of the BugfishCMS installation.
	- Use only alphanumeric characters for the deployment folder. Official modules often use an underscore at the start, this is okay.
4. Navigate to your uploaded folder `example.domain/_image/FOLDERNAME/htdocs/` with your web browser and follow the website images instruction or create necessary files depending on the deployed website image and its instructions.

## Example Module

We have an example template image module for developers in our github repository in the _examples folder.

|Module| Description|
|---|----|
|_tplimage | Website Image Module example to be investigated for developers! |