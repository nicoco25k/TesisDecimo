const formulario = document.getElementById("formulario");
const inputs = document.querySelectorAll("#formulario input");

const expresiones = {
  correo: /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
};

const campos = {
  correo: false,
};

const validarFormulario = (e) => {
  switch (e.target.name) {
    case "correo":
      validarCampo(expresiones.correo, e.target, "correo");
      break;
  }
};

const validarCampo = (expresion, input, campo) => {
  if (
    expresion.test(input.value) &&
    input.value.length >= 4 &&
    input.value.length <= 60
  ) {
    document
      .getElementById(`grupo__${campo}`)
      .classList.remove("formulario__grupo-incorrecto");
    document
      .getElementById(`grupo__${campo}`)
      .classList.add("formulario__grupo-correcto");
    document
      .querySelector(`#grupo__${campo} i`)
      .classList.add("fa-check-circle");
    document
      .querySelector(`#grupo__${campo} i`)
      .classList.remove("fa-times-circle");
    document
      .querySelector(`#grupo__${campo} .formulario__input-error`)
      .classList.remove("formulario__input-error-activo");
    campos[campo] = true;
  } else {
    document
      .getElementById(`grupo__${campo}`)
      .classList.add("formulario__grupo-incorrecto");
    document
      .getElementById(`grupo__${campo}`)
      .classList.remove("formulario__grupo-correcto");
    document
      .querySelector(`#grupo__${campo} i`)
      .classList.add("fa-times-circle");
    document
      .querySelector(`#grupo__${campo} i`)
      .classList.remove("fa-check-circle");
    document
      .querySelector(`#grupo__${campo} .formulario__input-error`)
      .classList.add("formulario__input-error-activo");
    campos[campo] = false;
  }
};

inputs.forEach((input) => {
  input.addEventListener("keyup", validarFormulario);
  input.addEventListener("blur", validarFormulario);
});

formulario.addEventListener("submit", (e) => {
  e.preventDefault();

  // Preguntar al usuario si está seguro de actualizar el correo
  swal({
    title: "¿Estás seguro?",
    text: "Se actualizará tu correo electrónico",
    icon: "warning",
    buttons: ["Cancelar", "Actualizar"],
    dangerMode: true,
  }).then((willUpdate) => {
    if (willUpdate) {
      if (campos.correo) {
        const postData = {
          correo: $("#correo").val(),
        };

        $.post("comprobar_editar_correo.php", postData, function (response) {
          let x = response;

          if (x == "996") {
            swal(
              "Error!",
              "Querido usuario, el correo que digitaste no cumple con los requisitos",
              "error",
            );
          } else if (x == "3") {
            swal(
              "Error!",
              "Querido usuario, el correo electrónico que digitaste ya se encuentra registrado, digita uno diferente",
              "error",
            );
          } else if (x == "225") {
            swal(
              "Error!",
              "Querido usuario, el correo electrónico que digitaste no cumple con el número de caracteres permitido, debe tener entre 12 y 60 caracteres",
              "error",
            );
          } else if (x == "923") {
            swal(
              "Error!",
              "No se realizó la conexión con la base de datos",
              "error",
            );
          } else if (x == "2309") {
            swal({
              title: "Correo actualizado con éxito",
              icon: "success",
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
              if (willDelete) {
                window.location = "editar_datos.php";
              } else {
                window.location = "editar_datos.php";
              }
            });
            $("#formulario").trigger("reset");
          }
        });
      } else {
        swal({
          title: "¡Campo Incompleto!",
          icon: "warning",
          dangerMode: true,
        });
      }
    }
  });
});
