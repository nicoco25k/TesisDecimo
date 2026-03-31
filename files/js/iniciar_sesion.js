const formulario = document.getElementById("formulario");
const inputs = document.querySelectorAll("#formulario input");

const expresiones = {
  usuario: /^[a-zA-Z0-9.!#$%&'*+/=?^_].{7,20}$/, // 8 a 12 digitos.
  password: /^[a-zA-Z0-9.!#$%&'*+/=?^_].{7,20}$/, // 8 a 12 digitos.
};

const campos = {
  password: false,
  usuario: false,
};

const validarFormulario = (e) => {
  switch (e.target.name) {
    case "usuario":
      validarCampo(expresiones.usuario, e.target, "usuario");
      break;

    case "password":
      validarCampo(expresiones.password, e.target, "password");
      break;
  }
};

const validarCampo = (expresion, input, campo) => {
  if (expresion.test(input.value)) {
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
  const postData = {
    usuario: $("#usuario").val(),
    password: $("#password").val(),
  };
  $.post("comprobar_inicio_sesion.php", postData, function (response) {
    if (response === "user") {
      window.location.href = "index.php";
    } else if (response === "admin") {
      window.location.href = "inicio_admin.php";
    } else if (response === "root") {
      window.location.href = "inicio_root.php";
    } else {
      swal("Error!", "Datos incorrectos", "error");
    }
  });
});
