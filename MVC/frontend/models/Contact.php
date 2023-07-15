<?php


require_once 'models/Model.php';
class Contact extends  Model
{
    public function getAll()
    {
        $sql_select_all = "SELECT * FROM maps";
        $obj_select_all =
            $this->connection->prepare($sql_select_all);
        $obj_select_all->execute();
        $contacts = $obj_select_all
            ->fetchAll(PDO::FETCH_ASSOC);
        return $contacts;
    }
}
