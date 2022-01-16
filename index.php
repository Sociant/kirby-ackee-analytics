<?php
@include_once __DIR__.'/vendor/autoload.php';

use Kirby\Cms\App;


App::plugin('sociant/ackee-analytics', [
    'options' => [
        'ackee-analytics-url' => '',
        'enable-tracking' => false,
        'domain-id' => '',
        'detailed' => false,
        'ignore-localhost' => true,
        'ignore-own-visits' => true,
        'tracker-file-name' => 'tracker.js',
    ],
    'pageMethods' => [
        'ackeeHeader' => function($options = []) {
            return ackeeInstance($this)->renderHeader($options);
        }
    ]
]);