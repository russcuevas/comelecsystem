$(document).ready(function () {
    $("#login-form").submit(function (event) {
        event.preventDefault();

        var formData = $(this).serialize();

        if ($('input[name="email"]').val() === '' || $('input[name="password"]').val() === '') {
            Swal.fire({
                icon: "warning",
                title: "Please fill up all fields",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
            });
            return;
        }

        $.ajax({
            type: "POST",
            url: "functions/login.php",
            data: formData,
            success: function (response) {

                if (response === "success") {
                    window.location.href = "logged_in.php";
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Incorrect email / password",
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                }
            },
        });
    });
});
