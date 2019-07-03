<?php
    session_start();

    if(isset($_SESSION["user"])) {
        if ($_SESSION["user"]->naziv == "admin") {
            require_once "modules/connection.php";

            include "views/admin_head.php";
            include "views/admin_loader.php";
            include "views/admin_nav.php";
            include "views/admin_sidebar.php";
            include "views/admin_content.php";
            include "views/admin_scripts.php";
        }
    }
    else{
        header("Location: index.php");
    }