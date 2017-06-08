<?
namespace Application\Models;

use Core\DB;
use Core;

class Project extends Core\Model{

    public $tableName = "project";

    public function getList()
    {
        $data = DB::getInstance()->query("SELECT distinct " . $this->tableName.".*, user.email_user, curator.name_curator
                                                    FROM " . $this->tableName. "
                                                    INNER JOIN user on " . $this->tableName.".user=user.id
                                                    LEFT JOIN curator ON " . $this->tableName.".curator=curator.id 
                                                    group by " . $this->tableName.".id");

        return $data;
    }
    public function getListByUser($id)
    {
        $stmt = DB::getInstance()->query("
        SELECT distinct " . $this->tableName.".*, user.email_user, curator.name_curator
        FROM " . $this->tableName . " 
        INNER JOIN user on " . $this->tableName . ".user=user.id
        LEFT JOIN curator on " . $this->tableName . ".curator=curator.id
        WHERE user =".$id);

        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }
    function countProjecrCurator($id){
        $stmt = DB::getInstance()->prepare("SELECT COUNT(*) FROM " . $this->tableName . "WHERE curator =" .$id);
        $stmt->execute();
        $data = $stmt->fetch();
        return $data;
    }
    function delete($id)
    {
        $update = DB::getInstance()->prepare("UPDATE " . $this->tableName . " SET `status_project` = '3' WHERE id =".$id);
        $update->execute();
        $stmt = DB::getInstance()->query("SELECT * FROM " . $this->tableName . " WHERE id =".$id);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }
}
