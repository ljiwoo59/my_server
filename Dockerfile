FROM debian:buster
LABEL maintainer="Ji Woo Lee"
RUN apt-get update && apt-get install -y \
	    openssl \
	    nginx \
	    mariadb-server \
	    php-fpm \
	    php-mysql \
	    php-mbstring
COPY $PWD/srcs/default etc/nginx/sites-available/default
COPY $PWD/srcs/run.sh ./
COPY $PWD/srcs/tmp/wordpress/ /var/www/html/wordpress
COPY $PWD/srcs/tmp/phpMyAdmin-4.9.7-all-languages /var/www/html/phpmyadmin
RUN chmod +x run.sh
EXPOSE 80 443
CMD ./run.sh
