<?php

namespace Client;

use Monolog\Handler\StreamHandler as MonologStreamHandler;
use Monolog\Logger as MonologLogger;
use Pimple\Container;

class App extends Container
{
    const LOG_FILE_LOCATION = '/logs/app.log';

    private $appRoot;

    public function __construct(string $appRoot)
    {
        $this->appRoot = $appRoot;

        $this->setupAppConfig();
        $this->setupAppObjects();
    }

    private function setupAppConfig()
    {
        $this['log-location'] = $this->appRoot . self::LOG_FILE_LOCATION;
    }

    private function setupAppObjects()
    {
        $this['app.logger'] = function ($c) {
            $monolog = new MonologLogger('API client logger');
            $monolog->pushhandler(new MonologStreamHandler($c['log-location'], MonologLogger::INFO));

            return new Logger($monolog);
        };
    }
}
