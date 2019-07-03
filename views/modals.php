                <a href="#" data-toggle="modal" data-target="#author-modal" class="btn navbar-btn btn-ghost"><i class="fa fa-info-circle"></i>Autor</a>

                <?php if(!isset($_SESSION["user"])): ?>
                    <a href="#" data-toggle="modal" data-target="#login-modal" class="btn navbar-btn btn-ghost"><i class="fa fa-sign-in"></i>Ulogujte se</a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</header>

<?php if(!isset($_SESSION["user"])): ?>

    <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                    <h4 id="Login" class="modal-title">Logovanje</h4>
                </div>
                <div class="modal-body">
                    <form action="modules/login.php" method="post" id="form_modal">
                        <div class="form-group">
                            <input id="tbEmail_modal" name="tbEmail_modal" type="email" placeholder="E-mail" class="form-control">
                        </div>
                        <div class="form-group">
                            <input id="tbPass_modal" name="tbPass_modal" type="password" placeholder="Lozinka" class="form-control">
                        </div>
                        <p class="text-center">
                            <button type="submit" class="btn btn-primary" id="btnSubmit_modal" name="btnSubmit_modal" value="Modal"><i class="fa fa-sign-in"></i> Ulogujte se</button>
                        </p>
                    </form>
                    <p class="text-center text-muted">Niste registrovani?</p>
                    <p class="text-center text-muted"><a href="index.php?stranica=registracija"><strong>Registrujte se</strong></a> kako biste mogli da komentarišete na mojim postovima</p>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

<!-- Author modal -->
    <div id="author-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 id="Login" class="modal-title">Autor sajta</h4>
                </div>

                <div class="modal-body">
                    <img src="img/users/admin.jpg" class="img-responsive img-circle"><br/>
                    <p class="text-center text-muted">Student: Jovan Ranković</p>
                    <p class="text-center text-muted">Broj indeksa: 145/14</p>
                    <p class="text-center text-muted">Obrazovna ustanova: <a href="http://ict.edu.rs"><strong>Visoka ICT škola</strong></a></p>
                </div>
            </div>
        </div>
    </div>
<!-- Author modal END -->