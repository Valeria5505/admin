<?

namespace Core;

class DB
{
    protected $pdo;

    protected static $_instance;

	public static function getInstance()
	{
		if (self::$_instance === null)
		{
			self::$_instance = new self();
		}
		return self::$_instance->pdo;
	}

	private  function __construct()
	{
        $dbconfig = require('../../db_params.php');
        $this->pdo = new \PDO('mysql:host=$dbconfig["host"];dbname=$dbconfig["db"];charset=UTF8;', '$dbconfig["root"]', '$dbconfig["password"]');
        //$this->pdo = new \PDO('mysql:host=localhost;dbname=host-test;charset=UTF8;', 'root', '');
        //$this->pdo = new \PDO('mysql:host=localhost;dbname=web_38;charset=UTF8;', 'web_38', 'sIJj758vvx6SgZXB');
	}

	private function __clone()
	{
	}

	private function __wakeup()
	{
	}

}