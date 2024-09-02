# Image Modules

Test out our example image module if you want to deploy your own image modules!

## Development

### General Information

Image modules to be deployed can include full website projects not related to this CMS, such as WordPress and others.

- Image modules do not have auto-load functionalities like installing MySQL tables or similar.
- Important files to be present are `preview.jpg`, `changelog.php`, and `version.php` in the image folder. Place the website content you want to deploy with that image module in the `htdocs` folder inside your image module. BugfishCMS will create an identifier file for the deployed image module in its deployed folder. You can look it up for investigation. These files are only created if you are using the administrator module to deploy the image module, which is highly recommended.
- Do not use more than 50 characters for your module's `rname`, and start every `rname` with "img". Example: `imgwordpress`. Put versioning information in the related `version.php` file.
- There are no controlling features for deployed website images inside the administrator module. These images are fully independent and can be served through dedicated Apache vhosts or by going to the folder inside the BugfishCMS structure, which is `_image/yourdeploymentname`.
- Image modules cannot alter, extend, or modify existing site modules or extensions; they serve a different purpose, such as deploying other projects like WordPress. Many features are planned for the future, but this is likely the case for every project. Let's see what we can make happen.
- Stick as close as possible to the example files found in our repository; they will show you how things work. Mind the comments.

> See the example image module inside our GitHub repository to get insights about creating one yourself!

### Folder Structure

The zip file of the image module you want to deploy should look like this. Replace `RNAME` with the `RNAME` of your image module.

| File/Folder Name          | Description                                                                                                                                                                                   |
|---------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `./RNAME/htdocs/*`        | Source code of the project you want to deploy with that image module. This can be the content of the WordPress `htdocs` folder or any other deployable project via a single `htdocs` folder. |
| `./RNAME/version.php`     | Versioning information of the module                                                                                                                 |
| `./RNAME/changelog.php`   | Changelog of the module                                                                                                                                                                     |
| `./RNAME/preview.jpg`     | Preview image for the Administrator Module and store                                                                                                                  |

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
3. Move the extracted folder to the `_image` directory of the BugfishCMS installation.
   - Use only alphanumeric characters and underscores (_), but _ only at the start.
4. Navigate to your uploaded folder with your web browser and follow the website images instruction or create necessary files depending on the deployed website image and its instructions.
