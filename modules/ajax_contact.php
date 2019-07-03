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
        $title = $_POST["title"];
        $msg = $_POST["msg"];

        $errors = [];

        $reFirstName = "/^[A-ZĆČŽĐŠ][a-zćčžđš]{2,59}$/";
        $reLastName = "/^[A-ZĆČŽĐŠ][a-zćčžđš]{2,79}$/";
        $reTitle = "/^[\wĆČŽĐŠćčžđš .,!(\?)':\"-]{2,50}$/";
        $reMsg = "/^[\wĆČŽĐŠćčžđš .,!(\?)':\"-]{2,}$/";

        if(!preg_match($reFirstName, $firstName))
            $errors[] = "Ime nije u dobrom formatu!";

        if(!preg_match($reLastName, $lastName))
            $errors[] = "Prezime nije u dobrom formatu!";

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            $errors[] = "E-mail nije u dobrom formatu!";

        if(!preg_match($reTitle, $title))
            $errors[] = "Naslov nije u dobrom formatu!";

        if(!preg_match($reMsg, $msg))
            $errors[] = "Poruka nije u dobrom formatu!";

        if(count($errors) > 0) {
            $code = 422;

            echo "<ul>";

            foreach ($errors as $error)
                echo "<li>$error</li>";

            echo "<ul>";
        }
        else {
            $mail = new PHPMailer(true);
            $my_email = "letjovanje@gmail.com";
            try {
                //$mail->isSMTP(); SMTP radi na XAMPP-u, ali hosting ne dozvoljava, bez ovoga koristi mail()
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = $my_email;
                $mail->Password = "xxx";
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
                $mail->addAddress($my_email);

                $mail->isHTML(true);
                $mail->Subject = $title;
                $mail->Body = "Ime: $firstName<br/>Prezime: $lastName<br/>E-mail: $email<br/>Poruka: $msg";
                $mail->send();

                echo "Poruka je uspešno poslata administratoru. Očekujte odgovor u najkraćem roku.";
            }
            catch (Exception $e) {
                echo "Poruka nije poslata. Greška: ", $mail->ErrorInfo;
            }
        }
    }
    else {
        $code = 404;
    }
    http_response_code($code);