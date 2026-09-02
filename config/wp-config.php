<?php
define(
    'DB_NAME',
    getenv_docker('WORDPRESS_DB_NAME', 'wordpress')
);

define(
    'DB_USER',
    getenv_docker('WORDPRESS_DB_USER', 'example username')
);

define(
    'DB_PASSWORD',
    getenv_docker('WORDPRESS_DB_PASSWORD', 'example password')
);

define(
    'DB_HOST',
    getenv_docker('WORDPRESS_DB_HOST', 'mysql')
);

define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');
define('AUTH_KEY',         'put-your-unique-phrase-here');
define('SECURE_AUTH_KEY',  'put-your-unique-phrase-here');
define('LOGGED_IN_KEY',    'put-your-unique-phrase-here');
define('NONCE_KEY',        'put-your-unique-phrase-here');
define('AUTH_SALT',        'put-your-unique-phrase-here');
define('SECURE_AUTH_SALT', 'put-your-unique-phrase-here');
define('LOGGED_IN_SALT',   'put-your-unique-phrase-here');
define('NONCE_SALT',       'put-your-unique-phrase-here');

$table_prefix = 'wp_';

define(
    'WP_DEBUG',
    filter_var(getenv_docker('WORDPRESS_DEBUG', ''), FILTER_VALIDATE_BOOLEAN)
);

define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);
if (
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false
) {
    $_SERVER['HTTPS'] = 'on';
}
define('DISABLE_WP_CRON', false);
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}
function getenv_docker($env, $default)
{
    if ($fileEnv = getenv($env . '_FILE')) {
        return rtrim(file_get_contents($fileEnv), "\r\n");
    }

    if (($val = getenv($env)) !== false) {
        return $val;
    }
    return $default;
}
require_once ABSPATH . 'wp-settings.php';