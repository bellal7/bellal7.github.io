<?php
/*******************************************************************************
 * /application/libs/application.class.php
*******************************************************************************/

namespace application\libs;
class Application{
	public $controller;
	public $action;
	public function __construct(){
		$getUrl = '';
		if (isset($_GET['url'])) {
			$getUrl = rtrim($_GET['url'], '/');
			$getUrl = filter_var($getUrl, FILTER_SANITIZE_URL);
		}
		$getParams = explode('/', $getUrl);

		//해당 인자가 없을 수 있으므로 그에 대한 처리
		$params['mode']     = isset($getParams[0]) && $getParams[0] != '' ? $getParams[0] : 'front';
		$params['menu']     = isset($getParams[1]) && $getParams[1] != '' ? $getParams[1] : 'Main';
		$params['action']   = isset($getParams[2]) && $getParams[2] != '' ? $getParams[2] : 'Index';
		$params['category'] = isset($getParams[3]) && $getParams[3] != '' ? $getParams[3] : null;
		$params['idx']      = isset($getParams[4]) && $getParams[4] != '' ? $getParams[4] : 0;
		$params['page']  		= isset($getParams[5]) && $getParams[5] != '' ? $getParams[5] : 0;

		//컨트롤러 유무 확인
		if (!file_exists('application/controllers/'.$params['mode'].'/'.$params['menu'].'Controller.class.php')) {
			echo "application : 해당 컨트롤러 없음 => ";
			echo 'application/controllers/'.$params['mode'].'/'.$params['menu'].'Controller.class.php';
			exit();
		}

		$controllerName = '\application\controllers\\'.$params['mode'].'\\'.$params['menu'].'Controller';
		new $controllerName($params['mode'], $params['menu'], $params['action'], $params['category'], $params['idx'], $params['page']);
	}//End function. __construct

}//End class. Application
?>