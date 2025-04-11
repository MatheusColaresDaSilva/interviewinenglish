$("#contactForm").on("submit", function (e) {
    e.preventDefault();

    var name = $("#name").val();
    var email = $("#email").val();
    var message = $("#message").val();

    $.ajax({
        url: "backend.php",
        type: "POST",
        dataType: "json",
        data: {
            name: name,
            email: email,
            message: message,
            "g-recaptcha-response": grecaptcha.getResponse()
        },
        success: function (res) {
            if (res.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: res.message,
                    confirmButtonColor: '#3085d6',
                    timer: 3000,
                    timerProgressBar: true
                });
                $("#contactForm")[0].reset();
                grecaptcha.reset(); 
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Ops...',
                    text: res.message,
                    confirmButtonColor: '#d33'
                });
            }
        },
        error: function (xhr, status, error) {
            console.log(error);
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Error sending the form. Please try again.',
                footer: '<code>' + error + '</code>',
                confirmButtonColor: '#d33'
            });
        }
    });
});
