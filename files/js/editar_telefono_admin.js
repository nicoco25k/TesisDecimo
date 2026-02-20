const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
	telefono: /^\d{8,12}$/ // 8 a 12 números.
};

const campos = {
  telefono: false,
};

const validarFormulario = (e) => {
  switch (e.target.name) {
    case "telefono":
      validarCampo(expresiones.telefono, e.target, 'telefono');
      break;
  }
};

const validarCampo = (expresion, input, campo) => {
  if (expresion.test(input.value) && input.value.length >= 4 && input.value.length <= 60) {
    document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
    document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
    document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
    document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
    document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
    campos[campo] = true;
  } else {
    document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
    document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
    document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
    document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
    document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
    campos[campo] = false;
  }
};

inputs.forEach((input) => {
  input.addEventListener('keyup', validarFormulario);
  input.addEventListener('blur', validarFormulario);
});

formulario.addEventListener('submit', (e) => {
  e.preventDefault();

  // Preguntar al usuario si está seguro de actualizar el telefono
  swal({
    title: "¿Estás seguro?",
    text: "Se actualizará tu número de telefono",
    icon: "warning",
    buttons: ["Cancelar", "Actualizar"],
    dangerMode: true,
  }).then((willUpdate) => {
    if (willUpdate) {
      if (campos.telefono) {
        const postData = {
          telefono: $('#telefono').val()
        };

        $.post('comprobar_editar_telefono_admin.php', postData, function (response) {
          let x = response;


          if (x == 996) {
            swal("Error!", "Querido usuario, el número de telefono que digitaste no cumple con los requisitos", "error");
          } else if (x == 3) {
            swal("Error!", "Querido usuario, el número de telefono electrónico que digitaste ya se encuentra registrado, digita uno diferente", "error");
          } else if (x == 923) {
            swal("Error!", "No se realizó la conexión con la base de datos", "error");
          } else if (x == 2309) {
            swal({
              title: "telefono actualizado con éxito",
              icon: "success",
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
              if (willDelete) {
                window.location = "editar_datos_admin.php";
              } else {
                window.location = "editar_datos_admin.php";
              }
            });
            $('#formulario').trigger('reset');
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
