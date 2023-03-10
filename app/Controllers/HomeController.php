<?php 
namespace App\Controllers;

use App\Core\Controller;
use App\Models\MemcachedModel;
use App\Core\Router;

class HomeController extends Controller{

	private $user_model;
	private $m; // memcached

    public function __construct()
    {
        $this->m = new MemcachedModel();
        $this->m = $this->m->m;

        parent::__construct();
    }

    public function index()
    {
    	$encoded_link = "";

    	// get the destination link and redirect
    	if (isset($_GET['c'])){
    		$link = Router::getUrl()."?c={$_GET['c']}";

    		if ($target = $this->m->get($link)){
    			header("Location: $target");
    		}
    	}

    	// make encoded link from given input
		if ($_POST){
			$this->csrf_check();

			$orig_link = trim(htmlspecialchars($_POST['link']));
			$orig_link = "https://".preg_replace('/^https?:\/\/(www\.)?/', '', $orig_link);

			// make sure the generated code is unique
			do {
				$encoded_link = Router::getUrl()."?c={$this->generateRandomString(5)}";
			} while (!$this->m->add($encoded_link, $orig_link, 30*24*3600));
		}

		$this->data->title = _("URL Shortener");
        $this->data->link = $encoded_link;
		$this->view->render('index', $this->data);
	}

	public function generateRandomString($length = 5) {
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$charactersLength = strlen($characters);
    	$randomString = '';
	 
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[random_int(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}