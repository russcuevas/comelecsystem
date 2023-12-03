$(document).ready(function () {
    $("#login-form").submit(function (event) {
        event.preventDefault();

        var formData = $(this).serialize();

        if ($('input[name="email"]').val() === '' || $('input[name="password"]').val() === '') {
            Swal.fire({
                icon: "warning",
                title: "Warning",
                text: 'Please fill up all fields'
            });
            return;
        }

        $.ajax({
            type: "POST",
            url: "functions/login.php",
            data: formData,
            beforeSend: function () {
                HoldOn.open({
                    theme: 'sk-rect',
                    message: 'Please wait...'
                });
            },
            success: function (response) {
                console.log(response);

                if (response.status === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'otp_generation';
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message,
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "An error occurred during the request.",
                });
            },
            complete: function () {
                HoldOn.close();
            },
        });
    });
});
