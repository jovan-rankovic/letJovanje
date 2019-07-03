<?php
    if(isset($_POST["btn"])) {
        $text = $_POST["text"];
        $post_id = $_POST["idPost"];
        $user_id = $_POST["idUser"];

        $img_user = $_POST["imgUser"];
        $FN_user = $_POST["FNUser"];
        $LN_user = $_POST["LNUser"];
        $cDate = $_POST["cDate"];
        $comment_id = $_POST["idComment"];

        $reText = "/^[\wĆČŽĐŠćčžđš .,!(\?)':\"-]{2,}$/";

        if(!preg_match($reText, $text)) {
            echo "Komentar nije u dobrom formatu!";
            $code = 406;
        }
        else{
            require_once "connection.php";

            $query = "INSERT INTO komentar VALUES ('', :text, DEFAULT, :userId, :postId)";
            $ps = $connection->prepare($query);
            $ps->bindParam(":text",$text);
            $ps->bindParam(":userId",$user_id);
            $ps->bindParam(":postId",$post_id);

            try{
                $result = $ps->execute();
                if($result){
                    echo '
                        <div class="row comment">
                            <div class="col-sm-3 col-md-2 col-xs-2">
                                <p><img src="'.$img_user.'" width="150" height="150" class="img-responsive img-circle"></p>
                            </div>
                            <div class="col-sm-9 col-md-10">
                            
                            <button type="button" class="close" aria-label="Close" data-toggle="modal" data-target="#deleteWarning">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            
                            <div class="modal fade" id="deleteWarning" role="dialog">
                                <div class="modal-dialog modal-sm text-center">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <button type="button" class="close" data-dismiss="modal">
                                                &times;
                                            </button>
                                            <h4>Da li ste sigurni?</h4>
                                            <button type="button" class="btn btn-default error" onclick="delete_comment('.$comment_id.','.$user_id.');">
                                                Obriši
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                                <h5>'.$FN_user.' '.$LN_user.'</h5>
                                <p class="posted"><i class="fa fa-clock-o"></i> '.$cDate.' </p>
                                <p class="text-gray">'.$text.'</p>
                            </div>
                        </div>
                    ';
                }
                $code = 201;
            }
            catch (PDOException $ex){
                echo $ex->getCode();
                $code = 500;
            }
        }
    }
    else {
        $code = 404;
    }
    http_response_code($code);