<?

require_once ('core/Application.php');
require_once ('core/Controller.php');
require_once ('core/DB.php');
require_once ('core/interface/iTemplate.php');
require_once ('core/FTemplate.php');
require_once ('core/Model.php');
require_once ('core/Request.php');
require_once ('application/models/User.php');
require_once ('application/models/Project.php');
require_once ('application/models/Curator.php');
require_once ('application/models/Release.php');
require_once ('application/models/Database.php');

try{
	
	$app = Core\Application::getInstance();
	$app->run();
	
}catch(\Exception $e){
	$e->getMessage();
}