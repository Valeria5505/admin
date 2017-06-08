<?
namespace Application\Models;

use Core\DB;
use Core;

class User extends Core\Model{

    public $tableName = "user";

    public function getListUser()
        {
            $stmt = DB::getInstance()->query("SELECT * FROM " . $this->tableName . " WHERE status_user != 1");

            return $stmt;
        }
    function update($id, $email, $status)
    {
        $update = DB::getInstance()->prepare("UPDATE " . $this->tableName . " SET email_user = '".$email."', status_user = '".$status."' WHERE id =".$id);
        $update->execute();
        $stmt = DB::getInstance()->query("SELECT * FROM " . $this->tableName);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

}
