<?php
    require_once "config.php";
    $code = 200;

    try {
        $connection = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8", USERNAME, PASSWD);

        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }
    catch(PDOException $ex){
        echo $ex->getMessage();
    }

    function sql_select_all($query){
        global $connection;

        $result = $connection->query($query)->fetchAll();
        return $result;
    }

    function sql_delete($selected_id, $selected_table){
        global $connection;

        $ps = $connection->prepare("DELETE FROM $selected_table WHERE id = :id");
        $ps->bindParam(':id', $selected_id);
        $result = $ps->execute();
        return $result;
    }


