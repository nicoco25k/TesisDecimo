const formulario = document.getElementById('formulario');
var textareaValue = document.getElementById('mensaje').value;

const expresiones = {
	nombre: /^[a-zA-ZñÑ\s]{4,40}$/,
	correo: /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{8,12}$/ // 8 a 12 números.
	};


	
  $('#formulario').submit(e => {
    e.preventDefault();
    const postData = {
      nombre: $('#nombre').val(),
	  correo: $('#correo').val(),
	  telefono: $('#telefono').val(),
	  mensaje: $('#mensaje').val()
    };

$.post('comprobar_mensajes.php', postData, function (response){
 

let x=response; 

if(x==991){
	swal("Error!", "Querido usuario, el nombre solo debe contener letras y que este dentro de un rango de 4 a 20 caracteres", "error");
	}
	if(x==992){
		swal("Error!", "Querido usuario, el número de telefono solo debe contener numeros y que este dentro de un rango de 4 a 20 caracteres", "error");
		}
		if(x==993){
			swal("Error!", "Querido usuario, el correo que digitaste no cumple con los requisitos", "error");
			}
			if(x==994){
				swal("Error!", "Querido usuario, el mensaje debe estar de un rango de 10 a 200 caracteres", "error");
				}
				if(x==2525){
					swal("Error!", "Querido usuario, se detectaron palabras groseras, por favor abstenerse a agregar estas palabras", "error");
					}
	
		


		
if(x==1234){
swal("Error!", "No se realizo la conexión con la base de datos", "error");
}



if(x==2309){




	
	swal({
		
		title: "Mensaje enviado con exito",
		text: "Te invitamos a que esperes la respuesta mendiante correo electrónico o telefono, se paciente",
		icon: "success",
	  }
	  )
		  $('#formulario').trigger('reset');
	
}





}); 

e.preventDefault();

  });





	
	

	
     














