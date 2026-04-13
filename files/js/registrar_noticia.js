// =============================================
//   registrar_noticia.js
// =============================================

// --------------------------------------------------
//  Vista previa de la imagen antes de subir
// --------------------------------------------------
function previsualizarImagen() {
  const file = document.getElementById("image").files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = function (e) {
    document.getElementById("preview-img").src = e.target.result;
    document.getElementById("preview-container").style.display = "block";
  };
  reader.readAsDataURL(file);
}

// --------------------------------------------------
//  Subir imagen al servidor y luego registrar
// --------------------------------------------------
function imagenes() {
  var formData = new FormData();
  var file = $("#image")[0].files[0];

  if (!file) return;

  formData.append("file", file);

  $.ajax({
    url: "ruta_img_noticia.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      // Validar formato de imagen
      if (response.trim() == "775") {
        Swal.fire({
          icon: "error",
          title: "Formato no permitido",
          text: "La imagen que intentas subir no cumple el formato permitido (JPG, JPEG, PNG).",
        });
        $("#image").val("");
        document.getElementById("preview-container").style.display = "none";
        return;
      }

      var rutaCompleta = JSON.parse(response);

      // Registrar al hacer submit
      $("#formulario")
        .off("submit")
        .on("submit", function (e) {
          e.preventDefault();

          const postData = {
            rutaCompleta: rutaCompleta,
          };

          $.post("comprobar_noticia.php", postData, function (res) {
            var x = res.trim();

            if (x === "0923") {
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "No se realizó la conexión con la base de datos.",
              });
            } else if (x === "2309") {
              Swal.fire({
                icon: "success",
                title: "¡Noticia registrada con éxito!",
                showConfirmButton: false,
                timer: 2000,
              }).then(() => {
                location.reload();
              });

              $("#formulario")[0].reset();
              document.getElementById("preview-container").style.display =
                "none";
            } else {
              Swal.fire({
                icon: "warning",
                title: "Respuesta inesperada",
                text: "Ocurrió algo inesperado, intenta de nuevo.",
              });
            }
          });
        });
    },
    error: function () {
      Swal.fire({
        icon: "error",
        title: "Error de servidor",
        text: "No se pudo conectar con el servidor para subir la imagen.",
      });
    },
  });
}
