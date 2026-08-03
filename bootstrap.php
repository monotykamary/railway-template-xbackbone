<?php
$root = '/app/www/public';
$configPath = '/config/www/xbackbone/config.php';
if (is_file($configPath)) {
    exit(0);
}
foreach (['XBACKBONE_URL', 'XBACKBONE_ADMIN_EMAIL', 'XBACKBONE_ADMIN_USER', 'XBACKBONE_ADMIN_PASSWORD'] as $key) {
    if (!getenv($key)) {
        fwrite(STDERR, "$key is required\n");
        exit(1);
    }
}
require $root.'/vendor/autoload.php';
$dbPath = '/config/www/xbackbone/resources/database/xbackbone.db';
$storagePath = '/config/www/xbackbone/storage';
@mkdir(dirname($dbPath), 0770, true);
@mkdir($storagePath, 0770, true);
$db = new App\Database\DB('sqlite:'.$dbPath);
$migrator = new App\Database\Migrator($db, $root.'/resources/schemas');
$migrator->migrate();
$users = App\Database\Repositories\UserRepository::make($db);
$users->create(getenv('XBACKBONE_ADMIN_EMAIL'), getenv('XBACKBONE_ADMIN_USER'), getenv('XBACKBONE_ADMIN_PASSWORD'), 1, 1);
$config = [
    'base_url' => rtrim(getenv('XBACKBONE_URL'), '/'),
    'db' => ['connection' => 'sqlite', 'dsn' => $dbPath, 'username' => null, 'password' => null],
    'storage' => ['driver' => 'local', 'path' => $storagePath],
];
if (file_put_contents($configPath, "<?php\nreturn ".var_export($config, true).";\n") === false) {
    throw new RuntimeException('Unable to write XBackBone config');
}
