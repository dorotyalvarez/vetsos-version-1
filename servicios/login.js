$("#login_button").on("click", function() {

    var user_name = $("#user_name").val();
    var pass = $("#pass").val();
    alert(user_name); //this is working fine.
    if (user_name == '' || pass == '') {
        alert("LOS DOS CAMPOS REQUERIDOS");
    } else {
        $.ajax({
            url: 'controllers/login_ajax_controllers.php',
            method: 'POST',
            data: {
                user: user_name,
                pwd: pass
            },
            success: function(data) {
                if (data == '1') {
                    location.href = "index.html";
                } else {

                }
                $("#message").html(data);
            }
        })
    }
});