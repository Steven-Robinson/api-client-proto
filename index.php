<?php

require 'vendor/autoload.php';

// create a new App object, effectively bootstrapping the application
$app = new Client\App(__DIR__);

// call objects from the container like this...
$app['app.logger']->log('Application bootstrap complete...');

// ...or fire events manually which are being listened to by something else
// in this case the logger is triggered
$app['event.manager']->fire('app.bootstrap.complete');

// but preferably don't call anything from here, just do the wiring and get other things to fire and listen for events
