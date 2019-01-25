<?php

(new Dotenv\Dotenv(__DIR__))->load();

return [
    'paths' => [
        'migrations' => getenv('PHINX_CONFIG_DIR') . '/db/migrations',
        'seeds' => getenv('PHINX_CONFIG_DIR') . '/db/seeds',
    ],
    'environments' => [
        'default_migration_table' => 'ut_migrations',
        'default_database' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => getenv('DATABASE_HOST'),
            'name' => getenv('DATABASE_NAME'),
            'user' => getenv('DATABASE_USER'),
            'pass' => getenv('DATABASE_PASS'),
            'port' => 3306,
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => getenv('DATABASE_HOST'),
            'name' => getenv('DATABASE_NAME'),
            'user' => getenv('DATABASE_USER'),
            'pass' => getenv('DATABASE_PASS'),
            'port' => 3306,
            'charset' => 'utf8',
        ],
    ],
    'version_order' => 'creation',
];