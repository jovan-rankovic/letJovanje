<?php
    session_start();

    require_once "modules/connection.php";
    require "modules/functions.php";

    $page = "";
    if(isset($_GET["stranica"]))
        $page = $_GET["stranica"];

    include "views/head.php";
    include "views/header.php";
    include "views/nav.php";
    include "views/modals.php";

    switch($page){
        case "post":
            include "views/post.php";
            break;
        case "kontakt":
            include "views/contact.php";
            break;
        case "registracija":
            include "views/registration.php";
            break;
        case "profil":
            include "views/profile.php";
            break;
        default:
            include "views/home.php";
            break;
    }

    include "views/footer.php";
    include "views/scripts.php";