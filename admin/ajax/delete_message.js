// DELETING MESSAGE
$(document).ready(function () {
    $(".delete-message").on("click", function () {
        const messageId = $(this).data("delete-message-id");
        const deleteUrl = "delete_message.php?id=" + messageId;
        $("#confirmDelete").attr("data-delete-url", deleteUrl);
    });

    $("#confirmDelete").on("click", function () {
        const deleteUrl = $(this).attr("data-delete-url");

        $.get(deleteUrl, function (response) {
            console.log(response);

            try {
                response = JSON.parse(response);

                if (response.status === "success") {
                    Swal.fire({
                        icon: "success",
                        iconColor: '#242943',
                        title: response.message,
                        timer: 3000,
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                    });

                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message,
                    });
                }
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "An error occurred while processing your request.",
                });
            }
        });

        $("#deleteModal").modal("hide");
    });
});
