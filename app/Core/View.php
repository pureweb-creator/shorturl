<?php

namespace App\Core;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * View
 */
class View
{
    protected Logger $logger;

    public function __construct(){
        $this->logger = new Logger('view');
        $this->logger->pushHandler(new StreamHandler('debug.log'));
    }

    public function render($page, $data): void
    {
		include "static/view/$page.php";
	}
}