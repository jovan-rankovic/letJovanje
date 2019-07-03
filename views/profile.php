<?php
    if(isset($_SESSION["user"])):
        $userID = $_SESSION["user"]->id_user;

        $queryUsrCom = "SELECT *
                            FROM komentar k
                            INNER JOIN korisnik u
                            ON k.korisnik_id = u.id
                            WHERE u.id = $userID
        ";
        $numCom = $connection->query($queryUsrCom)->rowCount();

        $queryUsrPost = "SELECT *
                            FROM post p
                            INNER JOIN korisnik u
                            ON p.korisnik_id = u.id
                            WHERE u.id = $userID
        ";
        $numPost = $connection->query($queryUsrPost)->rowCount();

        $queryImg = "SELECT slika FROM korisnik WHERE id = :id";
        $ps = $connection->prepare($queryImg);
        $ps->bindParam(":id", $userID);
        $ps->execute();
        $userImg = $ps->fetch();
?>

    <section class="background-gray-lightest">
        <div class="container text-center" id="profile_page">
            <div class="row">

                <div class="col-md-5 col-md-offset-3">

                    <div class="panel">
                        <div class="panel-heading">
                            <h4>Profil korisnika</h4>
                        </div>

                        <div class="bot-border"></div>

                        <div class="panel-body">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="col-sm-6">
                                        <div align="center">
                                            <img alt="user_picture" src="<?= $userImg->slika ?>" id="profile-image" class="img-circle img-responsive">

                                            <form action="modules/user_img_update.php" method="POST" enctype="multipart/form-data" id="form-user-img-update">
                                                <input id="profile-image-upload" name="userImg" class="hidden" type="file" onchange="this.form.submit();"/>
                                                <input type="hidden" name="hdnUsrId" value="<?= $_SESSION["user"]->id_user ?>"/>
                                            </form>

                                            <div id="user_img_info">Kliknite na sliku za izmenu</div>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 id="user_info"><?= $_SESSION["user"]->ime.' '.$_SESSION["user"]->prezime ?> </h4></span>
                                        <span><?= $_SESSION["user"]->naziv == "korisnik" ? "Korisnik" : "Administrator" ?></span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="bot-border"></div>

                                            <div class="col-sm-6 col-xs-6 profileInfo" >Član od:</div><div class="col-sm-6"><?= dateFormat($_SESSION["user"]->datum) ?></div>
                                    <div class="clearfix"></div>

                                    <div class="bot-border"></div>

                                    <div class="col-sm-6 col-xs-6 profileInfo" >Broj komentara:</div><div class="col-sm-6"><?= $numCom ?></div>
                                    <div class="clearfix"></div>

                                    <div class="bot-border"></div>

                                    <?php if($_SESSION["user"]->naziv == "admin"): ?>

                                        <div class="col-sm-6 col-xs-6 profileInfo" >Broj postova:</div><div class="col-sm-6"><?= $numPost ?></div>
                                        <div class="clearfix"></div>

                                        <div class="bot-border"></div>

                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php else: echo "<script>setTimeout(function(){window.location = 'index.php'}, 1);</script>"; ?>
<?php endif; ?>

