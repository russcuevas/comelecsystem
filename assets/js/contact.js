$(document).ready(function () {
    $("#contactForm").submit(function (event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "functions/contact.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);

                if (response.status === "success") {
                    $("#contactForm")[0].reset();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 2000,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                };
            }
        });
    });
});