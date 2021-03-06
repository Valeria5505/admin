<?
namespace Core;

abstract class Model
{

    public $tableName;

    public function getList()
    {
        $data = DB::getInstance()->query("SELECT * FROM " . $this->tableName)->fetchAll();
        return $data;
    }

    function getById($id)
    {

        $stmt = DB::getInstance()->prepare("SELECT * FROM " . $this->tableName. " WHERE id =".$id);

        $stmt->execute();
        $data = $stmt->fetch();

        return $data;
    }

    function delete($id)
    {
        $stmt = DB::getInstance()->prepare("DELETE FROM " . $this->tableName. " WHERE id =:id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        var_dump($stmt);
        if ($stmt){
            $update = DB::getInstance()->prepare("UPDATE project SET " . $this->tableName . " = NULL WHERE " . $this->tableName . " = :id");
            $update->bindValue(':id', $id);
            $update->execute();
        }
        return $stmt;
    }

    function count(){
        $stmt = DB::getInstance()->prepare("SELECT COUNT(*) FROM " . $this->tableName);
        $stmt->execute();
        $data = $stmt->fetch();
        return $data;
    }

}
