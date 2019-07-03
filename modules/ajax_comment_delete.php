<?php
    if(isset($_POST["flag"])) {
        $id_comment = $_POST["idComment"];
        $id_user = $_POST["idUser"];

        try {
            require_once "connection.php";
            $ps = $connection->prepare("DELETE FROM komentar WHERE id = :id AND korisnik_id = :user_id");
            $ps->bindParam(':id', $id_comment);
            $ps->bindParam(':user_id', $id_user);
            $result = $ps->execute();

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
    else {
        $code = 404;
    }
    http_response_code($code);