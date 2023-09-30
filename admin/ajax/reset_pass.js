$(document).ready(function () {
    $("#reset-password-form").submit(function (e) {
        e.preventDefault();

        var newPassword = $("#new-password").val();
        var confirmPassword = $("#confirm-password").val();

        if (newPassword === confirmPassword) {
            $.ajax({
                type: "POST",
                url: "functions/reset_password.php",
                data: {
                    token: $("input[name='token']").val(),
                    "new-password": newPassword,
                    "confirm-password": confirmPassword
                },
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        Swal.fire({
                            icon: "success",
                            iconColor: '#337ab7',
                            title: "Password Reset Successful",
                            text: "You can now log in with your new password.",
                            showConfirmButton: false,
                            timer: 2000,
                        }).then(function () {
                            window.location.href = 'login.php';
                        });
                    } else if (response.status === "token_expired") {
                        Swal.fire({
                            icon: "error",
                            title: "Password Reset Failed",
                            text: "The password reset link has expired. Please request a new one.",
                            showCancelButton: true,
                            confirmButtonText: "OK",
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                window.location.href = 'forgot_password.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Password Reset Failed",
                            text: "Please try again later.",
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: "error",
                        title: "An Error Occurred",
                        text: "Please try again later.",
                    });
                }
            });
        } else {
            Swal.fire({
                icon: "error",
                title: "Passwords Do Not Match",
                text: "Please make sure the passwords match.",
            });
        }
    });
});
