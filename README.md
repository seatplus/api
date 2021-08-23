# Package to consume seatplus data trough an api

[![Latest Version on Packagist](https://img.shields.io/packagist/v/seatplus/api.svg?style=flat-square)](https://packagist.org/packages/seatplus/api)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/seatplus/api/run-tests?label=tests)](https://github.com/seatplus/api/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/seatplus/api/Check%20&%20fix%20styling?label=code%20style)](https://github.com/seatplus/api/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/seatplus/api.svg?style=flat-square)](https://packagist.org/packages/seatplus/api)


## Installation



## Usage

There are several ways of passing the API token to your application. We'll discuss each of these approaches while using the Guzzle HTTP library to demonstrate their usage. You may choose any of these approaches based on the needs of your application.

### Query Strings

Your application's API consumers may specify their token as an `api_token` query string value:

```php
$response = $client->request('GET', '/api/user?api_token='.$token);
```

### Request Payload

Your application's API consumers may include their API token in the request's form parameters as an `api_token`:

```php
$response = $client->request('POST', '/api/user', [
    'headers' => [
        'Accept' => 'application/json',
    ],
    'form_params' => [
        'api_token' => $token,
    ],
]);
```

### Bearer Token

Your application's API consumers may provide their API token as a `Bearer` token in the `Authorization` header of the request:

```php
$response = $client->request('POST', '/api/user', [
    'headers' => [
        'Authorization' => 'Bearer '.$token,
        'Accept' => 'application/json',
    ],
]);
```

## Documentation

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/13012975-234f6f65-12e0-4d5b-ae35-a6e0d17ffc91?action=collection%2Ffork&collection-url=entityId%3D13012975-234f6f65-12e0-4d5b-ae35-a6e0d17ffc91%26entityType%3Dcollection%26workspaceId%3D99c4cf22-1a90-4315-91cf-3899990b05c7)

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Felix Huber](https://github.com/herpaderpaldent)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
