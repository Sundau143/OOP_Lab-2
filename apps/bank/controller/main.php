<?php
/**
 * User Controller
 *
 * @author Serhii Shkrabak
 * @global object $CORE
 * @package Controller\Main
 */
namespace Controller;
class Main
{
	use \Library\Shared;

	private $model;

	public function exec():?array {

		include 'model/config/patterns.php';
		$result = null;
		$url = $this->getVar('REQUEST_URI', 'e');
		$path = explode('/', $url);

		if (isset($path[2]) && !strpos($path[1], '.')) { // Disallow directory changing
			$file = ROOT . 'model/config/methods/' . $path[1] . '.php';
			if (file_exists($file)) {
				include $file;
				if (isset($methods[$path[2]])) {
					$details = $methods[$path[2]];
					$request = [];
					$var_exists = false;
					foreach ($details['params'] as $param) {
						$var = $this->getVar($param['name'], $param['source']);
						if ($var) {
							if(isset($param['pattern'])) {
								if (preg_match($patterns[$param['pattern']]['regex'], $var)) {
									if(isset($patterns[$param['pattern']]['callback'])) 
										$var = preg_replace_callback($patterns[$param['pattern']]['regex'], $patterns[$param['pattern']]['callback'], $var);
								$var_exists = true;
								$request[$param['name']] = $var; 
							} else {
								$var_exists = false;
								throw new \Exception('REQUEST_INCORRECT', 2);
								break; } }
						} else if (!($var) && ($param['obligatory']) == 'true'){
							$var_exists = false;
							throw new \Exception('REQUEST_INCOMPLETE', 1);
							break;
						}
					}
				
					if (method_exists($this->model, $path[1] . $path[2]) && $var_exists) {
						$method = [$this->model, $path[1] . $path[2]];
						$result = $method($request);
					}
				}
			}
		}

		return $result;
	}

	public function __construct() {
		// CORS configuration
		$origin = $this -> getVar('HTTP_ORIGIN', 'e');
		$front = $this -> getVar('FRONT', 'e');
		foreach ( [$front] as $allowed ) 
			if ( $origin == "https://$allowed") {
				header( "Access-Control-Allow-Origin: $origin" );
				header( 'Access-Control-Allow-Credentials: true' );
			}
		$this->model = new \Model\Main;
	}
}