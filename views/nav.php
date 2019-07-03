            <div id="navigation" class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                
                    <?php
                        $query_links = "SELECT * FROM link ORDER BY pozicija";
                        $allLinks = sql_select_all($query_links);
                        foreach($allLinks as $link):
                    ?>
                    
                    <li><a href="<?= $link->url ?>"><?= $link->naslov ?></a></li>

                    <?php endforeach; ?>

                <?php if(isset($_SESSION["user"])): ?>

                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><?= $_SESSION["user"]->ime." ".$_SESSION["user"]->prezime ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?stranica=profil">Profil</a></li>
                            
                            <?php if($_SESSION["user"]->naziv == "admin"): ?>

                                <li><a href="admin.php">Admin panel</a></li>
                                <li><a href="letjovanje_dokumentacija.pdf">Dokumentacija</a></li>

                            <?php endif; ?>

                            <li><a href="modules/logout.php">Izlogujte se</a></li>
                        </ul>
                    </li>

                <?php endif; ?>

                </ul>