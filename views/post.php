<?php
    if(isset($_GET["izabrani"])):
        $timestamp = time();
        $currentDate = date("d.m.Y. H:i", $timestamp);

        $post_id = $_GET["izabrani"];

        $query_com = "SELECT * from komentar WHERE post_id = $post_id";
        $numComments = $connection->query($query_com)->rowCount();

        $query_pk = "SELECT p.id AS id_post, p.naslov, p.tekst, p.datum AS datum_post, p.slika AS slika_post,
                            k.id AS id_korisnik, k.ime, k.prezime, k.slika AS slika_korisnik
                            FROM post p
                            INNER JOIN korisnik k
                            ON p.korisnik_id = k.id
                            WHERE p.id = :post_id
        ";
        $ps = $connection->prepare($query_pk);
        $ps->bindParam(":post_id", $post_id);
        try {
            $ps->execute();
            $post = $ps->fetch();
        }
        catch (PDOException $ex){
            echo $ex->getCode();
        }

        $query_ukp = "SELECT u.id AS id_korisnik, u.ime, u.prezime, u.slika AS slika_korisnik,
                                k.id AS id_komentar, k.tekst AS tekst_komentar, k.datum AS datum_komentar,
                                p.id AS id_post, p.naslov, p.tekst AS tekst_post, p.datum AS datum_post, p.slika AS slika_post
                        FROM korisnik u 
                        INNER JOIN komentar k ON u.id = k.korisnik_id
                        INNER JOIN post p ON k.post_id = p.id
                        WHERE p.id = $post_id
        ";
        try {
            $comments_info = sql_select_all($query_ukp);
        }
        catch (PDOException $ex){
            echo $ex->getCode();
        }
        ?>

    <figure class="full-image"><img src="<?= $post->slika_post ?>" alt="">
        <figcaption><?= $post->ime.' '.$post->prezime.', '.substr(dateFormat($post->datum_post), 0, 11) ?></figcaption>
    </figure>
    <section class="blog-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="post-content">
                        <h1><?= $post->naslov ?></h1>
                        <p><?= $post->tekst ?></p>
                    </div>

                    <div class="comments">

                        <div id="numCom">

                    <?php if(!$numComments): ?>
                        <h4>Nema komentara</h4>

                    <?php elseif($numComments == "1"):?>
                        <h4>1 komentar</h4>

                    <?php else: ?>
                        <h4><?= $numComments ?> komentara</h4>

                    <?php endif; ?>

                        </div>

                        <div id="comment_data"></div>

                <?php $i = 0; ?>

                <?php foreach ($comments_info AS $info): ?>

                        <div class="row comment">

                            <div class="col-sm-3 col-md-2 col-xs-2">
                                <p><img src="<?= $info->slika_korisnik ?>" width="150" height="150" class="img-responsive img-circle"></p>
                            </div>
                            <div class="col-sm-9 col-md-10">

                                <?php
                                    if(isset($_SESSION["user"])):
                                        if($_SESSION["user"]->id_user == $info->id_korisnik || $_SESSION["user"]->naziv == "admin" ):
                                ?>

                                    <button type="button" class="close" aria-label="Close" data-toggle="modal" data-target="#deleteWarning<?= $i ?>">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                    <div class="modal fade" id="deleteWarning<?= $i++ ?>" role="dialog">
                                        <div class="modal-dialog modal-sm text-center">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        &times;
                                                    </button>
                                                    <h4>Da li ste sigurni?</h4>
                                                    <button type="button" class="btn btn-default error" onclick="delete_comment(<?= $info->id_komentar ?>,<?= $info->id_korisnik ?>);">
                                                        Obriši
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php endif; ?>
                                <?php endif; ?>

                                <h5><?= $info->ime.' '.$info->prezime ?></h5>
                                <p class="posted"><i class="fa fa-clock-o"></i> <?= dateFormat($info->datum_komentar) ?></p>
                                <p class="text-gray"><?= $info->tekst_komentar ?></p>
                            </div>
                        </div>

                <?php endforeach; ?>

                    <?php if(isset($_SESSION["user"])): ?>
                        <div class="comment-form">
                            <h4>Ostavite komentar</h4>
                            <form action="" method="post" id="form_comment_add">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea id="taText_comment" name="taText_comment" rows="4" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" id="hdnIdPost_comment" name="hdnIdPost_comment" class="form-control" value="<?= $post->id_post ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" id="hdnIdUser_comment" name="hdnIdUser_comment" class="form-control" value="<?= $_SESSION["user"]->id_user ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" id="hdnImgUser_comment" name="hdnImgUser_comment" class="form-control" value="<?= $_SESSION["user"]->slika ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" id="hdnFNUser_comment" name="hdnFNUser_comment" class="form-control" value="<?= $_SESSION["user"]->ime ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" id="hdnLNUser_comment" name="hdnLNUser_comment" class="form-control" value="<?= $_SESSION["user"]->prezime ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" id="hdnDate_comment" name="hdnDate_comment" class="form-control" value="<?= $currentDate ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" id="hdnId_comment" name="hdnId_comment" class="form-control" value="<?= $info->id_komentar ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 text-right">
                                        <button type="button" class="btn btn-primary" name="btnComment_add" id="btnComment_add" value="CommentAdd"><i class="fa fa-comment-o"></i> Komentariši</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    <?php else: ?>
                        <div class="comment-form">
                            <h5>Ulogujte se kako biste mogli da komentarišete.</h5>
                        </div>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>

<?php else:
        echo "<body style='background-color: #03a9f4'><h1 align='center' style='padding: 200px; color: white; font-family: Calibri; font-size: 50px'>Izaberite post!</h1></body>";
        echo "<script>setTimeout(function(){window.location = 'index.php'}, 1555);</script>";
?>
<?php endif; ?>
