<?php
    if(isset($_GET['a'])) {
        require_once "connection.php";
        $token = $_GET['a'];
        $upit = "UPDATE korisnik SET aktivan = 1 WHERE token = :token";
        $ps = $connection->prepare($upit);
        $ps->bindParam(":token", $token);

        try {
            $ps->execute();

            if($ps->rowCount()){
                echo "<body style='background-color: #03a9f4'><h1 align='center' style='padding: 200px; color: white; font-family: Calibri; font-size: 50px'>Registrovani ste!</h1></body>";
                echo "<script>setTimeout(function(){window.location = '../index.php'}, 1555);</script>";
            }

            else {
                echo "<body style='background-color: #03a9f4'><h1 align='center' style='padding: 200px; color: white; font-family: Calibri; font-size: 50px'>Nalog postoji!</h1></body>";
                echo "<script>setTimeout(function(){window.location = '../index.php'}, 1555);</script>";
            }
        }
        catch (PDOException $ex) {
            echo $ex->getMessage();
        }

    }
    else {
        echo "<body style='background-color: #03a9f4'><h1 align='center' style='padding: 200px; color: white; font-family: Calibri; font-size: 50px'>Zabranjen pristup!</h1></body>";
        echo "<script>setTimeout(function(){window.location = '../index.php'}, 1555);</script>";
    }