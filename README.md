# Installation
A mysql database should be created with the contents of `install/db.sql` imported.

Rename `public_html/.htaccess.example` to `public_html/.htaccess`

Update the database credentials in `public_html/.htaccess`

Rename `public_html/admin/.htaccess.example` to `public_html/admin/.htaccess`
Update `public_html/admin/.htaccess` file to point to the absolute path of the `.htpasswd` file.

IMPORTANT: default password for `admin` user is `insecurepassword`, this should be changed. To do this update `admin/.htpasswd`
New credentials can be generated here: https://www.web2generators.com/apache-tools/ or https://www.askapache.com/online-tools/htpasswd-generator/htpasswd-generator


## Requirements
Apache/PHP 5.6+/MySQL

## Usage
Add/upload videos to `public_html/video` directory first of all. Delete any that are in there/rename folder if running a new experiment.
Populate the videos database table by running the script from the admin interface `/admin`. Result can also be obtained from there.

## Configuration
Update `public_html/index.php` either remove the contact link, or update with an
email address if required. Also make changes to the about modal to explain what you are trying to achieve (search for `@TODO`).

Update width and height of the `<video>` tag to suit your videos.

Generating the next video to be displayed can be adjusted to your needs `nextvideo.php` is the most basic. `nextvideo2.php` gives an idea of what you could do.

