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

                    setTimeout(function () {
                        HoldOn.close();

                        Swal.fire({
                            icon: "success",
                            iconColor: '#242943',
                            title: "New voters added successfully",
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2000,
                        }).then(function () {
                            $("#employeeModal").modal("hide");
                            setTimeout(function () {
                                location.reload();
                            }, 500);
                        });
                    }, 1000);
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
