<section>
    <aside id="leftsidebar" class="sidebar">

        <!-- User info -->
        <div class="user-info">
            <div class="image">
                <img src="<?= $_SESSION['user']->slika; ?>" width="52" height="52" alt="Admin" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $_SESSION["user"]->ime.' '.$_SESSION["user"]->prezime; ?></div>
                <div class="email"><?= $_SESSION['user']->email; ?></div>
            </div>
        </div>
        <!-- User info END -->

        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">NAVIGACIJA</li>

                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">person</i>
                        <span>Korisnici</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a class="link_show_all" data-link="user_show">Prikaži sve korisnike</a>
                        </li>
                        <li>
                            <a class="link_show_all" data-link="user_add">Dodaj novog korisnika</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">link</i>
                        <span>Linkovi</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a class="link_show_all" data-link="link_show">Prikaži sve linkove</a>
                        </li>
                        <li>
                            <a class="link_show_all" data-link="link_add">Dodaj novi link</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">border_color</i>
                        <span>Postovi</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a class="link_show_all" data-link="post_show">Prikaži sve postove</a>
                        </li>
                        <li>
                            <a class="link_show_all" data-link="post_add">Dodaj novi post</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">photo_library</i>
                        <span>Galerija</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a class="link_show_all" data-link="gallery_show">Prikaži sve slike</a>
                        </li>
                        <li>
                            <a class="link_show_all" data-link="gallery_add">Dodaj sliku</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">question_answer</i>
                        <span>Ankete</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a class="link_show_all" data-link="pool_show">Prikaži sve ankete</a>
                        </li>
                        <li>
                            <a class="link_show_all" data-link="pool_add">Dodaj anketu</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Menu END -->

        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2018 Jovan Ranković
            </div>
            <div class="version">
                <a href="http://ict.edu.rs">Visoka ICT škola</a>
            </div>
        </div>
        <!-- Footer END -->

    </aside>
</section>