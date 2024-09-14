# Installation

## Prerequisites

Before you begin the installation, ensure you have the following:

- Apache2 webserver recommended to use hosting functionalities.
- Apache2 modules: `rewrite`, `ssl`.
- Access to a MySQL database (remote or local).
- PHP 8 installed with `curl`, `mysqli`, and `mbstring` modules. Website will ask you for other required modules if necessary and not installed.
- At least 1GB of available webspace recommended.

## Installation Steps

1. **Download/Clone the Repository:**
	- You can download the repository as a ZIP file or clone it using Git.
```markdown
git clone https://github.com/bugfishtm/bugfish-cms.git
```

2. **Copy Files:**
	- Navigate to the `/source` directory within the repository or in the choosen release.
	- Copy all files from the `/source` directory to your website's public html folder.

3. **Configure the Website:**
	- Access the website through your browser.
	- Follow the on-screen installation instructions to complete the setup.

4. **Set Up Cronjobs (Optional):**
	- To take full advantage of the CMS's features, it is recommended that you set up our PHP cronjob scripts to run at different intervals on your server.
	- Check the CMS _cron folder for the cronjob files and configure them to run at intervals based on the file names (e.g., daily.php for daily execution, monthly.php for monthly execution, and so on).

## Initial Login

!!! danger "Change the default password immediately after your first login."

After installation, log in with the default credentials:

- **Username:** admin
- **Password:** changeme
