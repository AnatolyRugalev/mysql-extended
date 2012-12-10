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