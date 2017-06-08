<?
namespace Core;

class Request{

    static function route()
    {
        // контроллер и действие по умолчанию
        $controller_name = 'Admin';
        $action_name = 'index';

        $vars = [];

        $url = parse_url($_SERVER['REQUEST_URI']);
        $routes = explode('/', trim($url['path'], '/'));

        // получаем имя контроллера
        if ( !empty($routes[0]) )
        {
            $controller_name = $routes[0];
        }

        // получаем имя экшена
        if ( !empty($routes[1]) )
        {
            $action_name = $routes[1];
        }

        //получаем значение переменных
        if(count($routes) > 2){
            $vars = array_slice($routes, 2);
        }

        // подцепляем файл с классом контроллера
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "application/controllers/".$controller_file;
        if(file_exists($controller_path))
        {
            include "application/controllers/".$controller_file;
        }
        else
        {

            include "application/controllers/Admin.php";
        }
        // создаем контроллер
        $controller = new $controller_name;

        if(method_exists($controller, $action_name))
        {
            // вызываем действие контроллера
//				$controller->$action();
            call_user_func(array($controller, $action_name), $vars);
        }
        else
        {
            $controller->index();
        }

    }
}

