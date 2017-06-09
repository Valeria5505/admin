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
        $dbconfig = require('db_params.php');

        $userPDO = $dbconfig["user"];
        $passwordPDO = $dbconfig["password"];
        $hostPDO = $dbconfig["host"];
        $dbnamePDO = $dbconfig["db"];
        $mysqlPDO = "mysql:host=$hostPDO;dbname=$dbnamePDO;charset=UTF8";
        $this->pdo = new \PDO($mysqlPDO, $userPDO, $passwordPDO);
	}

	private function __clone()
	{
	}

	private function __wakeup()
	{
	}

}