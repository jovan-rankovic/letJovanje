<?php
    if(isset($_POST["btnGallery_add"])){
        $errors = [];
        $title = $_POST["tbTitle_gallery"];
        $alt = $_POST["tbAlt_gallery"];

        $img = $_FILES["img_gallery"];

        $img_name = $img["name"];
        $img_tmp_path = $img["tmp_name"];
        $img_type = $img["type"];
        $img_size = $img["size"];
        $img_format = ["image/jpg", "image/jpeg", "image/png"];

        $reTitle = "/^[\wĆČŽĐŠćčžđš]{3,100}$/";
        $reAlt = "/^[\wĆČŽĐŠćčžđš]{3,255}$/";

        if (!preg_match($reTitle, $title))
            $errors[] = "Naslov nije u dobrom formatu!";

        if (!preg_match($reAlt, $alt))
            $errors[] = "Alt nije u dobrom formatu!";

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
            $img_path = "../img/gallery/" . time() . rand() . $img_name;
            move_uploaded_file($img_tmp_path, $img_path);
            $img_db_path = substr($img_path, 3);

            require_once "connection.php";

            $query = "INSERT INTO galerija VALUES ('', :title, :alt, :img)";
            $ps = $connection->prepare($query);
            $ps->bindParam(":title",$title);
            $ps->bindParam(":alt",$alt);
            $ps->bindParam(":img",$img_db_path);

            try{
                $result = $ps->execute();
                if($result){
                    echo "<body style='background-color: #03a9f4'><h1 align='center' style='padding: 200px; color: white; font-family: Calibri; font-size: 50px'>Slika dodata!</h1></body>";
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