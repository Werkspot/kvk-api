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

Usage
-----

```php
use GuzzleHttp\Client;
use Werkspot\KvkApi\Client\Adapter\Guzzle;
use Werkspot\KvkApi\Client\Authentication;
use Werkspot\KvkApi\Client\Endpoint;
use Werkspot\KvkApi\Client\Search\ProfileQuery;
use Werkspot\KvkApi\ClientFactory;

$adapter = new Guzzle(
    new Client(),
    new Authentication\HttpBasic('<USERNAME>', '<PASSWORD>'),
    new Endpoint\Production()
);

$client = ClientFactory::getClient($adapter);

$profileQuery = new ProfileQuery();
$profileQuery->setKvkNumber(18079951);

$profileResponse = $client->getProfile($profileQuery);
```

Credits
-------

KVK API has been developed by [LauLaman][LauLaman].

[kvk-api-documentation]: https://developers.kvk.nl/documentation
[LauLaman]: https://github.com/LauLaman
