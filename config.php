<?php
// Admin yapılandırma dosyası
define('ADMIN_SESSION_KEY', 'admin_logged_in');
define('ADMIN_USERNAME_KEY', 'admin_username');
define('ADMIN_ID_KEY', 'admin_id');
define('ADMIN_TOKEN_KEY', 'admin_token');
define('ADMIN_TIMEOUT', 3600); // 1 saat

// Admin yetkileri
define('ADMIN_PERMISSION_MOVIES', 1);
define('ADMIN_PERMISSION_USERS', 2);
define('ADMIN_PERMISSION_SETTINGS', 4);
define('ADMIN_PERMISSION_ALL', 7);

// Admin rolleri
$ADMIN_ROLES = [
    'super_admin' => ADMIN_PERMISSION_ALL,
    'content_manager' => ADMIN_PERMISSION_MOVIES,
    'user_manager' => ADMIN_PERMISSION_USERS
];

// Admin sayfaları ve gereken yetkiler
$ADMIN_PAGES = [
    'index.php' => ADMIN_PERMISSION_ALL,
    'users.php' => ADMIN_PERMISSION_USERS,
    'movies.php' => ADMIN_PERMISSION_MOVIES,
    'settings.php' => ADMIN_PERMISSION_SETTINGS
];
