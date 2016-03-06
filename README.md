Affili.net PHP API Client
======

A very user-friendly PHP client for [Affili.net](https://publisher.affili.net/).

Requirements:
- PHP must be 5.5 or higher.

## Instalation

Use [Composer](http://getcomposer.org).

Install Composer Globally (Linux / Unix / OSX):

```bash
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```

Run this Composer command to install the latest stable version of the client, in the current folder:

```bash
composer require izziaraffaele/affilinet-php
```

After installing, require Composer's autoloader and you're good to go:

```php
<?php
require 'vendor/autoload.php';
```


## Getting Started

```php

// Create a client for Affilinet api
$client = new Affilinet\Client( $username, $password );

// Get the resource you need ( for now just statistics is available )
$statisticResource = $client->resource('statistics');

// Call methods of the api on the resource object
$response = $statisticResource->getSubIdStatistics( $parameters );

// check errors and get results
if( $response->hasErrors() )
{
    var_dump( $response->errors() );
}
else
{
    var_dump( $response->body() );
}

```

## Docs

Please refer to the source code for now, while a proper documentation is made.
