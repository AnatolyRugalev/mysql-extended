Yii Mysql Extended Schema
====================================

Simple usage:

in db config:
```php
    'db' => array(
        'connectionString' => 'mysql:etc',
        'driverMap' => array(
            'mysql' => 'ext.MysqlExtended.CMysqlExtendedSchema',
        ),
    )
```