$(document).ready(function () {
  $("#emailForm").submit(function (event) {
    event.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "recuperar_contra_validar.php",
      data: formData,
      success: function (response) {
        console.log(response);
        let x = response.toString().trim();
        if (x == "2309") {
          window.location = "recuperar_contra_code.php";
        }

        if (x == "51") {
          swal(
            "Erro!",
            "Hubo un error al enviar el codigo de verificación, si el problema prevalece comunicate con asopaticas@asopaticas.com",
            "error",
          );
          $("#emailForm").trigger("reset");
        }

        if (x == "0925") {
          swal(
            "Correo invalido",
            "Este correo no se encuentra registrado",
            "error",
          );
          $("#emailForm").trigger("reset");
        }

        if (x == "0923") {
          swal(
            "Error!",
            "Hubo un error, si el problema prevalece comunicate con asopaticas@asopaticas.com",
            "error",
          );
          $("#emailForm").trigger("reset");
        }
      },
    });
  });
});
