const formulario = document.getElementById("formulario");
const inputs = document.querySelectorAll("#formulario input");
var rutaCompleta; // Variable global para almacenar la ruta completa

//selects

$.ajax({
  url: "select_especie.php",
  type: "GET",
  success: function (response) {
    const documento = JSON.parse(response);
    let template = "";

    documento.forEach((task) => {
      template += `
 
		<option value="${task.id_especie_mascota}">${task.nombre_especie}</option>
		
			  `;
    });
    $("#especie_opcion").html(template);
  },
});

$.ajax({
  url: "select_raza.php",
  type: "GET",
  success: function (response) {
    const documento = JSON.parse(response);
    let template = "";

    documento.forEach((task) => {
      template += `

		<option value="${task.id_razas_mascota}">${task.nombre_raza}</option>
		
			  `;
    });
    $("#raza_opcion").html(template);
  },
});

$.ajax({
  url: "select_sexo.php",
  type: "GET",
  success: function (response) {
    const documento = JSON.parse(response);
    let template = "";

    documento.forEach((task) => {
      template += `

		<option value="${task.id_sexo_mascota}">${task.nombre_sexo}</option>
		
			  `;
    });
    $("#sexo_opcion").html(template);
  },
});

$.ajax({
  url: "select_edad.php",
  type: "GET",
  success: function (response) {
    const documento = JSON.parse(response);
    let template = "";

    documento.forEach((task) => {
      template += `

		<option value="${task.id_edad_mascota}">${task.nombre_edad}</option>
		
			  `;
    });
    $("#edad_opcion").html(template);
  },
});

$.ajax({
  url: "select_desparasitacion.php",
  type: "GET",
  success: function (response) {
    const documento = JSON.parse(response);
    let template = "";

    documento.forEach((task) => {
      template += `

		<option value="${task.id_estado_desparasitacion_mascota}">${task.nombre_desparasitacion}</option>
		
			  `;
    });
    $("#desparasitacion_opcion").html(template);
  },
});

$.ajax({
  url: "select_esterilizacion.php",
  type: "GET",
  success: function (response) {
    const documento = JSON.parse(response);
    let template = "";

    documento.forEach((task) => {
      template += `

		<option value="${task.id_estado_esterilizacion_mascota}">${task.nombre_esterilizacion}</option>
		
			  `;
    });
    $("#esterilizacion_opcion").html(template);
  },
});

$.ajax({
  url: "select_vacuna.php",
  type: "GET",
  success: function (response) {
    const documento = JSON.parse(response);
    let template = "";

    documento.forEach((task) => {
      template += `

		<option value="${task.id_estado_vacuna_mascota}">${task.nombre_vacuna}</option>
		
			  `;
    });
    $("#vacuna_opcion").html(template);
  },
});

function imagenes() {
  var formData = new FormData();
  var file = $("#image")[0].files[0];
  formData.append("file", file);

  $.ajax({
    url: "ruta_img_mascota.php",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      rutaCompleta = JSON.parse(response);
      // Haz lo que necesites con la variable rutaCompleta aquí

      let img = response;

      if (img == 775) {
        swal(
          "Error!",
          "Este la imagen a subir no cumple el formato permitido",
          "error",
        );
      } else {
        $("#formulario").submit((e) => {
          e.preventDefault();
          const postData = {
            nombre: $("#nombre").val(),
            caracteristicas: $("#caracteristicas").val(),
            especie_opcion: $("#especie_opcion").val(),
            raza_opcion: $("#raza_opcion").val(),
            sexo_opcion: $("#sexo_opcion").val(),
            edad_opcion: $("#edad_opcion").val(),
            desparasitacion_opcion: $("#desparasitacion_opcion").val(),
            esterilizacion_opcion: $("#esterilizacion_opcion").val(),
            vacuna_opcion: $("#vacuna_opcion").val(),
            rutaCompleta: rutaCompleta, // Incluir la variable rutaCompleta en el postData
          };

          $.post(
            "comprobar_mascota_registro.php",
            postData,
            function (response) {
              let x = response;

              if (x == 923) {
                swal(
                  "Error!",
                  "No se realizo la conexión con la base de datos",
                  "error",
                );
              }

              if (x == 2309) {
                swal({
                  title: "Mascota registrada con exito",
                  text: "Ahora puedes la información de los registros de los animales dando click a ok",
                  icon: "success",
                  buttons: true,
                  dangerMode: true,
                }).then((willDelete) => {
                  if (willDelete) {
                    window.location = "mascotas.php";
                  } else {
                    window.location = "inicio_admin.php";
                  }
                });

                $("#formulario").trigger("reset");
              }
            },
          );

          e.preventDefault();
        });
      }

      $("#formulario").submit((e) => {
        e.preventDefault();
        const postData = {
          rutaCompleta: rutaCompleta, // Incluir la variable rutaCompleta en el postData
        };

        $.post(
          "comprobar_mascota_registro_img.php",
          postData,
          function (response) {
            let x = response;

            if (x == 923) {
              swal(
                "Error!",
                "No se realizo el registro, imagen no valida",
                "error",
              );
            }
          },
        );

        e.preventDefault();
      });
    },
  });
}
