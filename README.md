![HortiBuddy](assets/logo.png)

## Introduction

HortiBuddy is meant to be a gardener's companion. It can either be a standalone mobile database, or a central self-hosted and multi-input database. The point is to encourage the minimal daily practice of writing down key metrics of a gardening environment, so that historical data can be later analyzed for improvement.

## SQLite3 Tidbits

```sql
/* New table schema */
CREATE TABLE IF NOT EXISTS $room (id INTEGER PRIMARY KEY AUTOINCREMENT, sec INTEGER, date TEXT, time TEXT, temp INTEGER, rh INTEGER, light TEXT, period TEXT, par INTEGER, notes TEXT);

/* Change table/room name */
ALTER TABLE `main`.`$oldname` RENAME TO `$newname`;

/* Delete table/room */
DROP TABLE `main`.`$room`;

/* Set secure variable */
INSERT INTO $room (sec) VALUES (0|1);

/* New Log Entry */
INSERT INTO $room (date, time, temp, rh, light, period) VALUES ('$date', '$time', '$temp', '$rh', '$light', '$period');
```

## Installation

HortiBuddy currently requires the following:

* PHP FPM v7.2
* NGINX
* SQLite3

On an `apt` based system, you can run something like:

```bash
sudo apt-get install -y nginx sqlite3 php7.2-fpm php7.2-sqlite3
```

#### 1. Clone the repository

```bash
cd /var/www/html
sudo git clone ssh://git@git.blackrookllc.com:222/black-rook-llc/horti-buddy.git hortibuddy
```

#### 2. Create a vhost

```bash
sudo nano /etc/nginx/sites-available/hortibuddy.conf
```

Paste the following:

```conf
server {
    index index.php index.html;
    listen 80;
    root /var/www/html/hortibuddy;
    server_name hortibuddy;

    server_tokens off;

    error_page  405     =200 $uri;

    # Allow access to '^/.well-known/'
    location ~ ^/.well-known/ {
        allow all;
        access_log off;
        log_not_found off;
        autoindex off;
        #alias /var/www/html;
    }

    # Deny all attempts to access hidden files such as .htaccess.
    location ~ /\. { deny all; }

    # Handling noisy messages
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt { access_log off; log_not_found off; }

    # Normal PHP scripts
    location ~ \.php$ {
        # regex to split $uri to $fastcgi_script_name and $fastcgi_path
        fastcgi_split_path_info ^(.+\.php)(/.+)$;

        # Check that the PHP script exists before passing it
        try_files $fastcgi_script_name =404;

        # Bypass the fact that try_files resets $fastcgi_path_info
        # see: http://trac.nginx.org/nginx/ticket/321
        set $path_info $fastcgi_path_info;
        fastcgi_param PATH_INFO $path_info;

        fastcgi_index index.php;
        fastcgi_param  SCRIPT_FILENAME    $document_root$fastcgi_script_name;
        fastcgi_param  QUERY_STRING       $query_string;
        fastcgi_param  REQUEST_METHOD     $request_method;
        fastcgi_param  CONTENT_TYPE       $content_type;
        fastcgi_param  CONTENT_LENGTH     $content_length;

        fastcgi_param  SCRIPT_NAME        $fastcgi_script_name;
        fastcgi_param  REQUEST_URI        $request_uri;
        fastcgi_param  DOCUMENT_URI       $document_uri;
        fastcgi_param  DOCUMENT_ROOT      $document_root;
        fastcgi_param  SERVER_PROTOCOL    $server_protocol;
        fastcgi_param  REQUEST_SCHEME     $scheme;
        fastcgi_param  HTTPS              $https if_not_empty;

        fastcgi_param  GATEWAY_INTERFACE  CGI/1.1;
        fastcgi_param  SERVER_SOFTWARE    nginx/$nginx_version;

        fastcgi_param  REMOTE_ADDR        $remote_addr;
        fastcgi_param  REMOTE_PORT        $remote_port;
        fastcgi_param  SERVER_ADDR        $server_addr;
        fastcgi_param  SERVER_PORT        $server_port;
        fastcgi_param  SERVER_NAME        $server_name;

        # PHP only, required if PHP was built with --enable-force-cgi-redirect
        fastcgi_param  REDIRECT_STATUS    200;

        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;

        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

#### 3. Enable and restart services

```bash
sudo ln -s /etc/nginx/sites-available/hortibuddy.conf /etc/nginx/sites-enabled/hortibuddy.conf
sudo service nginx restart
sudo service php7.2-fpm restart
```

## Roadmap

The eventual goal is to be able to release this as a deployable app on mobile platforms and via Docker.

Future features include:

* Notifications at user-defined intervals to get data, or perform other garden related tasks.
* Write and read from the calendar to set photoperiod dates, recurring tasks, etc.
* Store data into InfluxDB, so as to be compatible with the future hardware and to allow easy Grafana access.

### Current TODO

- [x] Databases need a way to manage tables/rooms
- [x] Forces the right room name
- [ ] PIN protect (GPG encrypt) databases if desired
    - [ ] Should be able to add encryption if created initially without it
- [ ] More responsive design for larger screens (focus is mobile)
- [x] Template files for HTML rendering
- [ ] Sanitize user inputs
    - [ ] Remove spaces, replace with a dash
    - [ ] Validate the input for each form
    - [ ] Change to uppercase everytime