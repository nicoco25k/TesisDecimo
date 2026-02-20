const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
	nombre: /^[a-zA-ZñÑ\s]{4,40}$/,
	apellido: /^[a-zA-ZñÑ\s]{4,40}$/,
	documento: /^\d{8,12}$/, // 8 a 12 números.
	usuario: /^[a-zA-Z0-9]{8,20}$/, // Letras y números. De 8 a 20 caracteres.
	password: /^[a-zA-Z0-9]{8,20}$/, // Letras y números. De 8 a 20 caracteres.
	password2: /^[a-zA-Z0-9]{8,20}$/, // Letras y números. De 8 a 20 caracteres.
	correo: /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{8,12}$/ // 8 a 12 números.
  };

const campos = {
	apellido: false,
	nombre: false,
	documento: false,
	password: false,
	password2: false,
	usuario: false,
	correo: false,
	telefono: false
}


const validarFormulario = (e) => {
	switch (e.target.name) {

		case "nombre":
			validarCampo(expresiones.nombre, e.target, 'nombre');
		break;
		case "apellido":
			validarCampo(expresiones.apellido, e.target, 'apellido');
		break;
	

		case "documento":
			validarCampo(expresiones.documento, e.target, 'documento');
		break;

		case "usuario":
			validarCampo(expresiones.usuario, e.target, 'usuario');
		break;

		case "password":
			validarCampo(expresiones.password, e.target, 'password');
			validarcontrasena();
		break;
		case "password2":
			validarCampo(expresiones.password2, e.target, 'password2');
			validarcontrasena();
		break;
		case "correo":
			validarCampo(expresiones.correo, e.target, 'correo');
		break;
		case "telefono":
			validarCampo(expresiones.telefono, e.target, 'telefono');
		break;
	}
}







const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
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

	
}


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


	const terminos = document.getElementById('terminos');
	if(campos.apellido && campos.nombre && campos.password && campos.password2 && campos.correo && campos.telefono && campos.documento && terminos.checked ){
		
		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
			icono.classList.remove('formulario__grupo-correcto');
		});
	} else {

		swal({
			title: "Faltan por completar campos",
			icon: "warning",
			dangerMode: true,
			  })
		
	}

	
});





//tipo_documento

$.ajax({
	url: 'buscador_select.php',
	type: 'GET',
	success: function(response) {
	  const documento = JSON.parse(response);
	  let template = '';
	  documento.forEach(task => {
		template += `

		<option value="${task.id_tipo_documento}">${task.nombre_documento}</option>
		
			  `
	  });

	  
	  $('#documento_opcion').html(template);
	}





  });





  $('#formulario').submit(e => {
    e.preventDefault();
    const postData = {
      nombre: $('#nombre').val(),
      apellido: $('#apellido').val(),
	  correo: $('#correo').val(),
	  telefono: $('#telefono').val(),
	  documento_opcion: $('#documento_opcion').val(),
	  documento: $('#documento').val(),
	  usuario: $('#usuario').val(),
	  password: $('#password').val(),
	  password2: $('#password2').val()
    };

$.post('comprobar_datos_registro.php', postData, function (response){



let x=response; 

if(x==991){
	swal("Error!", "Querido usuario, el nombre que digitaste no cumple con los requisitos", "error");
	}
	if(x==992){
		swal("Error!", "Querido usuario, el apellido que digitaste no cumple con los requisitos", "error");
		}
		if(x==993){
			swal("Error!", "Querido usuario, el número de documento que digitaste no cumple con los requisitos", "error");
			}
			if(x==994){
				swal("Error!", "Querido usuario, el nickname que digitaste no cumple con los requisitos", "error");
				}
				if(x==995){
					swal("Error!", "Querido usuario, la clave que digitaste no cumple con los requisitos", "error");
					}
					if(x==996){
						swal("Error!", "Querido usuario, el correo que digitaste no cumple con los requisitos", "error");
						}
						if(x==997){
							swal("Error!", "Querido usuario, el número de telefono que digitaste no cumple con los requisitos", "error");
							}
							if(x==998){
								swal("Error!", "Querido usuario, las contraseñas no son iguales", "error");
								}
								if(x==2525){
									swal("Error!", "Querido usuario, se detectaron palabras groseras, por favor abstenerse a agregar estas palabras", "error");
									}

if(x==1){
	swal("Error!", "Querido usuario, el nickname que digitaste ya se encuentra registrado, digita uno diferente", "error");
		}
		if(x==2){
			swal("Error!", "Querido usuario, el número de documento que digitaste ya se encuentra registrado, digita uno diferente", "error");
			}
			if(x==3){
				swal("Error!", "Querido usuario, el correo electrónico que digitaste ya se encuentra registrado, digita uno diferente", "error");
				}
				if(x==4){
					swal("Error!", "Querido usuario, el número de telefono que digitaste ya se encuentra registrado, digita uno diferente", "error");
					}
					if(x==42){
						swal("Error!", "Querido usuario, el número de telefono y el número de documento que digitaste ya se encuentran registrados, digita unos diferentes", "error");
						}
						if(x==43){
							swal("Error!", "Querido usuario, el correo electrónico y el número de documento que digitaste ya se encuentran registrados, digita unos diferentes", "error");
							}
							if(x==31){
								swal("Error!", "Querido usuario, el nickname y correo electrónico que digitaste ya se encuentran registrados, digita unos diferentes", "error");
								}
								if(x==12){
									swal("Error!", "Querido usuario, el nickname y número de documento que digitaste ya se encuentran registrados, digita unos diferentes", "error");
									}
									if(x==23){
										swal("Error!", "Querido usuario, el número de documento y correo electrónico que digitaste ya se encuentran registrados, digita unos diferentes", "error");
										}
										if(x==41){
											swal("Error!", "Querido usuario, el nickname y el número de telefono que digitaste ya se encuentran registrados, digita unos diferentes", "error");
											}
											if(x==314){
												swal("Error!", "Querido usuario, el nickname, correo electrónico y el número de telefono que digitaste ya se encuentran registrados, digita unos diferentes", "error");
												}
												if(x==214){
													swal("Error!", "Querido usuario, el nickname, número de documento y el número de telefono que digitaste ya se encuentran registrados, digita unos diferentes", "error");
													}
													if(x==123){
														swal("Error!", "Querido usuario, el nickname, número de documento y correo electrónico que digitaste ya se encuentran registrados, digita unos diferentes", "error");
														}
														if(x==234){
															swal("Error!", "Querido usuario, el número de documento, correo electrónico y el número de telefono que digitaste ya se encuentran registrados, digita unos diferentes", "error");
															}
															if(x==1234){
																swal("Error!", "Querido usuario, el nickname, número de documento, correo electrónico y el número de telefono que digitaste ya se encuentran registrados, digita unos diferentes", "error");
																}
																if (x == 225) {
																	swal("Error!", "Querido usuario, el correo electrónico que digitaste no cumple con el número de caracteres permitido, debe tener entre 12 y 60 caracteres", "error");
																  }
																
																
																					
															



			
if(x==0923){
swal("Error!", "No se realizo la conexión con la base de datos", "error");
}



if(x==2309){


	swal({
		
		title: "Te has registrado con exito",
		text: "Ahora puedes ir a iniciar sesión, dandole click a ok",
		icon: "success",
		buttons: true,
		dangerMode: true,

		
	  }
	  )
	  .then((willDelete) => {
		if (willDelete) {
		
			window.location="iniciar_sesion.php";

		} else {

		  window.location="index.php";
		}
	  });

	  $('#formulario').trigger('reset');
	

	

}






}); 

e.preventDefault();

  });





	
	

	
     














