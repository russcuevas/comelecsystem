// DELETE VOTERS FUNCTIONALITY
$(document).ready(function () {
        $(".delete-voter-link").on("click", function () {
            const voterId = $(this).data("delete-voter-id");
            const deleteUrl = "delete_registered_voters.php?id=" + voterId;
            $("#confirmDelete").attr("data-delete-url", deleteUrl);
        });

        $("#confirmDelete").on("click", function () {
            const deleteUrl = $(this).attr("data-delete-url");

            $.get(deleteUrl, function (response) {
                if (response === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Voter successfully deleted",
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
                        text: "Failed to delete voter",
                    });
                }
            });

            $("#deleteModal").modal("hide");
        });
    });