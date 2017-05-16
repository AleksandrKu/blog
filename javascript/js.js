$(function () {
    function stringlength(field, mnlen, mxlen)
    {
      if((field.length < mnlen) || (field.length > mxlen))
        {
            return false;
        }
    else
        {
            return true;
        }
    }
    

    $("#name").on("blur", function () {
        var name_v = $("#name").val();
        if (stringlength(name_v, 3, 30)) {
            $("#result-name").text("");
        } else {
            $("#result-name").text("Input the name between 3 and 30 characters.");
            $("#result-name").css("color", "red");
        }
    });



$("#message").on("blur", function () {
    var message_v = $("#message").val();
    if (stringlength(message_v, 5, 500)) {
        $("#result-message").text("");
    } else {
        $("#result-message").text("Message must be  from 5 to 500 characters.");
        $("#result-message").css("color", "red");
    }
    return false;
});



    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    $("#email").on("blur", function () {
        var email_v = $("#email").val();
        if (validateEmail(email_v)) {
            $("#result").text("");
        } else {
            $("#result").text(email_v + " isn't valid еmail.");
            $("#result").css("color", "red");
        }
        return false;
    });


    $('#contactForm').submit(function (event) {
        event.preventDefault();
        var formValid = true;
        // sort through all form controls (input and textarea)
        $('#contactForm input,textarea').each(function () {
            // validation with  HTML5
            if (this.checkValidity()) {
                formValid = true;
            } else {
                formValid = false;
            }
        });
        if (formValid) {
            var name = $("#name").val();
            var email = $("#email").val();
            var message = $("#message").val();
            var id_article = $(".id_article").attr('id');
            var data_for_send = "name=" + name + "&email=" + email + "&message=" + message + "&id_article=" + id_article;

            $.ajax({
                type: "POST",
                url: "check-comment.php",
                data: data_for_send,
                cache: false,
                success: function (data) {
                    var data_object = JSON.parse(data);
                    if (data_object.result == "success") {
                        // clear the form of the message
                        $('#message').val('');
                        // delete class hidden from id=successMessage,
                        $('#successMessage').removeClass('hidden');

                        $.ajax({
                            type: "POST",
                            url: "comments.php",
                            data: "id="+id_article,
                            success: function (prin) {
                                console.log(prin);
                                $("#comments").html(prin);
                            }
                        });

                    }
                },
                error: function (request) {
                    $('#error').text('Error ' + request.responseText + ' when sending data.');
                }
            });



        }
    });

});