<?php
    if(isset($_POST["btn"])){
        $answer = $_POST["answer"];
        $ip = $_SERVER["REMOTE_ADDR"];

        if(empty($answer)) {
            $code = 406;
        }
        else {
            require_once "connection.php";

            $query_votes = "UPDATE anketa_odgovor SET br_glasova = br_glasova+1 WHERE id = :id_odgovor";
            $ps1 = $connection->prepare($query_votes);
            $ps1->bindParam(":id_odgovor",$answer);

            $query_ip = "INSERT INTO anketa_glas VALUES ('', :id, :ip)";
            $ps2 = $connection->prepare($query_ip);
            $ps2->bindParam(":id",$answer);
            $ps2->bindParam(":ip",$ip);

            try{
                $ps1->execute();
                $ps2->execute();
                $code = 201;
            }
            catch (PDOException $ex){
                $code = 500;
            }
        }
    }
    else{
        header("Location: index.php");
    }
    http_response_code($code);