<?php

namespace App\Core;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Model
 */
abstract class Model
{
    public $m;
    protected Logger $logger;

	public function __construct()
	{
        $this->logger = new Logger('model');
        $this->logger->pushHandler(new StreamHandler('debug.log'));

        // Memcached connect
        $this->m = new \Memcached();
        $this->m->addServer("localhost", 11211);
	}
}