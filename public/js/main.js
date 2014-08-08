function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}

$(document).ready(function() {

    $(document).on("click", "#btnLogin", function(e) {
        var error = "<div class='alert alert-danger alert-block'><button data-dismiss='alert' class='close' type='button'>×</button><h4>Error</h4>";
        if ($('#email').val() == '') {
            error = error + "Please enter your email address</div>";
            $('#response').html(error);
            return;
        }
        else if (!validateEmail($('#email').val())) {
            error = error + "Please enter valid email address</div>";
            $('#response').html(error);
            return;
        }

        if ($('#password').val() == '') {
            error = error + "Please enter your password</div>";
            $('#response').html(error);
            return;
        }

        var postData = $("#loginForm").serializeArray();
        var formURL = $("#loginForm").attr("action");
        $.ajax(
                {
                    url: formURL,
                    type: "POST",
                    data: postData,
                    success: function(data, textStatus, jqXHR)
                    {
                        if (data == 'success') {
                            location.href = 'users/dashboard';
                        }
                        else {
                            $('#response').html(data);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        //if fails     
                    }
                });
        e.preventDefault(); //STOP default action

    });

    $(document).on("click", "#btnRegister", function(e) {

        var error = "<div class='alert alert-danger alert-block'><button data-dismiss='alert' class='close' type='button'>×</button><h4>Error</h4>";
        if ($('#fname').val() == '') {
            error = error + "Please enter your first name</div>";
            $('#response').html(error);
            return;
        }
        if ($('#lname').val() == '') {
            error = error + "Please enter your last name</div>";
            $('#response').html(error);
            return;
        }
        if ($('#email').val() == '') {
            error = error + "Please enter your email address</div>";
            $('#response').html(error);
            return;
        }
        else if (!validateEmail($('#email').val())) {
            error = error + "Please enter valid email address</div>";
            $('#response').html(error);
            return;
        }

        if ($('#password').val() == '') {
            error = error + "Please enter your password</div>";
            $('#response').html(error);
            return;
        }

        if ($('#cpassword').val() == '') {
            error = error + "Please enter your confirm password</div>";
            $('#response').html(error);
            return;
        }

        var postData = $("#registerForm").serializeArray();
        var formURL = $("#registerForm").attr("action");
        $.ajax(
                {
                    url: formURL,
                    type: "POST",
                    data: postData,
                    success: function(data, textStatus, jqXHR)
                    {
                        if (data == 'success') {
                            location.href = '/thankyou';
                        }
                        else {
                            $('#response').html(data);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        //if fails     
                    }
                });
        e.preventDefault(); //STOP default action

    });
});