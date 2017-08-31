<?php

Config::set('site_name', 'My MVC Framework');
// Route name => Action prefix
Config::set('routes', [
    'default' => '',
    'admin' => 'admin_'
]);

Config::set('default_route', 'default');
Config::set('default_controller', 'pages');
Config::set('default_action', 'index');

Config::set('languages', ['en', 'fr', 'es']);
Config::set('default_language', 'en');

Config::set('db_host', 'localhost');
Config::set('db_name', 'mvc');
Config::set('db_user', 'root');
Config::set('db_pass', '');

Config::set('salt', 'dhfkdshfkhdsfkds43545');

Config::set('smtp_server', 'smtp.example.com');
Config::set('tls_port', '***');
Config::set('email_auth', 'user@example.com');
Config::set('email_pass', 'password');
Config::set('email_from_name', 'Admin');
Config::set('email_from', 'admin@mvc.com');

Config::set('ITEMS_PER_PAGE', 3);

Config::set('assets', [
    'public_dir' => DS.'webroot',
    'autoload' => [
        'style.css',
        'jquery.min.js',
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css',
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'
    ]
]);
