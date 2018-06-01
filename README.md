yii2-cspreport
==============

yii2 Module for [Content Security Policy Report](http://content-security-policy.com/)

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

* Either run

```
php composer.phar require --prefer-dist "assayer-pro/yii2-cspreport" "*"
```

or add

```json
"assayer-pro/yii2-cspreport" : "*"
```

to the `require` section of your application's `composer.json` file.

Usage
-----

* Add a new module in modules section of your application's configuration file, for example:

```php
    'modules' => [
        'csp-report' => [
            'class' => 'assayerpro\cspreport\Module',
            'message' => [
                'from' => 'admin@example.com',
                'to' => 'developer@example.com',
                'subject' => 'Content Security Policy Report',
            ],
        ],
    ],
```

* Add a new rule for `urlManager` of your application's configuration file, for example:

```php
    'components' => [
    ...
        'urlManager' => [
            'rules' => [
                'csp-report' => 'csp-report/report/index',
            ],
        ],
    ...
    ],
```

* Add application/json parser:

```php
    'components' => [
    ...
        'request' => [
            'parsers' => [
                'application/csp-report' => 'yii\web\JsonParser',
            ],
        ],
    ...
    ],
```

* Apache Content-Security-Policy Header

Add the following to your httpd.conf in your VirtualHost or in an .htaccess file:

```
Header set Content-Security-Policy-Report-Only "default-src https:; script-src https: 'unsafe-eval' 'unsafe-inline'; style-src https: 'unsafe-inline'; img-src https: data:; font-src https: data:; report-uri /csp-report;"
```

* Nginx Content-Security-Policy Header

In your server {} block add:

```
   add_header Content-Security-Policy-Report-Only "default-src https:; script-src https: 'unsafe-eval' 'unsafe-inline'; style-src https: 'unsafe-inline'; img-src https: data:; font-src https: data:; report-uri /csp-report";
```

You can also append always to the end to ensure that nginx sends the header reguardless of response code.

