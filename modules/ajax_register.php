<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require "php_mailer/src/Exception.php";
    require "php_mailer/src/PHPMailer.php";
    require "php_mailer/src/SMTP.php";

    if(isset($_POST["btn"])) {
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $pass = $_POST["pass"];

        $errors = [];

        $reFirstName = "/^[A-ZĆČŽĐŠ][a-zćčžđš]{2,59}$/";
        $reLastName = "/^[A-ZĆČŽĐŠ][a-zćčžđš]{2,79}$/";
        $rePass = "/^[\w~_!@#$%^&*(),.?:{}|<>=-]{5,}$/";

        if(!preg_match($reFirstName, $firstName))
            $errors[] = "Ime nije u dobrom formatu!";

        if(!preg_match($reLastName, $lastName))
            $errors[] = "Prezime nije u dobrom formatu!";

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            $errors[] = "E-mail nije u dobrom formatu!";

        if(!preg_match($rePass, $pass))
            $errors[] = "Lozinka mora imati bar 5 karaktera!";

        if(count($errors) > 0) {
            $code = 422;

            echo "<ul>";

            foreach ($errors as $error)
                echo "<li>$error</li>";

            echo "<ul>";
        }
        else {
            $pass = md5($pass);

            require_once "connection.php";

            $query = "INSERT INTO korisnik VALUES ('', :firstName, :lastName, :email, :pass, DEFAULT, DEFAULT, 2, DEFAULT, :token)";
            $ps = $connection->prepare($query);
            $ps->bindParam(":firstName", $firstName);
            $ps->bindParam(":lastName", $lastName);
            $ps->bindParam(":email", $email);
            $ps->bindParam(":pass", $pass);
            $token = md5(time() . $email);
            $ps->bindParam(":token", $token);

            try {
                $code = $ps->execute() ? 201 : 500;

                if($code == 201) {
                    $mail = new PHPMailer(true);
                    $my_email = "letjovanje@gmail.com";
                    try {
                        //$mail->isSMTP();
                        $mail->Host = "smtp.gmail.com";
                        $mail->SMTPAuth = true;
                        $mail->Username = $my_email;
                        $mail->Password = "jovan1234";
                        $mail->SMTPSecure = "tls";
                        $mail->Port = 587;

                        $mail->SMTPOptions = array(
                            "ssl" => array(
                                "verify_peer" => false,
                                "verify_peer_name" => false,
                                "allow_self_signed" => true
                            )
                        );

                        $mail->setFrom($my_email, "Admin");
                        $mail->addAddress($email);

                        $mail->isHTML(true);
                        $mail->Subject = "LetJovanje - Registracija";
                        $href = "http://letjovanje.dx.am/modules/activation.php?a=".$token;
                        $mail->Body = "Aktivirajte svoj nalog, kliknite <a href='" . $href . "'>OVDE</a>!";
                        $mail->send();

                        echo "Aktivacioni link je poslat na Vašu e-mail adresu.";
                    }
                    catch (Exception $e) {
                        echo "Poruka nije poslata. Greška: ", $mail->ErrorInfo;
                    }
                }
            }
            catch (PDOException $ex) {
                $pdoError = $ex->getCode();
                if($pdoError = 23000){
                    echo "E-mail već postoji!";
                }
                $code = 409;
            }
        }
    }
    else {
        $code = 404;
    }
    http_response_code($code);

