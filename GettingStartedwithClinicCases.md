### INSTALL ###

Below are instructions on how to install ClinicCases on a typical webserver. If you need help, please go to our forums at http://www.cliniccases.com/forums.

### REQUIREMENTS ###
1. Linux webserver  (Note: ClinicCases has been run on Windows servers, although this is not officially supported).
2. Mysql
3. PHP version 4 or higher
4. Mail server (e.g, exim4, sendmail.  Most servers will already have this installed.).  Used for sending notifications to users.
5. GD libraries for php.
6. It is recommended that you run ClinicCases on a secure server (SSL, TSL).

### STEPS - New Installation ###

1. Upload the compressed source file to your webserver and untar.

2. CHMOD 777 'images\_tmp', 'people', 'docs'

3. Using PhpMyAdmin (which comes with most installations of mysql), go to your database and select "Import."  Import the file CC.sql.  Your database should now be setup with 19 tables. (There are other ways to do this, but this should work best for most users).

4. Edit _CONFIG.php to reflect your database settings and other settings._

5. (optional) In order for cron jobs to work (a weekly email to report
to professors and a journal rss feed), you must insert your server
path into cron.txt and update your crontab.

6.  Delete the _INSTALL directory._

### STEPS - Updgrade from ClinicCases 5 to ClinicCases 6 ###

1. Unzip all files in ClinicCases6 package to your target directory, overwriting old files.
2. Run upgrade\_to\_cc6.php
3. Delete the _INSTALL directory_

### REGISTER ###

PLEASE REGISTER your ClinicCases installation at https://cliniccases.com/registration/. This free registration will allow you to be informed of updates and security patches.

### DATA MIGRATION ###

Migrating existing cases from another case management system (TimeMatters, Amicus, Tabs III, etc) may take some expertise. Either contact your IT department or go to the forums for assistance.  Three Pipe Problem, LLC (judson@threepipeproblem.com) is happy to this, along with customization and support) for a fee.