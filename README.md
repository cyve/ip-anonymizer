# php-ip-anonymizer

## Installation
```bash
$ composer require cyve/php-ip-anonymizer
```

## Usage
```php
$anonymizer = new \Cyve\IpAnonymizer\IpAnonymizer();
$address = $anonymizer->anonymize('127.0.0.1'); // 127.0.0.x
```
