<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
try {
    $view = $app->make('view');
    $rendered = $view->make('pengurus.lapharian.index', ['tanggal' => new DateTime()])->render();
    echo "VIEW RENDERED OK";
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage();
}
