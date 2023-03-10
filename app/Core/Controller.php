<?php

namespace App\Core;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Controller
 */
abstract class Controller
{
    protected ?Logger $logger;
	protected ?View $view;
	protected object $data;
	protected string $domain = "messages";

	public function __construct()
	{
        // Set logging
        $this->logger = new Logger('controller');
        $this->logger->pushHandler(new StreamHandler('debug.log'));

        // Prepare the data view
		$this->data = (object) array(
			'home_url' => Router::getUrl()
		);

		$this->view = new View();
	}

	protected function csrf_check(): void
    {
		if (!isset($_POST['csrf'])) die("No CSRF token provided");
		if ($_POST['csrf'] != $_SESSION['csrf_token']) header("Location: ".Router::getUrl());

		unset($_SESSION['csrf_token']);
		$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
	}
}