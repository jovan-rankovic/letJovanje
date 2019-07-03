<?php
    if( isset($_FILES["userImg"]) && isset($_POST["hdnUsrId"]) ) {
        $img = $_FILES["userImg"];
        $usrId = $_POST["hdnUsrId"];
        $errors = [];

        $img_name = $img["name"];
        $img_tmp_path = $img["tmp_name"];
        $img_type = $img["type"];
        $img_size = $img["size"];
        $img_format = ["image/jpg", "image/jpeg", "image/png"];

        if (!in_array($img_type, $img_format))
            $errors[] = "Slika mora biti .jp(e)g ili .png!";

        if ($img_size > 2000000)
            $errors[] = "Slika probija limit veličine!";

        if (count($errors) > 0) {
            echo "<body style='background-color: #03a9f4'>";

            foreach ($errors as $error)
                echo "<p align='center' style='padding: 5px;color: white; font-family: Calibri; font-size: 25px'>$error</p>";

            echo "</body>";
            echo "<script>setTimeout(function(){window.location = '../index.php'}, 3000);</script>";
        }
        else {
            $img_path = "../img/users/" . time() . rand() . $img_name;
            move_uploaded_file($img_tmp_path, $img_path);
            $img_db_path = substr($img_path, 3);

            require_once "connection.php";
            $query = "UPDATE korisnik SET slika = :img WHERE id = :id";
            $ps = $connection->prepare($query);
            $ps->bindParam(":img",$img_db_path);
            $ps->bindParam(":id",$usrId);

            try{
                $result = $ps->execute();
                if($result){
                    echo "<script>setTimeout(function(){window.location = '../index.php?stranica=profil'}, 1);</script>";
                }
            }
            catch (PDOException $ex){
                $sql_error = $ex->getCode();
                echo  $sql_error;
            }
        }
    }
    else {
        echo "<script>setTimeout(function(){window.location = '../index.php'}, 1);</script>";
    }