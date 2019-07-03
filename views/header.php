    <body>

    <?php
        if(!isset($_SESSION["user"])) {
            if (isset($_SESSION["errors"])) {
                $loginErrors = $_SESSION["errors"];
                echo '   <div class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                ';
                foreach ($loginErrors as $lg_error) {
                    echo " ~ " . $lg_error;
                }
                echo ' </div>';
                unset($_SESSION["errors"]);
            }
        }
    ?>

        <header class="header">
          <div role="navigation" class="navbar navbar-default">
            <div class="container">
              <div class="navbar-header"><a href="index.php" class="navbar-brand">letJovanje</a>
                <div class="navbar-buttons">
                  <button type="button" data-toggle="collapse" data-target=".navbar-collapse" class="navbar-toggle navbar-btn">Meni<i class="fa fa-align-justify"></i></button>
                </div>
              </div>