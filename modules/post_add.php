<?php
    session_start();

    if($_SESSION["user"]->naziv == "admin"){

        if(isset($_POST["btnPost_add"])){
            $errors = [];
            $title = $_POST["tbTitle_post"];
            $text = $_POST["taTekst_post"];

            $img = $_FILES["img_post"];

            $img_name = $img["name"];
            $img_tmp_path = $img["tmp_name"];
            $img_type = $img["type"];
            $img_size = $img["size"];
            $img_format = ["image/jpg", "image/jpeg", "image/png"];

            $reTitle = "/^[\wĆČŽĐŠćčžđš .!(\?)':\"-]{2,100}$/";
            $reText = "/^[\wĆČŽĐŠćčžđš .!(\?)':\"-]{2,}$/";

            if (!preg_match($reTitle, $title))
                $errors[] = "Naslov nije u dobrom formatu!";

            if (!preg_match($reText, $text))
                $errors[] = "Post nije u dobrom formatu!";

            if (!in_array($img_type, $img_format))
                $errors[] = "Slika mora biti .jp(e)g ili .png!";

            if ($img_size > 2000000)
                $errors[] = "Slika probija limit veličine!";

            if (count($errors) > 0) {
                echo "<body style='background-color: #03a9f4'>";

                foreach ($errors as $error)
                    echo "<p align='center' style='padding: 5px;color: white; font-family: Calibri; font-size: 25px'>$error</p>";

                echo "</body>";
                echo "<script>setTimeout(function(){window.location = '../admin.php'}, 3000);</script>";
            }
            else {
                $img_path = "../img/blog/" . time() . rand() . $img_name;
                move_uploaded_file($img_tmp_path, $img_path);
                $img_db_path = substr($img_path, 3);

                require_once "connection.php";

                $userId = $_SESSION["user"]->id_user;

                $query = "INSERT INTO post VALUES ('', :title, :text, DEFAULT, :userId, :img)";
                $ps = $connection->prepare($query);
                $ps->bindParam(":title",$title);
                $ps->bindParam(":text",$text);
                $ps->bindParam(":userId",$userId);
                $ps->bindParam(":img",$img_db_path);

                try{
                    $result = $ps->execute();
                    if($result){
                        echo "<body style='background-color: #03a9f4'><h1 align='center' style='padding: 200px; color: white; font-family: Calibri; font-size: 50px'>Post objavljen!</h1></body>";
                        echo "<script>setTimeout(function(){window.location = '../admin.php'}, 1555);</script>";
                    }
                }
                catch (PDOException $ex){
                    $sql_error = $ex->getCode();
                    echo  $sql_error;
                }
            }
        }
        else{
            echo "<body style='background-color: #03a9f4'><h1 align='center' style='padding: 200px; color: white; font-family: Calibri; font-size: 50px'>Popunite formu!</h1></body>";
            echo "<script>setTimeout(function(){window.location = '../admin.php'}, 1555);</script>";
        }
    }
    else{
        echo "<body style='background-color: #03a9f4'><h1 align='center' style='padding: 200px; color: white; font-family: Calibri; font-size: 50px'>Zabranjen pristup!</h1></body>";
        echo "<script>setTimeout(function(){window.location = '../admin.php'}, 1555);</script>";
    }