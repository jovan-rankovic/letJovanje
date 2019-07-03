<?php if(!isset($_SESSION["user"])): ?>

    <div class="omb_login background-gray-lightest">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <h1>Registracija</h1>
                <form class="omb_loginForm" action="" method="POST" id="form_reg">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="tbFN_reg" id="tbFN_reg" placeholder="Ime">
                    </div>
                    <span class="help-block"></span>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="tbLN_reg" id="tbLN_reg" placeholder="Prezime">
                    </div>
                    <span class="help-block"></span>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control" name="tbEmail_reg" id="tbEmail_reg" placeholder="E-mail">
                    </div>
                    <span class="help-block"></span>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input  type="password" class="form-control" name="tbPass_reg" id="tbPass_reg" placeholder="Lozinka">
                    </div>
                    <span class="help-block"></span>

                    <p><button class="btn btn-lg btn-primary btn-block" type="button" name="btnReg" id="btnReg" value="Registration" onclick="regCheck();">Potvrdi</button></p>

                </form>

                <span id="infoReg"></span>

            </div>
        </div>
    </div>

<?php else:
    header("Location: index.php");
    endif;
?>
