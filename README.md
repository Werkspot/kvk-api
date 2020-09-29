Kvk Api
===============
This package provides a simple integration of the [Official KVK Api][kvk-api-documentation] for your PHP project.

[![Build Status](https://scrutinizer-ci.com/g/Werkspot/kvk-api/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Werkspot/kvk-api/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Werkspot/kvk-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Werkspot/kvk-api/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Werkspot/kvk-api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Werkspot/kvk-api/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/werkspot/kvk-api/v/stable)](https://packagist.org/packages/werkspot/kvk-api)
[![License](https://poser.pugx.org/werkspot/kvk-api/license)](https://packagist.org/packages/werkspot/kvk-api)

Installation
------------
With [composer](http://packagist.org), add:

```bash
$ composer require werkspot/kvk-api
```


ROOT CERTIFICATE
-----
On October 28, 2020, the KVK started signing the SSL connection with a self signed [certificate from the dutch government][kvk-guide].
To prevent this package from breaking current implementations; SSL verification will be disabled by default. 
If you would like to enable the verification of the SSL certificates you can implement the path to the certificate (included) as the 3rd parameter of the factory.
When failing to do so a deprecation error wil be triggered (E_USER_DEPRECATED). 

Usage
-----
profile query
```php
use Werkspot\KvkApi\Http\Endpoint\Production;
use Werkspot\KvkApi\Http\Search\ProfileQuery;
use Werkspot\KvkApi\KvkClientFactory;

$client = KvkClientFactory::create('<YOUR_API_KEY>', new Production(), '/path/to/dutch-government-certificate.pem');

$profileQuery = new ProfileQuery();
$profileQuery->setKvkNumber('18079951');

$kvkPaginator = $client->getProfile($profileQuery);

foreach ($kvkPaginator->getItems() as $company) {
    // {your code}
}

// get next set of data
$kvkPaginator = $client->getNextPage($kvkPaginator);
```
Search query
```php
use Werkspot\KvkApi\Http\Endpoint\Production;
use Werkspot\KvkApi\Http\Search\SearchQuery;
use Werkspot\KvkApi\KvkClientFactory;

$client = KvkClientFactory::create('<YOUR_API_KEY>', new Production());


$searchQuery = new SearchQuery();
$searchQuery->setStreet('ABEBE Bikilalaan');
$kvkPaginator = $client->fetchSearch($searchQuery);

// get next set of data
$kvkPaginator = $client->getNextPage($kvkPaginator);
```

Tests
-----

To run the tests you can use the make commands in the projects root.

```bash
$ make test-cs
$ make test-unit
$ make test-integration
```

You can also automatically fix the coding standards with:

```bash
$ make fix-cs
```

Author
-------

KVK API has been created by [LauLaman] and is currently maintained by the developers at [Werkspot].

[kvk-api-documentation]: https://developers.kvk.nl/documentation
[LauLaman]: https://github.com/LauLaman
[Werkspot]: https://www.werkspot.nl
[kvk-guide]: https://developers.kvk.nl/guides
