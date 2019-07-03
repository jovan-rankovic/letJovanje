<?php
    if(isset($_POST["flag"])) {
        $page = $_POST["link"];
        require_once "connection.php";
        $i = 1;

        switch ($page){
            // User - Show ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            case "user_show":
                $table = "korisnik";
                $query = "SELECT *, k.id as id_user 
                            FROM $table k 
                            INNER JOIN uloga u 
                            ON k.uloga_id = u.id";
                try{
                    $allUsers = sql_select_all($query);
                    if(!empty($allUsers)){
                        $code = 203;
                    }
                    else {
                        $code = 500;
                    }
                }
                catch (PDOException $ex){
                    $code = 500;
                }
                echo '         
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            <i class="material-icons icon_left">person</i> Korisnici<a href="admin.php"><i class="material-icons pull-right">keyboard_return</i><i class="pull-right go_back">Nazad</i></a>
                                            <small>Prikaz svih korisnika</small>
                                        </h2>
                                    </div> 
                                    <div class="table-responsive">
                                        <table id="" class="table table-striped">
                                            <thead>
                                                <tr class="info">
                                                    <th>Ime</th>
                                                    <th>Prezime</th>
                                                    <th>E-mail</th>
                                                    <th>Uloga</th>
                                                    <th>Datum registracije</th>
                                                    <th>Aktivan</th>
                                                    <th>Slika</th>
                                                    <th>Izmeni</th>
                                                    <th>Obriši</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                ';
                foreach ($allUsers as $user):
                    echo '
                        <tr>
                            <td>'.$user->ime.'</td>
                            <td>'.$user->prezime.'</td>
                            <td>'.$user->email.'</td>
                            <td>'.$user->naziv.'</td>
                            <td>'.$user->datum.'</td>
                            <td>'.($user->aktivan==true ? "Da" : "Ne" ).'</td>
                            <td><img class="img-responsive" width="52" height="52" src="'.$user->slika.'"/></td>
                            <td><a class="testklasa btn btn-info waves-effect btn-xs" onclick="testiram('.$user->id_user.');"><i class="material-icons">edit</i></a></td>
                            <td>
                                <a class="btn btn-danger waves-effect btn-xs" href="#" data-toggle="modal" data-target="#delete-modal'.$i.'">
                                    <i class="material-icons">delete_forever</i>
                                </a>
                                <div class="modal fade" id="delete-modal'.$i++.'" role="dialog">
                                    <div class="modal-dialog modal-sm text-center">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal">
                                                    &times;
                                                </button>
                                                <h4>Da li ste sigurni?</h4>
                                                <button type="button" class="btn btn-default error" onclick="deletion('.$user->id_user.',`'.$table.'`);">
                                                    Obriši
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>'
                    ;
                endforeach;
                echo '
                    </tbody>
                    </table>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                ';
            break;
            // User - Add ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            case "user_add":
                echo '    
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            <i class="material-icons icon_left">person</i> Korisnici<a href="admin.php"><i class="material-icons pull-right">keyboard_return</i><i class="pull-right go_back">Nazad</i></a>
                                            <small>Dodavanje korisnika</small>
                                        </h2>
                                    </div>
                                    <div class="body">
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-4">
                                                <p class="lead">Dodaj korisnika</p>
                                                <form action="modules/user_add.php" method="post" enctype="multipart/form-data" id="form_user_add">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input name="tbFN_user" id="tbFN_user" type="text" value="" class="form-control" placeholder="Ime"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input name="tbLN_user" id="tbLN_user" type="text" value="" class="form-control" placeholder="Prezime"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input name="tbEmail_user" id="tbEmail_user" type="email" value="" class="form-control" placeholder="E-mail"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input name="tbPass_user" id="tbPass_user" type="password" value="" class="form-control" placeholder="Lozinka"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <p><i>Uloga:</i></p>
                                                            <input id="rbRole_admin" name="rbRole_user" type="radio" value="1">
                                                            <label for="rbRole_admin"> Admin </label>
                                                            <input id="rbRole_usr" name="rbRole_user" type="radio" value="2">
                                                            <label for="rbRole_usr"> Korisnik </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <p><i>Aktivan:</i></p>
                                                            <input id="rbActive_yes" name="rbActive_user" type="radio" value="1">
                                                            <label for="rbActive_yes"> Da </label>
                                                            <input id="rbActive_no" name="rbActive_user" type="radio" value="2">
                                                            <label for="rbActive_no"> Ne </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="img_user"><p><i>Slika:</i></p></label>
                                                        <input type="file" name="img_user" id="img_user">
                                                        (max. 2MB)
                                                        <br/>
                                                    </div>
                                                    <div class="form-group">
                                                            <input name="tbHidden_user" id="tbHidden_user" type="hidden" value="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="btnUser_add" id="btnUser_add" value="UserAdd" class="btn btn-primary waves-effect waves-light">Dodaj</button>
                                                        <a href="admin.php" class="btn waves-effect">Otkaži</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            break;
            // Link - Show ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            case "link_show":
                $table = "link";
                $query = "SELECT * FROM $table ORDER BY pozicija";
                try{
                    $allLinks = sql_select_all($query);
                    if(!empty($allLinks)){
                        $code = 203;
                    }
                    else {
                        $code = 500;
                    }
                }
                catch (PDOException $ex){
                    $code = 500;
                }
                echo '
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            <i class="material-icons icon_left">link</i> Linkovi<a href="admin.php"><i class="material-icons pull-right">keyboard_return</i><i class="pull-right go_back">Nazad</i></a>
                                            <small>Prikaz svih linkova</small>
                                        </h2>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="" class="table table-striped">
                                            <thead>
                                                <tr class="info">
                                                    <th>Pozicija</th>
                                                    <th>Naziv</th>
                                                    <th>URL</th>
                                                    <th>Izmeni</th>
                                                    <th>Obriši</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                ';
                foreach ($allLinks as $link):
                        echo '
                    <tr>
                        <td>'.$link->pozicija.'</td>
                        <td>'.$link->naslov.'</td>
                        <td>'.$link->url.'</td>
                        <td><a class="testklasa btn btn-info waves-effect btn-xs" onclick="testiram('.$link->id.');"><i class="material-icons">edit</i></a></td>
                        <td>
                            <a class="btn btn-danger waves-effect btn-xs" href="#" data-toggle="modal" data-target="#delete-modal'.$i.'">
                                <i class="material-icons">delete_forever</i>
                            </a>
                            <div class="modal fade" id="delete-modal'.$i++.'" role="dialog">
                                <div class="modal-dialog modal-sm text-center">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <button type="button" class="close" data-dismiss="modal">
                                                &times;
                                            </button>
                                            <h4>Da li ste sigurni?</h4>
                                            <button type="button" class="btn btn-default error" onclick="deletion('.$link->id.',`'.$table.'`);">
                                                Obriši
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>';
                endforeach;
                echo '
                    </tbody>
                    </table>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                ';
            break;
            // Link - Add ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            case "link_add":
                echo '
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            <i class="material-icons icon_left">link</i> Linkovi<a href="admin.php"><i class="material-icons pull-right">keyboard_return</i><i class="pull-right go_back">Nazad</i></a>
                                            <small>Dodavanje linkova</small>
                                        </h2>
                                    </div>
                                    <div class="body">
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-4">
                                                <p class="lead">Dodaj link</p>
                                                <form action="modules/link_add.php" method="post" id="form_link_add">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input name="tbPos_link" id="tbPos_link" type="number" value="" class="form-control" placeholder="Pozicija">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input name="tbTitle_link" id="tbTitle_link" type="text" value="" class="form-control" placeholder="Naziv">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input name="tbURL_link" id="tbURL_link" type="url" value="" class="form-control" placeholder="URL">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="btnLink_add" id="btnLink_add" value="LinkAdd" class="btn btn-primary waves-effect waves-light">Dodaj</button>
                                                        <a href="admin.php" class="btn waves-effect">Otkaži</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>  
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            break;
            // Post - Show ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            case "post_show":
                $table = "post";
                $query = "SELECT * FROM $table ORDER BY datum DESC";
                try{
                    $allPosts = sql_select_all($query);
                    if(!empty($allPosts)){
                        $code = 203;
                    }
                    else {
                        $code = 500;
                    }
                }
                catch (PDOException $ex){
                    $code = 500;
                }
                echo '
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            <i class="material-icons icon_left">border_color</i> Postovi<a href="admin.php"><i class="material-icons pull-right">keyboard_return</i><i class="pull-right go_back">Nazad</i></a>
                                            <small>Prikaz svih postova</small>
                                        </h2>
                                    </div>
                                    <br/>
                ';
                foreach ($allPosts as $post):
                    echo '
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                                '.$post->naslov.'
                                            </h2>
                                            <ul class="header-dropdown m-r--5">
                                                <li class="dropdown">
                                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li><a href="admin-post-update.html">Izmeni</a></li>
                                                        <li><a href="#" data-toggle="modal" data-target="#delete-modal'.$i.'">Obriši</a></li>
                                                    </ul>
                                                    <div class="modal fade" id="delete-modal'.$i++.'" role="dialog">
                                                        <div class="modal-dialog modal-sm text-center">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <button type="button" class="close" data-dismiss="modal">
                                                                        &times;
                                                                    </button>
                                                                    <h4>Da li ste sigurni?</h4>
                                                                    <button type="button" class="btn btn-default error" onclick="deletion('.$post->id.',`'.$table.'`);">
                                                                        Obriši
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="body">
                                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                                <li role="presentation" class="active"><a href="#'.$post->id.'c" data-toggle="tab">Sadržaj</a></li>
                                                <li role="presentation"><a href="#'.$post->id.'s" data-toggle="tab">Slika</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane fade in active" id="'.$post->id.'c">
                                                    <p>
                                                        '.$post->tekst.'
                                                    </p>
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="'.$post->id.'s">
                                                    <img class="img img-responsive" width="300" src="'.$post->slika.'" alt="slika_na_postu">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                ';
                endforeach;
                echo '
                    </div>
                    </div>
                    </div>
                    </div>
                ';
            break;
            // Post - Add ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            case "post_add":
                echo '
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            <i class="material-icons icon_left">border_color</i> Postovi<a href="admin.php"><i class="material-icons pull-right">keyboard_return</i><i class="pull-right go_back">Nazad</i></a>
                                            <small>Dodavanje postova</small>
                                        </h2>
                                    </div>
                                    <div class="body">
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-4">
                                                <p class="lead">Dodaj post</p>
                                                <form action="modules/post_add.php" method="post" enctype="multipart/form-data" id="form_post_add">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input name="tbTitle_post" id="tbTitle_post" type="text" value="" class="form-control" placeholder="Naslov">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <textarea name="taTekst_post" id="taTekst_post" type="text" class="form-control" placeholder="Tekst" rows="15"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="img_post"><i>Slika:</i></label>
                                                        <input type="file" name="img_post" id="img_post">
                                                        (max. 2MB)
                                                        <br/>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="btnPost_add" id="btnPost_add" value="PostAdd" class="btn btn-primary waves-effect waves-light">Dodaj</button>
                                                        <a href="admin.php" class="btn waves-effect">Otkaži</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            break;
            // Gallery - Show ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            case "gallery_show":
                $table = "galerija";
                $query = "SELECT * FROM $table";
                try{
                    $allImgs = sql_select_all($query);
                    if(!empty($allImgs)){
                        $code = 203;
                    }
                    else {
                        $code = 500;
                    }
                }
                catch (PDOException $ex){
                    $code = 500;
                }
                echo '
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            <i class="material-icons icon_left">photo_library</i> Galerija<a href="admin.php"><i class="material-icons pull-right">keyboard_return</i><i class="pull-right go_back">Nazad</i></a>
                                            <small>Prikaz svih slika</small>
                                        </h2>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="" class="table table-striped">
                                            <thead>
                                                <tr class="info">
                                                    <th>Naslov</th>
                                                    <th>Alt</th>
                                                    <th>Slika</th>
                                                    <th>Izmeni</th>
                                                    <th>Obriši</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                ';
                foreach ($allImgs as $img):
                    echo '
                        <tr>
                            <td>'.$img->naslov.'</td>
                            <td>'.$img->alt.'</td>
                            <td><img class="img-responsive" width="100" src="'.$img->putanja.'"/></td>
                            <td><a class="testklasa btn btn-info waves-effect btn-xs" onclick="testiram('.$img->id.');"><i class="material-icons">edit</i></a></td>
                            <td>
                                <a class="btn btn-danger waves-effect btn-xs" href="#" data-toggle="modal" data-target="#delete-modal'.$i.'">
                                    <i class="material-icons">delete_forever</i>
                                </a>
                                <div class="modal fade" id="delete-modal'.$i++.'" role="dialog">
                                    <div class="modal-dialog modal-sm text-center">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal">
                                                    &times;
                                                </button>
                                                <h4>Da li ste sigurni?</h4>
                                                <button type="button" class="btn btn-default error" onclick="deletion('.$img->id.',`'.$table.'`);">
                                                    Obriši
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    ';
                endforeach;
                echo '
                    </tbody>
                    </table>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                ';
            break;
            // Gallery - Add ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            case "gallery_add":
                echo '
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            <i class="material-icons icon_left">photo_library</i> Galerija<a href="admin.php"><i class="material-icons pull-right">keyboard_return</i><i class="pull-right go_back">Nazad</i></a>
                                            <small>Dodavanje slika</small>
                                        </h2>
                                    </div>
                                    <div class="body">  
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-4">
                                                <p class="lead">Dodaj sliku</p>
                                                <form action="modules/gallery_add.php" method="post" enctype="multipart/form-data" id="form_gallery_add">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input name="tbTitle_gallery" id="tbTitle_gallery" type="text" value="" class="form-control" placeholder="Naslov">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input name="tbAlt_gallery" id="tbAlt_gallery" type="text" value="" class="form-control" placeholder="Alt">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="img_gallery"><i>Slika:</i></label>
                                                        <input type="file" name="img_gallery" id="img_gallery">
                                                        (max. 2MB)
                                                        <br/>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="btnGallery_add" id="btnGallery_add" value="GalleryAdd" class="btn btn-primary waves-effect waves-light">Dodaj</button>
                                                        <a href="admin.php" class="btn waves-effect">Otkaži</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>   
                                    </div>                                
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            break;
            // Pool - Show ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            case "pool_show":
                $table = "anketa_pitanje";
                $query = "SELECT * FROM $table";
                try{
                    $allPools = sql_select_all($query);
                    if(!empty($allPools)){
                        $code = 203;
                    }
                    else {
                        $code = 500;
                    }
                }
                catch (PDOException $ex){
                    $code = 500;
                }
                echo '
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            <i class="material-icons icon_left">question_answer</i> Ankete<a href="admin.php"><i class="material-icons pull-right">keyboard_return</i><i class="pull-right go_back">Nazad</i></a>
                                            <small>Prikaz svih anketa</small>
                                        </h2>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="" class="table table-striped">
                                            <thead>
                                                <tr class="info">
                                                    <th>Pitanje</th>
                                                    <th>Aktivna</th>
                                                    <th>Izmeni</th>
                                                    <th>Obriši</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                ';
                foreach ($allPools as $pool):
                    echo '
                        <tr>
                            <td>'.$pool->tekst.'</td>
                            <td>'.($pool->aktivna==true ? "Da" : "Ne").'</td>
                            <td><a class="testklasa btn btn-info waves-effect btn-xs" onclick="testiram('.$pool->id.');"><i class="material-icons">edit</i></a></td>
                                                        <td>
                                <a class="btn btn-danger waves-effect btn-xs" href="#" data-toggle="modal" data-target="#delete-modal'.$i.'">
                                    <i class="material-icons">delete_forever</i>
                                </a>
                                <div class="modal fade" id="delete-modal'.$i++.'" role="dialog">
                                    <div class="modal-dialog modal-sm text-center">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal">
                                                    &times;
                                                </button>
                                                <h4>Da li ste sigurni?</h4>
                                                <button type="button" class="btn btn-default error" onclick="deletion('.$pool->id.',`'.$table.'`);">
                                                    Obriši
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    ';
                endforeach;
                echo '
                    </tbody>
                    </table>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                ';
            break;
            // Pool - Add ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            case "pool_add":
                echo '
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            <i class="material-icons icon_left">question_answer</i> Ankete<a href="admin.php"><i class="material-icons pull-right">keyboard_return</i><i class="pull-right go_back">Nazad</i></a>
                                            <small>Dodavanje anketa</small>
                                        </h2>
                                    </div>
                                    <div class="body"> 
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-4">
                                                <p class="lead">Dodaj anketu</p>
                                                <form action="modules/pool_add.php" method="post" id="form_pool_add">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input name="tbQuestion_pool" id="tbQuestion_pool" type="text" value="" class="form-control" placeholder="Pitanje">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input name="tbAnswer_pool" id="tbAnswer_pool" type="text" value="" class="form-control" placeholder="Odgovor 1">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input name="tbAnswer_pool" id="tbAnswer2_pool" type="text" value="" class="form-control" placeholder="Odgovor 2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input name="tbAnswer_pool" id="tbAnswer3_pool" type="text" value="" class="form-control" placeholder="Odgovor 3">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <p><i>Aktivna:</i></p>
                                                            <input id="rbActive_pool_yes" name="rbActive_pool" type="radio">
                                                            <label for="rbActive_pool_yes"> Da </label>
                                                            <input id="rbActive_pool_no" name="rbActive_pool" type="radio">
                                                            <label for="rbActive_pool_no"> Ne </label>
                                                    </div>
                                                    <blockquote class="small">
                                                        Samo poslednje označena aktivna anketa će se prikazati
                                                    </blockquote>
                                                    <div class="form-group">
                                                        <button type="submit" name="btnPool_add" id="btnPool_add" value="PoolAdd" class="btn btn-primary waves-effect waves-light">Dodaj</button>
                                                        <a href="admin.php" class="btn waves-effect">Otkaži</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            break;
        }
    }
    else {
        $code = 404;
    }
    http_response_code($code);