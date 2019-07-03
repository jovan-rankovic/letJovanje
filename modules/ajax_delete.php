<?php
    if(isset($_POST["flag"])) {
        $id = $_POST["id"];
        $table = $_POST["table"];

        try {
            require_once "connection.php";
            $result = sql_delete($id, $table);

            if ($result) {
                $code = 204;
            } else {
                $code = 500;
            }
        }
        catch (PDOException $ex) {
            echo $ex->getMessage();
            $code = 500;
        }
    }
    else{
        $code = 404;
    }
    http_response_code($code);