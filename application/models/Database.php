<?
namespace Application\Models;

use Core\DB;
use Core;

class Database extends Core\Model{

    public $tableName = "`database`";


    function sizeDatabase()
    {
        $size = DB::getInstance()->prepare("SELECT SUM(size) FROM " . $this->tableName);

        $size->execute();

        $data = $size->fetchAll();
        return $data;
    }
}
