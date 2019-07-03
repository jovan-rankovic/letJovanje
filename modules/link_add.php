<?php
    if(isset($_POST["btnLink_add"])) {
        $errors = [];
        $title = $_POST["tbTitle_link"];
        $url = $_POST["tbURL_link"];
        $pos = $_POST["tbPos_link"];

        $reTitle = "/^[\wĆČŽĐŠćčžđš]{3,30}$/";
        $rePos = "/^[\d]+$/";

        if(!preg_match($reTitle, $title))
            $errors[] = "Naslov nije u dobrom formatu!";

        if(!filter_var($url, FILTER_VALIDATE_URL))
            $errors[] = "URL nije u dobrom formatu!";

        if(!preg_match($rePos, $pos))
            $errors[] = "Broj mora biti pozitivan!";

        if (count($errors) > 0) {
            echo "<body style='background-color: #03a9f4'>";

            foreach ($errors as $error)
                echo "<p align='center' style='padding: 5px;color: white; font-family: Calibri; font-size: 25px'>$error</p>";

            echo "</body>";
            echo "<script>setTimeout(function(){window.location = '../admin.php'}, 3000);</script>";
        }
        else{
            require_once "connection.php";

            $query = "INSERT INTO link VALUES ('', :title, :url, :pos)";
            $ps = $connection->prepare($query);
            $ps->bindParam(":title",$title);
            $ps->bindParam(":url",$url);
            $ps->bindParam(":pos",$pos);

            try{
                $result = $ps->execute();
                if($result){
                    echo "<body style='background-color: #03a9f4'><h1 align='center' style='padding: 200px; color: white; font-family: Calibri; font-size: 50px'>Link dodat!</h1></body>";
                    echo "<script>setTimeout(function(){window.location = '../admin.php'}, 1555);</script>";
                }
            }
            catch (PDOException $ex){
                $sql_error = $ex->getCode();
                if($sql_error == 23000) {
                    echo "<body style='background-color: #03a9f4'><h1 align='center' style='padding: 200px; color: white; font-family: Calibri; font-size: 50px'>Pozicija postoji!</h1></body>";
                    echo "<script>setTimeout(function(){window.location = '../admin.php'}, 1555);</script>";
                }
            }
        }
    }
    else{
        echo "<body style='background-color: #03a9f4'><h1 align='center' style='padding: 200px; color: white; font-family: Calibri; font-size: 50px'>Popunite formu!</h1></body>";
        echo "<script>setTimeout(function(){window.location = '../admin.php'}, 1555);</script>";
    }