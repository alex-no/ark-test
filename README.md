<h1>ARK test project</h1>

## Expand Project Files

 - Do "git clone" project from: https://github.com/alex-no/ark-test.git
 - Run in project folder composer command: composer install

## Configure DB access and run MySQL-migration

 - Create database for project by SLQ requesst: CREATE DATABASE IF NOT EXISTS `ark_?????` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
    and create MySQL-user whiht access to this DB. Use documetntation there https://dev.mysql.com/doc/mysql-getting-started/en/
 - Copy file ".env.example" to ".env" ih the root foolder of project;
 - In the file ".env" set parameters "DB_*****" for accesss to MySQL or MariaDB
 - Run migration-command from root-directory: php artisan migrate

## Configure WEB-server

 - Configure your web-server (Apache2, Nginx,...) - create virtual host to directory "public".
 - Try to open site in your browser.