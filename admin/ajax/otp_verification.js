$(document).ready(function () {
    $('#otp-form').submit(function (event) {
        event.preventDefault();

        var formData = $(this).serialize();

        if ($('input[name="email"]').val() === '' || $('input[name="otp"]').val() === '') {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Please fill up all fields'
            });
            return;
        };

        $.ajax({
            type: "POST",
            url: "otp_verification.php",
            data: formData,
            success: function (response) {
                console.log(response);

                if (response.status === "success") {
                    HoldOn.open({
                        theme: 'sk-rect',
                        message: 'Please wait...'
                    });

                    setTimeout(function () {
                        HoldOn.close();
                        window.location.href = 'dashboard';
                    }, 1000);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message,
                    });
                }
            }
        });
    });
});