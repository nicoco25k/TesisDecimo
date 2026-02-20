function imagenes() {
	var formData = new FormData();
	var file = $("#image")[0].files[0];
	formData.append('file', file);

	$.ajax({
	  url: 'ruta_img_noticia.php',
	  type: 'post',
	  data: formData,
	  contentType: false,
	  processData: false,
	  success: function(response) {
		var rutaCompleta = JSON.parse(response);
		// Haz lo que necesites con la variable rutaCompleta aquí

		let img = response;

		if (img == 775) {
			swal("Error!", "La imagen que intentas subir no cumple el formato permitido", "error");
		} else {
			$('#formulario').submit(e => {
				e.preventDefault();
				const postData = {
					rutaCompleta: rutaCompleta // Incluir la variable rutaCompleta en el postData
				};

				$.post('comprobar_noticia.php', postData, function(response){
					console.log(response);
					let x = response;
					
					if (x == '0923') {
						swal("Error!", "No se realizó la conexión con la base de datos", "error");
					} else if (x == '2309') {
						swal({
							title: "Noticia registrada con éxito",
							icon: "success",
							buttons: true,
						}).then(() => {
							// Agrega un retraso antes de refrescar
							setTimeout(() => {
								location.reload(); // Refresca la página actual
							}, 2000); // Retraso de 2 segundos (2000 ms)
						});
					
						$('#formulario').trigger('reset');
					}
					
				});

				e.preventDefault();
			});
		}

		$('#formulario').submit(e => {
			e.preventDefault();
			const postData = {
				rutaCompleta: rutaCompleta // Incluir la variable rutaCompleta en el postData
			};

			$.post('comprobar_mascota_registro_img.php', postData, function(response){
				let x = response;

				if (x == '0923') {
					swal("Error!", "No se realizó el registro, imagen no válida", "error");
				}
			});

			e.preventDefault();
		});
	  }
	});
}

