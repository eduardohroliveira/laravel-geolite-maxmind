# Laravel using Geolite Maxmind
API that supports a RESTful GET endpoint that returns the country when supplied with an IP using Laravel 5.7 and MySQL

## Requirements

* PHP >= 7.1

### Laravel

* Laravel >= 5.7

### MySQL

* Mysql >= 5.7

## Usage

You need to follow these commands in order to use and run project:

<ul>
<li>After cloning this repository, go to the root folder, and edit .env file to setup MySQL properties:
        <pre>
* DB_HOST=
* DB_PORT=
* DB_DATABASE=
* DB_USERNAME=
* DB_PASSWORD=
    </pre>
    
    - You also can change GEOLITE properties, but if you don't, it will still work without any changes.
<pre>
* GEOLITE_LOCAL_PATH="storage/app/"
* GEOLITE_URL="http://geolite.maxmind.com/download/geoip/database/GeoIPCountryCSV.zip"
* GEOLITE_FILENAME="GeoIPCountryWhois.csv"
</pre>
</li>
    After that, you need to run the following commands:
<li>Run <code>php artisan migrate</code> to create database table.</li>
<li>Run <code>php artisan key:generate</code> to set application key. </li>
<li>Run <code>php artisan geolocation:update</code> to populate database table with updated data. </li>
<li>Finally, you just need to run <code>php artisan serve</code> to start web server and run application. </li>

</ul>

* Now you should use any HTTP client that supports , such as Postman or Insomnia or any other tool.
