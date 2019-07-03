    <footer class="footer">
        <div class="footer__block">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <h4 class="heading">Meni</h4>
                        <ul>
                            <li><a href="index.php">Početna</a></li>
                            <li><a href="index.php?stranica=kontakt">Kontakt</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <h4 class="heading">Budite u toku sa mnom</h4>
                        <p class="social social--big"><a href="https://www.facebook.com" data-animate-hover="pulse" class="external facebook"><i class="fa fa-facebook"></i></a><a href="https://plus.google.com/discover" data-animate-hover="pulse" class="external gplus"><i class="fa fa-google-plus"></i></a><a href="https://twitter.com/search-home" data-animate-hover="pulse" class="external twitter"><i class="fa fa-twitter"></i></a></p>
                    </div>

                    <?php
                        $ip = $_SERVER["REMOTE_ADDR"];

                        $query_ip = "SELECT ip FROM anketa_glas WHERE ip = :ip";
                        $ps0 = $connection->prepare($query_ip);
                        $ps0->bindParam(":ip",$ip);

                        $aktivna = 1;

                        $query_question = "SELECT id, tekst
                            FROM anketa_pitanje
                            WHERE id =
                            (SELECT MAX(id) FROM anketa_pitanje WHERE aktivna = :aktivna1)                            
                        ";
                        $ps1 = $connection->prepare($query_question);
                        $ps1->bindParam(":aktivna1", $aktivna);

                        $query_answer_votes = "SELECT DISTINCT ao.id AS id_odgovor, ao.tekst AS tekst_odgovor, ao.br_glasova
                            FROM anketa_pitanje ap
                            INNER JOIN anketa_odgovor ao
                            ON ap.id = ao.pitanje_id
                            LEFT JOIN anketa_glas ag
                            ON ao.id = ag.odgovor_id
                            WHERE ap.id =
                            (SELECT MAX(ap.id) FROM anketa_pitanje ap WHERE aktivna = :aktivna2)
                        ";
                        $ps2 = $connection->prepare($query_answer_votes);
                        $ps2->bindParam(":aktivna2",$aktivna);

                        try {
                            $ps0->execute();
                            $ps1->execute();
                            $ps2->execute();
                            $ip_guest = $ps0->fetch();
                            $question = $ps1->fetch();
                            $pool_infos = $ps2->fetchAll();
                        }
                        catch (PDOException $ex){
                            echo "<script>$('#vote_msg').html('Greška u radu sa bazom');</script>";
                        }
                    ?>

                    <div class="col-md-4 col-sm-12">
                        <div class="panel panel-primary" id="pool">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-question-circle-o"></span> <?= $question->tekst ?></h3>
                            </div>
                            <div class="panel-body">
                                <ul class="list-group">

                                   <?php foreach ($pool_infos as $pool_info): ?>

                                    <li class="list-group-item">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="pool" value="<?= $pool_info->id_odgovor ?>"> <?= $pool_info->tekst_odgovor ?> <b class="vote_info pull-right"><?= $pool_info->br_glasova ?></b>
                                            </label>
                                        </div>
                                    </li>

                                    <?php endforeach; ?>

                                </ul>
                            </div>
                            <div class="panel-footer text-center">
                                <button type="button" class="btn btn-primary btn-block btn-sm" id="btnVote" value="Vote">
                                    Glasajte</button>
                                <b class="vote_info small" id="vote_msg"></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; 2018 Jovan Ranković</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>