$(document).ready(function () {
    $("#btnVote").on("click", voting);
    $("#btnComment_add").on("click", comment_add);
    $("#profile-image").on("click", function() {
        $("#profile-image-upload").click();
    });
});

function reload() {
    setTimeout(location.reload.bind(location), 1);
    let lastComment = $(".comment").last();
    $('html, body').animate({
        scrollTop: lastComment.offset().top
    }, 1);
}

// Voting ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function voting() {
    let answer = $("input[name='pool']:checked").val();
    let btn = $("#btnVote").val();
    let pool = $("#pool");

    if(answer == null) {
        $("#vote_msg").html("Izaberite opciju!").css("display", "block");
    }
    else {
        $.ajax({
            type: "post",
            url: "http://letjovanje.dx.am/modules/ajax_voting.php",
            data: {
                answer: answer,
                btn: btn
            },
            success: function () {
                setTimeout(location.reload.bind(location), 1);
                $('html, body').animate({
                    scrollTop: pool.offset().top
                }, 1);
            },
            error: function (message) {
                $("#vote_msg").html(message.responseText);
                $(".vote_info").css("display", "block");
            }
        });
    }
}

// Comment - Add ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function comment_add() {
    let text = $("#taText_comment").val();
    let idPost = $("#hdnIdPost_comment").val();
    let idUser = $("#hdnIdUser_comment").val();
    let btn = $("#btnComment_add").val();

    let imgUser = $("#hdnImgUser_comment").val();
    let FNUser = $("#hdnFNUser_comment").val();
    let LNUser = $("#hdnLNUser_comment").val();
    let cDate = $("#hdnDate_comment").val();
    let idComment = $("#hdnId_comment").val();

    reText = /^[\wĆČŽĐŠćčžđš .,!(\?)':"-]{2,}$/;

    if(!text.match(reText)){
        $(".comment-form").prepend("<div id='infobox' class='alert alert-info alert-dismissable' role='alert'>Komentar nije u dobrom formatu!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>");
    }
    else{
        $.ajax({
            type: "post",
            url: "http://letjovanje.dx.am/modules/ajax_comment_add.php",
            data: {
                text: text,
                idPost : idPost,
                idUser : idUser,
                btn : btn,
                imgUser : imgUser,
                FNUser : FNUser,
                LNUser : LNUser,
                cDate : cDate,
                idComment : idComment
            },
            success: function (data) {
                let lastComment = $(".comment").last();
                $("#numCom h4").html("Komentari:");
                if(lastComment.length > 0) {
                    lastComment.after(data);
                }
                else {
                    $("#comment_data").append(data);
                }
                reload();
            },
            error: function (message) {
                $(".comment-form").prepend("<div id='infobox' class='alert alert-info alert-dismissable' role='alert'>"+message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>");
            }
        });
    }
}

// Comment - Delete ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function delete_comment(id_comment, id_user) {
    $.ajax({
        type: "post",
        url: "http://letjovanje.dx.am/modules/ajax_comment_delete.php",
        data: {
            idComment : id_comment,
            idUser : id_user,
            flag : "sent"
        },
        success: function () {
            reload();
        },
        error: function (message) {
            $(this).prepend("<div id='infobox' class='alert alert-info alert-dismissable' role='alert'>"+message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>");
        }
    });
}

// Registration ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function regCheck() {
    let firstName = $("#tbFN_reg").val();
    let lastName = $("#tbLN_reg").val();
    let email = $("#tbEmail_reg").val();
    let pass = $("#tbPass_reg").val();
    let btn = $("#btnReg").val();

    let reFirstName = /^[A-ZĆČŽĐŠ][a-zćčžđš]{2,59}$/;
    let reLastName = /^[A-ZĆČŽĐŠ][a-zćčžđš]{2,79}$/;
    let reEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let rePass = /^[\w~_!@#$%^&*(),.?:{}|<>=-]{5,}$/;

    let errors = [];

    if(!firstName.match(reFirstName)){
        errors.push("Ime nije u dobrom formatu!");
    }
    if(!lastName.match(reLastName)){
        errors.push("Prezime nije u dobrom formatu!");
    }
    if(!email.match(reEmail)){
        errors.push("E-mail nije u dobrom formatu!");
    }
    if(!pass.match(rePass)){
        errors.push("Lozinka mora imati bar 5 karaktera!");
    }

    if(errors.length > 0){
        let list = "<ul>";
        $.each(errors, function (index, value) {
            list += "<li>"+value+"</li>";
        });
        list += "</ul>";
        $("#info").html(list).addClass("error");
    }
    else{
        $.ajax({
            type: "post",
            url: "http://letjovanje.dx.am/modules/ajax_register.php",
            data: {
                firstName : firstName,
                lastName : lastName,
                email : email,
                pass : pass,
                btn : btn
            },
            success: function (message) {
                $("#infoReg").removeClass("error").html(message);
            },
            error: function (message) {
                $("#infoReg").addClass("error").html(message);
            }
        });
    }
}


// Contact ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function conCheck() {
    let firstName = $("#tbFN_contact").val();
    let lastName = $("#tbLN_contact").val();
    let email = $("#tbEmail_contact").val();
    let title = $("#tbTitle_contact").val();
    let msg = $("#taMsg_contact").val();
    let btn = $("#btnContact").val();

    let reFirstName = /^[A-ZĆČŽĐŠ][a-zćčžđš]{2,59}$/;
    let reLastName = /^[A-ZĆČŽĐŠ][a-zćčžđš]{2,79}$/;
    let reEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let reTitle = /^[\wĆČŽĐŠćčžđš .,!(\?)':"-]{2,50}$/;
    let reMsg = /^[\wĆČŽĐŠćčžđš .,!(\?)':"-]{2,}$/;

    let errors = [];

    if(!firstName.match(reFirstName)){
        errors.push("Ime nije u dobrom formatu!");
    }
    if(!lastName.match(reLastName)){
        errors.push("Prezime nije u dobrom formatu!");
    }
    if(!email.match(reEmail)){
        errors.push("E-mail nije u dobrom formatu!");
    }
    if(!title.match(reTitle)){
        errors.push("Naslov nije u dobrom formatu!");
    }
    if(!msg.match(reMsg)){
        errors.push("Poruka nije u dobrom formatu!");
    }

    if(errors.length > 0){
        let list = "<ul>";
        $.each(errors, function (index, value) {
            list += "<li>"+value+"</li>";
        });
        list += "</ul>";
        $("#infoContact").html(list).addClass("error");
    }
    else{
        $.ajax({
            type: "post",
            url: "http://letjovanje.dx.am/modules/ajax_contact.php",
            data: {
                firstName : firstName,
                lastName : lastName,
                email : email,
                title : title,
                msg : msg,
                btn : btn
            },
            success: function (message) {
                $("#contactInfo").removeClass("error").html(message);
            },
            error: function (message) {
                $("#contactInfo").addClass("error").html(message);
            }
        });
    }
}