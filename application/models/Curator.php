<?
namespace Application\Models;

use Core\DB;
use Core;

class Curator extends Core\Model{

    public $tableName = "curator";
    function update($id, $name, $status, $email)
    {
        $update = DB::getInstance()->prepare("UPDATE " . $this->tableName . " SET name_curator = '".$name."', `status` = '".$status."', email_curator = '".$email."' WHERE id =".$id);
        $update->execute();
        $stmt = DB::getInstance()->query("SELECT * FROM " . $this->tableName);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }
    function add($name, $status, $email)
    {
        $add = DB::getInstance()->prepare("INSERT INTO " . $this->tableName . " (name_curator, status, email_curator) values('".$name."', '".$status."', '".$email."')");
        $add->execute();
        $stmt = DB::getInstance()->query("SELECT * FROM " . $this->tableName);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }
    function delete($id)
    {
        $update = DB::getInstance()->prepare("UPDATE " . $this->tableName . " SET `status` = '0' WHERE id =".$id);
        $update->execute();
        $stmt = DB::getInstance()->query("SELECT * FROM " . $this->tableName . " WHERE id =".$id);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }
}
