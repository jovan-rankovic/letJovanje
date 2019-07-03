    <div class="jumbotron main-jumbotron">
        <div class="container">
            <div class="content">
                <h1>Vaš vodič za najbolje letnje destinacije</h1>
            </div>
        </div>
    </div>
    <section>
        <div class="container">
            <p class="lead">Pozdrav, moje ime je Jovan i ovim blogom ću pokušati da Vam dočaram utiske sa najlepših plaža sveta. Kažu da jedna slika vredi hiljadu reči, ali kad su obe stvari dobro ukombinovane, vrednost je neprocenljiva. Nadam se da ćete uživati u mojim postovima.</p>
        </div>
    </section>
    <section class="background-gray-lightest">
        <div class="container">
            <div class="row" id="pn">

                <?php
                    if(isset($_GET["pn"])) {
                        $selectedPage = $_GET["pn"];
                        $pnPage = ($selectedPage-1)*3;

                        $query_posts = "SELECT * FROM post ORDER BY datum DESC LIMIT $pnPage,3";
                        $allPosts = sql_select_all($query_posts);
                    }
                    else {
                        $query_posts = "SELECT * FROM post ORDER BY datum DESC LIMIT 3";
                        $allPosts = sql_select_all($query_posts);
                    }

                    foreach ($allPosts as $post):
                ?>
                        <div class="col-sm-4">
                            <div class="post">
                                <div class="image"><a href="index.php?stranica=post&izabrani=<?= $post->id ?>"><img src="<?= $post->slika ?>" alt="slika_posta" class="img-responsive"></a></div>
                                <h3><a href="index.php?stranica=post&izabrani=<?= $post->id ?>"><?= $post->naslov ?></a></h3>
                                <p class="post__intro"><?= substr($post->tekst, 0, 150).'...' ?></p>
                                <p class="read-more"><a href="index.php?stranica=post&izabrani=<?= $post->id ?>" class="btn btn-ghost">Pročitajte još     </a></p>
                            </div>
                        </div>

                <?php endforeach; ?>
            </div>
                <?php
                    $query_pn = "SELECT COUNT(*) as numRows from post";
                    $numRows = $connection->query($query_pn)->fetch()->numRows;
                    $perPage = 3;
                    $numPages = ceil($numRows/$perPage);
                ?>

                <div class="text-center">
                    <ul class="pagination pagination-centered">

                        <?php if(!isset($_GET["pn"])): ?>

                            <li class="page-item disabled">

                        <?php else: ?>

                            <li class="page-item">

                        <?php endif; ?>


                            <a class="page-link" href="index.php#pn" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>

                        <?php for($i=0; $i<$numPages; $i++): ?>

                            <?php if(isset($_GET["pn"])): ?>

                                <?php if($i==0): ?>
                                    <li><a href="index.php#pn">1</a></li>

                                    <?php elseif($_GET["pn"]==$i+1): ?>
                                        <li class="active"><a href="index.php?pn=<?= $i+1 ?>#pn"><?= $i+1 ?></a></li>

                                    <?php else: ?>
                                        <li><a href="index.php?pn=<?= $i+1 ?>#pn"><?= $i+1 ?></a></li>

                                <?php endif; ?>

                            <?php else: ?>

                                <?php if($i==0): ?>
                                    <li class="active"><a href="index.php#pn">1</a></li>

                                <?php else: ?>
                                    <li><a href="index.php?pn=<?= $i+1 ?>#pn"><?= $i+1 ?></a></li>

                                <?php endif; ?>

                            <?php endif; ?>

                        <?php endfor; ?>

                        <?php if(isset($_GET["pn"])): ?>

                            <?php if($_GET["pn"]==$numPages): ?>
                                <li class="page-item disabled">

                            <?php else: ?>
                                <li class="page-item">

                            <?php endif; ?>

                            <?php else: ?>
                                <li class="page-item">

                            <?= "<script></script>" ?>

                        <?php endif; ?>

                            <a class="page-link" href="index.php?pn=<?= $numPages ?>#pn" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </div>
        </div>
    </section>
    <section>
        <div class="container clearfix">
            <div class="row services">
                <div class="col-md-12">
                    <h2 class="h1">Šta Vam nudi ovaj blog?</h2>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="box box-services">
                                <div class="icon"><i class="pe-7s-camera"></i></div>
                                <h4 class="heading">Vrhunske fotografije</h4>
                                <p>Najbolje fotografije sa egzotičnih destinacija</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box box-services">
                                <div class="icon"><i class="pe-7s-pen"></i></div>
                                <h4 class="heading">Najbolje priče</h4>
                                <p>Detaljni izveštaji i ocene svih destinacija</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box box-services">
                                <div class="icon"><i class="pe-7s-chat"></i></div>
                                <h4 class="heading">Odgovore na sva Vaša pitanja</h4>
                                <p>Odgovaram na Vaše poruke u najbržem roku</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="gallery" class="background-gray-lightest">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="heading">Galerija</h1>
                    <p class="lead">Najlepše slike sa mojih putovanja</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row no-space">

                <?php
                    $query_imgs = "SELECT * from galerija";
                    $allImgs = sql_select_all($query_imgs);
                    foreach ($allImgs as $img):
                ?>

                <div class="col-sm-4 col-xs-6">
                    <div class="box"><a href="<?= $img->putanja ?>" title="" data-lightbox="gallery" data-title="<?= $img->naslov ?>"><img src="<?= $img->putanja ?>" alt="<?= $img->alt ?>" class="img-responsive"></a></div>
                </div>

                <?php endforeach; ?>

            </div>
        </div>
    </section>