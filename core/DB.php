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
        $this->pdo = new \PDO('mysql:host=localhost;dbname=host-test;charset=UTF8;', 'root', '');
	}

	private function __clone()
	{
	}

	private function __wakeup()
	{
	}

}