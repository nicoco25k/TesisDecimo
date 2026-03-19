$(document).ready(function () {
  $("#codeform").submit(function (event) {
    event.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "recuperar_contra_validar_code.php",
      data: formData,
      success: function (response) {
        console.log(response);
        let x = response.toString().trim();

        if (x == "666") {
          swal("Código invalido", "Este código debe ser de 6 cifras", "error");
          $("#codeform").trigger("reset");
        } else if (x == "147") {
          swal("Código invalido", "Este código ya no funciona", "error");
          $("#codeform").trigger("reset");
        } else {
          $("#codeform").trigger("reset");

          var miVariable = x;

          // Crear un formulario oculto dinámicamente
          var form = document.createElement("form");
          form.method = "POST";
          form.action = "nueva_clave.php";

          // Crear un campo oculto para la variable
          var input = document.createElement("input");
          input.type = "hidden";
          input.name = "variable";
          input.value = miVariable;

          // Agregar el campo oculto al formulario
          form.appendChild(input);

          // Agregar el formulario al cuerpo del documento y enviarlo
          document.body.appendChild(form);
          form.submit();
        }
      },
    });
  });
});
