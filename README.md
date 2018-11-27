# Geolite Maxmind with PHP Laravel 
API that supports a RESTful GET endpoint that returns the country when supplied with an IP using Laravel 5.7 and MySQL

## Requirements:

* PHP >= 7.1

* Laravel >= 5.7

* Mysql >= 5.7

* Composer

## Setup/Configuration:

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
        </li>
        <li>You also can change GEOLITE properties, but if you don't, it will still work without any changes:
<pre>
* GEOLITE_LOCAL_PATH="storage/app/"
* GEOLITE_URL="http://geolite.maxmind.com/download/geoip/database/GeoIPCountryCSV.zip"
* GEOLITE_FILENAME="GeoIPCountryWhois.csv"
</pre>
</li>
    After that, you need to run the following commands:
<li>Run <code>composer update</code> to create database table.</li>
<li>Run <code>php artisan migrate</code> to create database table.</li>
<li>Run <code>php artisan key:generate</code> to set application key. </li>
<li>Run <code>php artisan geolocation:update</code> to populate database table with updated data. </li>
 </ul>
 <ul>
<li>Finally, you just need to run <code>php artisan serve</code> to start web server and run application. </li>
</ul>

## Usage

* Now you should use any API testing tool, such as Postman or Insomnia or any other of your preference to send requests to the API.

By default, php artisan will start web server on port 8000 (localhost). So now, using one of those tools, you just need to request using GET method to 'api/locationByIP', with the 'IP' parameter:

<ul>
  <li>GET request to return the country associated with an IP address: <pre>http://127.0.0.1:8000/api/locationByIP?IP=2.16.6.0</pre></li>
</ul>
* The API will return a JSON with 'country_code' and 'country_name' elements. In case of any failure, these elements won't be returned and a list of erros with be returned.

** Success Example:
<pre>
<code>{"country_code":"DE","country_name":"Germany"}</code>
</pre>

** Failure Example:
<pre>
<code>{"IP":["The ip field is required."]}</code>
</pre>

## Tests

There are some unit/feature tests implemented using PHPUnit and that can be used as examples for some other automated tests:
<li>Go to root folder and run <code>./vendor/phpunit/phpunit/phpunit</code>.</li>
 </ul>

Once you do this, some tests will be executed and result will be shown on terminal.
