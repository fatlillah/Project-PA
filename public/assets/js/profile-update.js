$(document).ready(function() {
    $("#profile_image").change(function(){
        let reader = new FileReader();

        reader.onload = function (e) {
            $('#image_preview_container').attr('src', e.target.result);
            $('#header_profile_image').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    });

    $("#profile_setup_frm").submit(function(e){
        e.preventDefault();

        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#btn").attr("disabled", true).html("Updating...");
        
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.code == 200) {
                    let success = '<span class="alert alert-success">'+response.msg+'</span>';
                    $("#res").html(success);
                } else {
                    let error = '<span class="alert alert-danger">'+response.msg+'</span>';
                    $("#res").html(error);
                }
                $("#btn").attr("disabled", false).html("Save Profile");
            },
            error: function(xhr, textStatus, errorThrown) {
                let errors = xhr.responseJSON.errors;
                let errorHtml = '<span class="alert alert-danger">';

                $.each(errors, function(key, value){
                    errorHtml += value + '<br>';
                });

                errorHtml += '</span>';

                $("#res").html(errorHtml);
                $("#btn").attr("disabled", false).html("Save Profile");
            }
        });
    });
});
