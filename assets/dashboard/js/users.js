// MODAL WHEN CLICK
$("#employeeModalBtn").click(function () {
    $("#employeeModal").modal("show");
});

$("#addEmployeeBtn").click(function () {
    var name = $("#name").val();
    var department = $("#department").val();
    var position = $("#position").val();

    $("#employeeModal").modal("hide");
});

// UPLOADING IMAGE
document
    .getElementById("profile_picture")
    .addEventListener("change", function () {
        const fileInput = this;
        const previewImage = document.getElementById("preview");

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.style.display = "block";
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    });

flatpickr("#birthday", {
    dateFormat: "Y-m-d",
});
