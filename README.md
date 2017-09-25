# Sphinx config (.conf) generator in PHP
Didn't like existing solutions, decided to create my own.
Sharing is caring.

Installation
--------------------------

The preferred way to install this extension is through http://getcomposer.org/download/.

Either run

```sh
php composer.phar require ruskid/sphinx-config-generator-php "dev-master"
```

or add

```json
"ruskid/sphinx-config-generator-php": "dev-master"
```

to the require section of your `composer.json` file.


Usage
--------------------------
```php
$handler = new ConfigGenerator([
    'filepath' => __DIR__ . '/sphinx-generated.conf'
]);

//Add Index config
$handler->addConfig(new Config([
    'name' => 'indexer',
    'attributes' => [
        ...
        'mem_limit' => '32M'
        ...
    ]
]));

//Add search daemon config
$handler->addConfig(new Config([
    'name' => 'searchd',
    'attributes' => [
        ...
        'listen' => '9306:mysql41',
        'log' => '/var/log/searchd.log',
        ...
    ]
]));

//Add sources
$handler->addSource(new Source([
    'name' => 'base',
    'attributes' => [
        'type' => 'mysql',
        'sql_host' => 'host',
        'sql_user' => 'username',
        'sql_pass' => 'password',
        'sql_db' => 'database',
        'sql_port' => '3306',
        'sql_query_pre' => [
            'SET CHARACTER_SET_RESULTS=utf8',
            'SET NAMES utf8'
        ],
    ]
]));

$handler->addSource(new Source([
    'name' => 'extending_source',
    'extends' => 'base',
    'attributes' => [
        'sql_field_string' => [
            'label',
        ],
        'sql_attr_string' => ['label_url'],
        'sql_attr_float' => ['latitude', 'longitude'],
        'sql_attr_uint' => ['province_id', 'population']
    ]
]));

//Add indexes
$handler->addIndex(new Index([
    'name' => "extending_source_index",
    'attributes' => [
        ...
        'source' => 'extending_source'
        'path' => "/var/data/extending_source_index",
        ...
    ]
]));


$handler->getContents(); // get contents to be saved to .conf
$handler->saveConfig(); //save config file to filepath

```

Be aware
--------------------------
Maintain order of sources extending base sources...