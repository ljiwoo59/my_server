# my_server
Wordpress + phpMyAdmin using Docker

## Objectives

* Using _**Docker**_, set up a web server with _**Nginx**_ on _Deiban Buster_.
* Run several services at the same time: _**WordPress website, phpMyAdmin, and MySQL**_.
* Apply _SSL protocol_.
* Apply _autoindex_.

## Basic Implementation

### Redirecting HTTP to HTTPS
* By default, **Nginx HTTP** server listens for incoming connection and binds on port **80**.
* **HTTPS** is port **443**.
```
return 301 https://$host$request_uri
```
* **return 301** tells browser that this is a permanent redirect.
* **https://$host$request_uri** is a short code to specify **HTTPS** version of whatever the user have typed.

### Applying SSL protocol

> **OpenSSL** is a useful open-source command-line toolkit for working with X.509 certificates, certificate signing requests, and cryptographic keys.

* Self-signed certificate is not signed by _Certificate Authority_, but is easy to make and does not cost money.

```
openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/localhost.key -out /etc/ssl/certs/localhost.crt
```
* **req** specifies that we want to use **-x509**
* **x509** specifies that we want to create a self-signed certificate instead of generating a certificate signing request.
* **nodes** skips the option to secure our certificate with a passphrase, so that nginx can read it
* **newkey rsa:2048** specifies that we want to generate both a new certificate and a new key with an RSA key of 2048 bits

### PHP extensions
* Nginx does not contain native PHP processing.
-> **php-fpm** (fastCGI processing manager) 
* **php-mysql** for PHP code to run under Nginx server and talk to our MySQL database.
* **php-zip** supports uploading .zip files to phpMyAdmin.
* **php-mbstring** manages non-ASCII strings and convert strings to different encodings.

### Docker container
* Containers are automatically exited after performing the process.
-> Nginx server will be closed.
* **-g daemon off** will set **Nginx** to stay in foreground, so that Docker can track the process properly.

## More explainations
https://velog.io/@ljiwoo59/ftserver
