# Piano analytics (formerly ‘AT Internet’) PHP client

This library enables you to get queries from the Piano Analytics Reporting API v3.
This is a third-party library.
A subscription to Piano Analytics is required.

## Requirements ##
* [PHP 8.x](https://www.php.net/)

## Installation ##

You can use **Composer** or **Download the Release**

### Composer

The preferred method is via [composer](https://getcomposer.org/). Follow the
[installation instructions](https://getcomposer.org/doc/00-intro.md) if you do not already have
composer installed.

Once composer is installed, execute the following command in your project root to install this library:

```sh
composer require omroepgelderland/atinternet-php-api
```

Finally, be sure to include the autoloader:

```php
require_once '/path/to/your-project/vendor/autoload.php';
```

## Usage example

1. Create an API key in your [Piano Analytics account](https://analytics.piano.io/profile/#/apikeys).
2. Get the access key and secret key from the API key.
3. Find the site ID’s in [Piano Analytics access management](https://analytics.piano.io/access-management/#/sites).
   Select a site on the page and copy the id from the address bar.

```php
require_once __DIR__.'/../vendor/autoload.php';

use \atinternet_php_api\filter;
use \atinternet_php_api\period;

$site_id = 0;
$access_key = '';
$secret_key = '';

// Create API connection
$at = new \atinternet_php_api\Client($access_key, $secret_key);

// Get page titles and number of visits for each page,
// where the page title is not empty and domain is example.com,
// ordered by the number of visits from high to low.
$request = new \atinternet_php_api\Request($at, [
    'sites' => [$site_id],
    'columns' => [
        'date',
        'article_id',
        'site_id',
        'domain',
        'platform',
        'device_type',
        'os_group',
        'm_unique_visitors',
        'm_visits',
        'm_page_loads'
    ],
    'period' => new period\Day(
        new \DateTime('2023-06-01'),
        new \DateTime('2023-06-10')
    ),
    'sort' => [
        '-m_page_loads'
    ],
    'property_filter' => new filter\ListAnd(
        new filter\IsEmpty(
            'article_id',
            false
        ),
        new filter\Contains(
            'domain',
            [
                'example.nl',
                'www.example.nl'
            ]
        )
    )
]);

// All results
foreach ( $request->get_result_rows() as $item ) {
    echo \json_encode($item)."\n";
}

// Number of results
var_dump($request->get_rowcount());

// Cumulative metrics for all resulting rows
echo \json_encode($request->get_total())."\n";
```
