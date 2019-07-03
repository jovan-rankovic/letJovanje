<?php
    if(isset($_POST["btnUser_add"])){
        $errors = [];
        $firstName = $_POST["tbFN_user"];
        $lastName = $_POST["tbLN_user"];
        $email = $_POST["tbEmail_user"];
        $pass = $_POST["tbPass_user"];

        $img = $_FILES["img_user"];

        $img_name = $img["name"];
        $img_tmp_path = $img["tmp_name"];
        $img_type = $img["type"];
        $img_size = $img["size"];
        $img_format = ["image/jpg", "image/jpeg", "image/png"];

        $reFirstName = "/^[A-ZĆČŽĐŠ][a-zćčžđš]{2,59}$/";
        $reLastName = "/^[A-ZĆČŽĐŠ][a-zćčžđš]{2,79}$/";
        $rePass = "/^[\w~_!@#$%^&*(),.?:{}|<>=-]{5,}$/";
        if (!preg_match($reFirstName, $firstName))
            $errors[] = "Ime nije u dobrom formatu!";

        if (!preg_match($reLastName, $lastName))
            $errors[] = "Prezime nije u dobrom formatu!";

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $errors[] = "E-mail nije u dobrom formatu!";

        if (!preg_match($rePass, $pass))
            $errors[] = "Lozinka mora imati bar 5 karaktera!";

        if (!isset($_POST["rbRole_user"]))
            $errors[] = "Izaberite ulogu!";

        if (!isset($_POST["rbActive_user"]))
            $errors[] = "Izaberite aktivnost korisnika!";

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
            $role = $_POST["rbRole_user"];
            $active = $_POST["rbActive_user"];
            
            if($active != "1") {
                $active = NULL;
            }

            $img_path = "../img/users/" . time() . rand() . $img_name;
            move_uploaded_file($img_tmp_path, $img_path);
            $img_db_path = substr($img_path, 3);

            $pass_db = md5($pass);

            require_once "connection.php";

            $query = "INSERT INTO korisnik VALUES ('', :fn, :ln, :email, :pass, DEFAULT, :active, :role, :img, DEFAULT)";
            $ps = $connection->prepare($query);
            $ps->bindParam(":fn",$firstName);
            $ps->bindParam(":ln",$lastName);
            $ps->bindParam(":email",$email);
            $ps->bindParam(":pass",$pass_db);
            $ps->bindParam(":active",$active);
            $ps->bindParam(":role",$role);
            $ps->bindParam(":img",$img_db_path);

            try{
                $result = $ps->execute();
                if($result){
                    echo "<body style='background-color: #03a9f4'><h1 align='center' style='padding: 200px; color: white; font-family: Calibri; font-size: 50px'>Korisnik dodat!</h1></body>";
                    echo "<script>setTimeout(function(){window.location = '../admin.php'}, 1555);</script>";
                }
            }
            catch (PDOException $ex){
                $sql_error = $ex->getCode();
                if($sql_error == 23000) {
                    echo "<body style='background-color: #03a9f4'><h1 align='center' style='padding: 200px; color: white; font-family: Calibri; font-size: 50px'>E-mail već postoji!</h1></body>";
                    echo "<script>setTimeout(function(){window.location = '../admin.php'}, 1555);</script>";
                }
            }
        }
    }
    else{
        echo "<body style='background-color: #03a9f4'><h1 align='center' style='padding: 200px; color: white; font-family: Calibri; font-size: 50px'>Popunite formu!</h1></body>";
        echo "<script>setTimeout(function(){window.location = '../admin.php'}, 1555);</script>";
    }