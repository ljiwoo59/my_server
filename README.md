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

---

# What to know

## Docker

### What is Docker?

> A set of platform as a service products that use OS-level virtualization to deliver software in packages called containers.

- Enables you to seperate your applications from your infrastructure so you can deliver software quickly.
- Packages and run an application in a loosely isolated environment called _container_.
- _Containers_ are lightweighted; it run directly within the host machine's kernel.

### Docker architecture : client-server

![](https://images.velog.io/images/ljiwoo59/post/74073092-5046-409f-8605-4a6efca0ddb8/architecture.svg)

**Docker daemon**
- Listens for Docker API requests (which specifies interfaces that programs can use to talk to the daemon and instruct what to do) and manages Docker objects such as images, containers, networks, and volume.
- Does the heavy lifting of building, running, and distributing Docker containers.

**Docker registry**
- Stores Docker images.
- Docker Hub is a public registory and set as default.

**Docker image**
- Read-only templete with instructions for creating a Docker container.
- Able to create own image or use images created by others and published in registry.
- To make own image, use _Dockerfile_, defining steps needed to create the image.
- Each instruction in _Dockerfile_ creates a layer in the image.

> When you change _Dockerfile_ and rebuild the image, only those layers which have been changed are rebuilt.

```sh
docker build .
```

**Docker container**
- A runnable instance of an image.
- Able to connect one or more networks, attach storage to it, or even create a new image based on its current state.

```sh
docker run -it
```
> By using _-i_ and _-t_ flags, you can provide input while output is logged to terminal.

[Dockerfile reference.](https://docs.docker.com/engine/reference/builder/)

## Debian buster
- One of the oldest operating systems based on Linux kernel.
- Free and open source software.
- Focuses on _stability_ and _reliability_.
- _Buster_ is the development codename for Debian 10, which is current stable distribution.

## Nginx
- Open Source software for web serving, _**reverse proxying**_, caching, load balancing, media streaming, and more.
- Offer low memory usage and high concurrency.
- Rather than creating new processes for each web request, _Nginx_ uses an asynchronous, event-driven approach where requests are handled in a single thread.

### Forward proxy vs. Reverse proxy

> Proxies mediate all kinds of online connections.

**Forward proxy**
- You send a connection request, and a forward proxy retrieves data from the internet.
- Bypass a network block.
- Hides the original client's IP address from any connection target.
- Great for avoiding country restrictions.

**Reverse proxy**
- Controls access to a server on private networks.
- Performs authentication tasks, as well as cache or decrypt data.
- A gateway to a server, or group of servers.
- Provides anonymity for back-end servers, not the clients.
- Adds security and flexibility to a site.
- Excellent at balancing server loads.

> Both can mediate a client's traffic, authorize or block access, and be a single point for either devices or servers.

## MySQL

- Open source **relational database management system (RBDMS)**.
- Database choice for web-based applications, covering the entire range from personal projects and websites, via e-commerce and information services, all the way to high profile web properties including Facebook, Twitter, Youtube, and many more.
- Proven performance, reliability, and ease-of-use.

> **Relational database** is a type of database that stores and provides access to data points that are related to one another.
- Each row in the table is a record with unique ID called the _key_.
- The logical data structures (data tables, views, and indexes) are seperate from the physical storage structures.
-> Able to manage physical data storage without affecting access to that data as a logical structure.
[More info.](https://www.oracle.com/in/database/what-is-a-relational-database/)

> **Non-relational database** is a database that does not have tabular schema of rows and columns.
- Optimized for the specific requirements of the type of data being stored (simeple key/value pairs, JSON documents, graphs).
[More info.](https://docs.microsoft.com/en-us/azure/architecture/data-guide/big-data/non-relational-data)

## WordPress

> A free and open source _content management system (CMS)_ written in _PHP_ and paired with a MySQL or MariaDB.

- Easily set up flexible blogs and websites on top of a MySQL-based backend with PHP processing.
- Stores content and enables a user to create and publish webpages, requiring nothing beyond a domain and a hosting service.

## phpMyAdmin
> A free software tool written in PHP, intended to handle the administration of MySQL over the Web.

- Frequently used operations (managing databases, tables, columns, relations, indexes, users, permissions, etc) can be performed via user interface, while you still have the ability to directly execute SQL queries.

## SSL (Secure Sockets Layer)
> A standard security technology for establishing an encrypted link between server and client.

- To assure visitors their connection is secure, browsers provide _EV indicators_ (green padlock to URL bar).
- A key pair: A **public** and a **private** key.
- Must create a **Certificate Signing Request (CSR)** on your server.
-> Creates a private key and public key on your server.
- _Certificate Authority (CA)_ uses CSR data file to create data structure to match your private key.
[More info.](https://www.digicert.com/what-is-an-ssl-certificate)
