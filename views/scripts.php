        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/lightbox.min.js"></script>
        <script src="js/jquery-validation/jquery.validate.js"></script>
        <script src="js/jquery-validation/additional-methods.js"></script>
        <script src="js/jquery-validation/localization/messages_sr_lat.js"></script>
        <script src="js/front.js"></script>
        <script src="js/validation.js"></script>
        <script src="js/ajax.js"></script>
        
        <?php
            if($ip_guest) {
                echo "<script>
                            $('#vote_msg').html('Hvala što ste glasali');
                            $('#btnVote').css('display', 'none');
                            $(':radio').css('display', 'none');
                            $('.vote_info').css('display', 'block');
                      </script>";
            }
        ?>
        
    </body>
</html>