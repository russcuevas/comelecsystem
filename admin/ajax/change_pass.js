$(document).ready(function () {
    $('#change-pass').submit(function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "functions/update_profile.php",
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    HoldOn.open({
                        theme: 'sk-rect',
                        message: 'Please wait...',
                    });
                }

                if (response.status === 'success') {
                    Swal.fire({
                        icon: "success",
                        iconColor: '#337ab7',
                        title: response.message,
                        timer: 1500,
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                    }).then(function () {
                        $('#password').val('');
                        $('#confirm_password').val('');
                    });

                    HoldOn.close();
                } else if (response.status === 'warning') {
                    Swal.fire({
                        icon: 'warning',
                        title: response.message,
                        timer: 3000,
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: response.message,
                        timer: 3000,
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error during ajax request',
                    timer: 3000,
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                });
            }
        });
    });
});
