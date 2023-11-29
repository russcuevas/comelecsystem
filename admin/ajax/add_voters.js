// ADD VOTERS FUNCTIONALITY
$(document).ready(function () {
    $("#add-form").submit(function (event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "functions/add_voters.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);

                if (response.status === "success") {
                    HoldOn.open({
                        theme: "sk-rect",
                        message: "Please wait...",
                        textColor: "#fff",
                        element: document.body,
                    });
                    Swal.fire({
                        icon: "success",
                        iconColor: '#242943',
                        title: "New voters added successfully",
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    setTimeout(function () {
                        HoldOn.close();
                    }, 2000);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Can't add new voters",
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                }
            },
            error: function (errorThrown) {
                alert("Error: " + errorThrown);
            }
        });
    });
});
