yii2-cspreport
==============

yii2 Module for Content Security Policy Report

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
    'urlManager' => [
        'rules' => [
            'csp-report' => 'csp-report/report/index',
        ],
    ],
```

* Add header for nginx server config
```
   add_header Content-Security-Policy-Report-Only "default-src https:; script-src https: 'unsafe-eval' 'unsafe-inline'; style-src https: 'unsafe-inline'; img-src https: data:; font-src https: data:; report-uri /csp-report";
```
