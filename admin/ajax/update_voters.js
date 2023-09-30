// UPDATE VOTERS FUNCTIONALITY
$(document).ready(function(){
    $("#update-form").submit(function(event){
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "functions/update_voters.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                console.log(response);

                if (response.status === "success"){
                    Swal.fire({
                        icon: "success",
                        title: "Voters Updated successfully",
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Not updated successfully",
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                }
            },
            error: function(errorThrown){
                alert("Error: " + errorThrown);
            }
        })
    })
});