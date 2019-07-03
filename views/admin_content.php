<section class="content" id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">

                        <h2>
                            Dobrodošli, <?=  $_SESSION["user"]->ime.' '.$_SESSION["user"]->prezime; ?>!
                        </h2>

                    </div>

                    <?php
                        $query_users = "SELECT * FROM korisnik";
                        $count_users = $connection->query($query_users)->rowCount();

                        $query_links = "SELECT * FROM link";
                        $count_links = $connection->query($query_links)->rowCount();

                        $query_posts = "SELECT * FROM post";
                        $count_posts = $connection->query($query_posts)->rowCount();

                        $query_imgs = "SELECT * FROM galerija";
                        $count_imgs = $connection->query($query_imgs)->rowCount();

                        $query_pools = "SELECT * FROM anketa_pitanje";
                        $count_pools = $connection->query($query_pools)->rowCount();

                        $query_comments = "SELECT * FROM komentar";
                        $count_comments = $connection->query($query_comments)->rowCount();
                    ?>

                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="link_show_all info-box bg-light-blue hover-expand-effect" data-link="user_show">
                                    <div class="icon">
                                        <i class="material-icons">person</i>
                                    </div>
                                    <div class="content">
                                        <div class="text"><?= $count_users ?> KORISNIKA</div>
                                  </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="link_show_all info-box bg-light-blue hover-expand-effect" data-link="link_show">
                                    <div class="icon">
                                        <i class="material-icons">link</i>
                                    </div>
                                    <div class="content">
                                        <div class="text"><?= $count_links ?> LINKOVA</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="link_show_all info-box bg-light-blue hover-expand-effect" data-link="post_show">
                                    <div class="icon">
                                        <i class="material-icons">border_color</i>
                                    </div>
                                    <div class="content">
                                        <div class="text"><?= $count_posts ?> POSTOVA </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="link_show_all info-box bg-light-blue hover-expand-effect" data-link="gallery_show">
                                    <div class="icon">
                                        <i class="material-icons">photo_library</i>
                                    </div>
                                    <div class="content">
                                        <div class="text"><?= $count_imgs ?> SLIKA</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="link_show_all info-box bg-light-blue hover-expand-effect" data-link="pool_show">
                                    <div class="icon">
                                        <i class="material-icons">question_answer</i>
                                    </div>
                                    <div class="content">
                                        <div class="text"><?= $count_pools ?> ANKETA</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box bg-light-blue hover-expand-effect">
                                    <div class="icon">
                                        <i class="material-icons">mode_comment</i>
                                    </div>
                                    <div class="content">
                                        <div class="text"><?= $count_comments ?> KOMENTARA</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>