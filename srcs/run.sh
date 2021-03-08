#!/bin/bash

openssl req -x509 -nodes -days 365 -subj "/C=KR/ST=Seoul/O=42Seoul" -newkey rsa:2048 -keyout /etc/ssl/private/localhost.key -out /etc/ssl/certs/localhost.crt
chmod 600 /etc/ssl/private/localhost.key /etc/ssl/certs/localhost.crt
service mysql start
chown -R www-data:www-data /var/www/html
mkdir -p /var/lib/phpmyadmin/tmp
chown -R www-data:www-data /var/lib/phpmyadmin
mysql -e 'CREATE DATABASE wordpress;'
mysql -e 'GRANT ALL ON wordpress.* TO "wordpress_user"@"localhost" IDENTIFIED BY "password";'
mysql < var/www/html/phpmyadmin/sql/create_tables.sql
service php7.3-fpm start
nginx -g 'daemon off;'
