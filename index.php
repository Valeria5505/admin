<?

require_once ($_SERVER['DOCUMNET_ROOT'].'/core/Application.php');
require_once ($_SERVER['DOCUMNET_ROOT'].'/core/Controller.php');
require_once ($_SERVER['DOCUMNET_ROOT'].'/core/DB.php');
require_once ($_SERVER['DOCUMNET_ROOT'].'/core/interface/iTemplate.php');
require_once ($_SERVER['DOCUMNET_ROOT'].'/core/FTemplate.php');
require_once ($_SERVER['DOCUMNET_ROOT'].'/core/Model.php');
require_once ($_SERVER['DOCUMNET_ROOT'].'/core/Request.php');
require_once ($_SERVER['DOCUMNET_ROOT'].'/application/models/User.php');
require_once ($_SERVER['DOCUMNET_ROOT'].'/application/models/Project.php');
require_once ($_SERVER['DOCUMNET_ROOT'].'/application/models/Curator.php');
require_once ($_SERVER['DOCUMNET_ROOT'].'/application/models/Constants.php');
require_once ($_SERVER['DOCUMNET_ROOT'].'/application/models/Release.php');

try{
	
	$app = \Core\Application::getInstance();
	$app->run();
	
}catch(\Exception $e){
	$e->getMessage();
}