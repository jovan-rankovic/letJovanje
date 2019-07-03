$(document).ready(function () {

    $("#form_modal").validate({
        rules: {
            tbEmail_modal: {
                required: true,
                email: true
            },
            tbPass_modal: {
                required: true,
                minlength: 5
            }
        }
    });
    
});