# Simple AWS Manager

A simple CakePHP 3 plugin for manage AWS resources. 
Currently this can only list and restart EC2 instances.

## Requirement

* PHP 7.0 or higher
* CakePHP 3.4 or higher

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require Guenbakku/Sam
```

## Configure:

### Load plugin
Add following into bottom of your `bootstrap.php`:

```php
Plugin::load('Guenbakku/Sam', ['bootstrap' => true, 'routes' => true]);
```

### Configure AWS credentials

Create file `sam.php` in your directory `config` with following content:

```php
<?php
return [
    'Guenbakku/Sam' => [
        'credentials' => [
            'default' => [
                'key' => 'xxxxxx',
                'secret' => 'xxxxxx',
            ],
            'uses' => 'default',
        ]
    ],
];
```

### Note:

* You can override plugin's config content by simply write same key into your `config/sam.php`.
* Please set right policy for credentials which you attend to use with this plugin. 

**Sample for AWS Policy:**

```json
{
    "Version": "2012-10-17",
    "Statement": [
        {
            "Effect": "Allow",
            "Action": [
                "ec2:DescribeInstances"
            ],
            "Resource": "*"
        },
        {
            "Effect": "Allow",
            "Action": [
                "ec2:RebootInstances"
            ],
            "Condition": {
                "StringEquals": {
                    "ec2:ResourceTag/User": "me"
                }
            },
            "Resource": "*"
        }
    ]
}
```