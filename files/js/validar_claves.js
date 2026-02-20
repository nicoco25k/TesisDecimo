
$(document).ready(function() {
    $('#cambiopass').submit(function(event) {
      event.preventDefault();

      var formData = $(this).serialize();

      $.ajax({
        type: 'POST',
        url: 'validar_claves.php',
        data: formData,
        success: function(response) {



			let x =response;

			if(x==885){
				swal("Contraseñas invalidas!", "La contraseña debe contener letras o numeros y debe contar entre 8 a 20 caracteres", "error");
			 $('#cambiopass').trigger('reset');
			}if(x==886){
				swal("Contraseñas invalidas!", "La contraseña debe contener letras o numeros y debe contar entre 8 a 20 caracteres", "error");
			 $('#cambiopass').trigger('reset');
			}if(x==887){
				swal("Contraseñas incorrectas!", "La contraseña deben ser iguales", "error");
			 $('#cambiopass').trigger('reset');
			}if(x==888){
				swal("Contraseñas invalida!", "Querido usuario, debes usar una contraseña distinta a las que anteriormente has usado", "error");
			 $('#cambiopass').trigger('reset');
			}if(x==0923){
				swal("Error!", "Querido usuario, ha ocurrido un error durante el procesidimiento, si el error prevalece ponte en contacto con nostros por medio de correo asopaticas@asopaticas.com", "error");
			 $('#cambiopass').trigger('reset');
			}
			
			if(x==2309){
				swal({
		
					title: "Has cambiao la contraseña con exito",
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
			

			 $('#cambiopass').trigger('reset');
			}









        }
      });
    });
  });
