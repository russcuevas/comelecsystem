$(document).ready(function () {
    $("#forgot-password-form").submit(function (e) {
        e.preventDefault();

        var email = $("#forgot-email").val();
        $("#loading-container").show();

        $.ajax({
            type: "POST",
            url: "functions/forgot_password.php",
            data: { "forgot-email": email },
            dataType: "json",
            success: function (response) {
                $("#loading-container").hide();
                if (response.status === "success") {
                    Swal.fire({
                        icon: "success",
                        iconColor: '#337ab7',
                        title: "Password reset email sent successfully.",
                        showConfirmButton: true,
                        confirmButtonColor: '#337ab7',
                    }).then(function(){
                        location.reload();
                    });
                } else if (response.status === "email_not_found") {
                    Swal.fire({
                        icon: "error",
                        title: "Email not existing",
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Email not existing",
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: "error",
                    title: "An error occurred. Please try again later.",
                });
            },
        });
    });
});
