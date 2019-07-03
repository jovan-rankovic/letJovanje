$(document).ready(function () {
    $(".link_show_all").on("click", switch_page);
});

function infobox(error_array){
    $("#content").prepend("<div id='infobox' class='alert alert-info alert-dismissable' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>");
    $.each(error_array, function (i, value){
        $("#infobox").append(" ~~ "+value);
    });
    $("#infobox").append("</div>");
    $("html, body").scrollTop(0);
}

function infobox_and_refresh(message) {
    $("#content").prepend("<div class='alert alert-info'>"+message+"</div>");
    $("html, body").scrollTop(0);
    setTimeout(location.reload.bind(location), 1555);
}

// Sidebar links ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function switch_page() {
    let selectedLink = $(this).data("link");

    $.ajax({
        type: "post",
        url: "http://letjovanje.dx.am/modules/ajax_switch_page.php",
        data: {
            link : selectedLink,
            flag : "sent"
        },
        dataType: "html",
        success: function (data) {
            $("#content").html(data);
        },
        error: function (message) {
            infobox_and_refresh(message.statusText);
        }
    });
}

// Delete ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function deletion(selected_id, selected_table) {
    $.ajax({
        type: "post",
        url: "http://letjovanje.dx.am/modules/ajax_delete.php",
        data: {
            id : selected_id,
            table : selected_table,
            flag : "sent"
        },
        success: function () {
            infobox_and_refresh("Brisanje uspešno!");
        },
        error: function (message) {
            infobox_and_refresh(message.statusText);
        }
    });
}