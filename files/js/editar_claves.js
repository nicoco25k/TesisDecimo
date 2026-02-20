const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
	password: /^[a-zA-Z0-9]{8,20}$/, // Letras y números. De 8 a 20 caracteres.
	password2: /^[a-zA-Z0-9]{8,20}$/ // Letras y números. De 8 a 20 caracteres.
};

const campos = {
	password: false,
	password2: false
};

const validarFormulario = (e) => {
  switch (e.target.name) {
		case "password":
			validarCampo(expresiones.password, e.target, 'password');
			validarcontrasena();
		break;
		case "password2":
			validarCampo(expresiones.password2, e.target, 'password2');
			validarcontrasena();
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




var cont = 0;



const validarcontrasena = ()=>{
 const inputpassword=document.getElementById('password');  
  const inputpassword2=document.getElementById('password2');
  

  if ((inputpassword.value !== inputpassword2.value)) {
    document.getElementById(`grupo__password2`).classList.add('formulario__grupo-incorrecto');
      document.getElementById(`grupo__password2`).classList.remove('formulario__grupo-correcto');
      document.querySelector(`#grupo__password2 .formulario__input-error`).classList.add('formulario__input-error-activo');
      campos[password]=false;
      cont=1;
     
  }else{

    if((inputpassword.value=="")){
      document.getElementById(`grupo__password2`).classList.add('formulario__grupo-incorrecto');
      document.getElementById(`grupo__password2`).classList.remove('formulario__grupo-correcto');
      document.querySelector(`#grupo__password2 .formulario__input-error`).classList.add('formulario__input-error-activo');
      campos[password]=false;
      cont=1;
    }else{
      document.getElementById(`grupo__password2`).classList.remove('formulario__grupo-incorrecto');
      document.getElementById(`grupo__password2`).classList.add('formulario__grupo-correcto');
      document.querySelector(`#grupo__password2 .formulario__input-error`).classList.remove('formulario__input-error-activo');
      campos[password]=true;
      cont=0;
      
    }
  }
}


var cont1 = 1;


inputs.forEach((input) => {
  input.addEventListener('keyup', validarFormulario);
  input.addEventListener('blur', validarFormulario);
});




formulario.addEventListener('submit', (e) => {
  e.preventDefault();

  // Preguntar al usuario si está seguro de actualizar las contraseñas
  swal({
    title: "¿Estás seguro?",
    text: "Se actualizará tu clave",
    icon: "warning",
    buttons: ["Cancelar", "Actualizar"],
    dangerMode: true,
  }).then((willUpdate) => {
    if (willUpdate) {
      if (campos.password) {
        const postData = {
          password: $('#password').val(),
          password2: $('#password2').val()
        };

        $.post('comprobar_editar_clave.php', postData, function (response) {
          let x = response;
  

          if (x == 995) {
            swal("Error!", "Querido usuario, la contraseña que digitaste no cumple con los requisitos", "error");
            $('#formulario').trigger('reset');
          } else if (x == 3) {
            swal("Error!", "Querido usuario, no puedes digitar la misma contraseña, digita una diferente", "error");
            $('#formulario').trigger('reset');
          } else if (x == 998) {
            swal("Error!", "Querido usuario, las contraseñas no son iguales, digitalas de nuevo", "error");
            $('#formulario').trigger('reset');

          } else if (x == 2309) {
            swal({
              title: "contraseña actualizado con éxito",
              icon: "success",
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
              if (willDelete) {
                window.location = "inicio_editar_datos.php";
              } else {
                window.location = "inicio_editar_datos.php";
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
