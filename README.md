# Laravel using Geolite Maxmind
API that supports a RESTful GET endpoint that returns the country when supplied with an IP using Laravel 5.7 and MySQL

## Requirements

* PHP >= 7.1

### Laravel

* Laravel >= 5.7

### MySQL

* Mysql >= 5.7

## Usage

Once you have registered the service provider (supports auto discovery), you can use the command `php artisan geoip:update`

<ul>
<li>After cloning this repository, go to the root folder, run the following command/s,
<pre>
    composer install
    composer update</pre>
</li>
<li>Rename .env.example to .env and provide your database details there.</li>
<li>Run <code>php artisan migrate</code> to create database table.</li>
<li>Run <code>php artisan key:generate</code> to set application key. </li>

</ul>
