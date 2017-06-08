<?
namespace Application\Models;

use Core\DB;
use Core;

class Release extends Core\Model{

    public $tableName = "release";
    public function getList()
    {
        $stmt = DB::getInstance()->query("SELECT * FROM `" . $this->tableName . "`");
        return $stmt;
    }
    public function getListRelease()
    {
        $stmt = DB::getInstance()->query("SELECT * FROM `" . $this->tableName . "` INNER JOIN project on `" . $this->tableName . "`.project=project.id");
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getListByUser($id)
    {
        $stmt = DB::getInstance()->query("SELECT * FROM `" . $this->tableName . "` INNER JOIN project ON `" . $this->tableName . "`.project=project.id WHERE project=".$id);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }
    public function dateReleaseList($date)
    {
        $pieces = explode(".", $date);
        $dateNew = $pieces[2]."-".$pieces[1]."-".$pieces[0];
        $stmt = DB::getInstance()->query("SELECT DISTINCT `" . $this->tableName . "`.*, project.subdomain FROM `" . $this->tableName . "` INNER JOIN project ON `" . $this->tableName . "`.project=project.id WHERE CAST(date_time AS DATE) ='".$dateNew."'");
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }
}
