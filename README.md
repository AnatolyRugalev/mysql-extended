Yii Mysql Extended Schema
====================================

Simple usage
=================
Put files into protected/extensions/MysqlExtended/

Add to db config:
```php
    'db' => array(
        'connectionString' => 'mysql:etc',
        'driverMap' => array(
            'mysql' => 'ext.MysqlExtended.CMysqlExtendedSchema',
        ),
    )
```

Basic functionality
================

1. Get engine of table:
```php
$model->getTableSchema()->engine;
```
This call returns string with engine name e.g. "InnoDB" or "MyISAM"