<?php
    session_start();

    if(isset($_POST["btnSubmit_modal"])){

        $email = $_POST["tbEmail_modal"];
        $pass = $_POST["tbPass_modal"];

        $errors = [];

        $rePass = "/^[\S]{5,}$/";

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            $errors[] = "E-mail nije u dobrom formatu!";

        if(!preg_match($rePass, $pass))
            $errors[] = "Lozinka mora imati najmanje 5 karaktera!";

        if(count($errors) > 0){
            $_SESSION["errors"] = $errors;
            header("Location: ../index.php");
        }
        else {
            require_once "connection.php";
            $pass = md5($pass);

            $query = "SELECT k.ime, k.prezime, k.email, k.datum, k.slika, u.naziv, k.id as id_user 
                        FROM korisnik k 
                        INNER JOIN uloga u 
                        ON k.uloga_id = u.id 
                        WHERE aktivan = 1 
                        AND email = :email 
                        AND lozinka = :pass";

            $ps = $connection->prepare($query);
            $ps->bindParam(":email", $email);
            $ps->bindParam(":pass", $pass);

            try {
                $ps->execute();
                $user = $ps->fetch();
            }
            catch (PDOException $ex){
                $errors[] = "Greška u radu sa bazom!";
                $_SESSION["errors"] = $errors;
                header("Location: ../index.php");
            }

            if($user) {
                $_SESSION["user"] = $user;
                header("Location: ../index.php");
            }
            else {
                $errors[] = "Pogrešno uneti podaci ili niste registrovani. <a href='index.php?stranica=registracija'>Registrujte se</a>";
                $_SESSION["errors"] = $errors;
                header("Location: ../index.php");
            }
        }
    }
    else{
        header("Location: ../index.php");
    }