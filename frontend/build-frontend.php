<?php
declare(strict_types=1);

$build = isset($argv[1]) && '--build' === $argv[1];

if (true === $build) {
    echo 'Will build frontend.' . PHP_EOL;
    exec('npm run build');
}
if (false === $build) {
    echo 'Will build not frontend. Use --build.' . PHP_EOL;
}

echo 'Cleanup index.twig.' . PHP_EOL;
// replace some stuff on index.twig
$file    = '../resources/views/v2/index.twig';
$content = file_get_contents($file);
$config  = [
    'indent' => true,
    'wrap'   => '1000',
];

$tidy = new tidy();
$tidy->parseString($content, $config, 'utf8');
$tidy->cleanRepair();
$result = tidy_get_output($tidy);

// do some str_replaces
$values = [
    'link href'  => 'link nonce="{{ JS_NONCE }}" href',
    'script src' => 'script nonce="{{ JS_NONCE }}" src',
];

$result = str_replace(array_keys($values), array_values($values), $result);
file_put_contents($file, $result);

echo 'Done!' . PHP_EOL;
