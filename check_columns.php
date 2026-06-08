<?php

use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

try {
    $cols = DB::select('SHOW COLUMNS FROM savings_transactions');
    foreach ($cols as $c) {
        echo $c->Field.' ('.$c->Type.')'.PHP_EOL;
    }
} catch (Exception $e) {
    echo 'Error: '.$e->getMessage().PHP_EOL;
}
