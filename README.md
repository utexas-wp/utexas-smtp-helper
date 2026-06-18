# UTexas SMTP Helper

This WordPress plugin supports email delivery on the Pantheon Hosting service. It populates service-provided credentials for the [WP Mail SMTP](https://wpmailsmtp.com/) plugin, allowing sites to send mail without needing to create their own credentials.

## Installation

1. Download the latest version of UTexas SMTP Helper WP at https://wcms.its.utexas.edu/download-utexas-smtp-helper.php
2. In the site's Pantheon dashboard, put the "Dev" environment in SFTP mode and clone the database and files from the "Live" environment into the "Dev" environment (under "Database/Files").
3. Navigate to the "Dev" environment in the browser and sign into the WordPress site with an administrative account.
4. In WordPress "Dev" environment UI, go to Plugins (`/wp-admin/plugins.php`).
5. Go to **Plugins > Add New Plugin** (`/wp-admin/plugin-install.php`)
6. Using the "Search plugins" form, find and add "WP Mail SMTP", authored by Syed Balki.
7. Activate the "WP Mail SMTP" plugin. It will redirect you to an external setup helper which you do not need to use. Click "Go back to the Dashboard."
6. From the same interface, click "Upload New Plugin."
7. Upload the zip file and activate the plugin.
8. Confirm you can send email at **WP Mail SMTP > Tools** (`wp-admin/admin.php?page=wp-mail-smtp-tools`)
9. Use the Pantheon dashboard to commit the file changes in the "Dev" environment and deploy to the "Test" and "Live" environments, activating and testing the plugins in those environments.

> Note: you can adjust some settings for email, such as the "From" email address and name, at `/wp-admin/admin.php?page=wp-mail-smtp`; you do not need to use the "Setup Wizard" and do not need to purchase the "Pro" version of the plugin to send email.

## Updates

Updates are provided by the WordPress Update API. Use either the WordPress UI to update this plugin, or use Terminus (`terminus wp <site>.dev -- plugin update utexas-smtp-helper`).

## For Developers

### Coding standards
This project follows the [WordPress-Core coding standard](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/).
### Release protocol
See `wp-content/plugins/utexas-smtp-helper/.github/ISSUE_TEMPLATE/release.md`

### Download hosting
We maintain a convenience script at https://wcms.its.utexas.edu/download-utexas-smtp-helper.php that provides a simpler way to download the plugin than going to GitHub to get the latest release. This script queries the GitHub repository for the latest release and redirects output to that URL:

```php
<?php

$url = 'https://api.github.com/repos/utexas-wp/utexas-smtp-helper/releases/latest';
$headers = [
    'Accept: application/vnd.github.v3+json',
    'User-Agent: curl'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = json_decode(curl_exec($ch));
curl_close($ch);

$browser_download_url = $response->assets[0]->browser_download_url;

header("Location: {$browser_download_url}");

exit();
```
