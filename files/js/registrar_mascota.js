var rutaCompleta = null; // Variable global para almacenar la ruta completa

// =====================
// CARGA DE SELECTS
// =====================

function cargarSelect(tipo, selectId, valorKey, textoKey) {
  $.ajax({
    url: "select_opciones.php?tipo=" + tipo,
    type: "GET",
    success: function (response) {
      const documento = JSON.parse(response);
      let template = "";
      documento.forEach((task) => {
        template += `<option value="${task[valorKey]}">${task[textoKey]}</option>`;
      });
      $("#" + selectId).html(template);
    },
  });
}

cargarSelect(
  "especie",
  "especie_opcion",
  "id_especie_mascota",
  "nombre_especie",
);
cargarSelect("raza", "raza_opcion", "id_razas_mascota", "nombre_raza");
cargarSelect("sexo", "sexo_opcion", "id_sexo_mascota", "nombre_sexo");
cargarSelect("edad", "edad_opcion", "id_edad_mascota", "nombre_edad");
cargarSelect(
  "desparasitacion",
  "desparasitacion_opcion",
  "id_estado_desparasitacion_mascota",
  "nombre_desparasitacion",
);
cargarSelect(
  "esterilizacion",
  "esterilizacion_opcion",
  "id_estado_esterilizacion_mascota",
  "nombre_esterilizacion",
);
cargarSelect(
  "vacuna",
  "vacuna_opcion",
  "id_estado_vacuna_mascota",
  "nombre_vacuna",
);

// =====================
// SUBIDA DE IMAGEN
// Solo guarda la ruta, NO registra nada en BD
// =====================

function imagenes() {
  var formData = new FormData();
  var file = $("#image")[0].files[0];

  console.log("Archivo seleccionado:", file); // 🔥

  if (!file) {
    console.log("No hay archivo");
    return;
  }

  formData.append("file", file);

  $.ajax({
    url: "ruta_img_mascota.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      console.log("Respuesta servidor:", response); // 🔥

      const respuesta = response.trim();

      if (respuesta == "775") {
        swal("Error!", "La imagen no cumple el formato permitido", "error");
        rutaCompleta = null;
        $("#image").val("");
      } else {
        rutaCompleta = JSON.parse(response); // ✅ CORRECTO
        console.log("Ruta guardada:", rutaCompleta); // 🔥
      }
    },
  });
}
// =====================
// ENVÍO DEL FORMULARIO
// Se registra UNA sola vez, fuera de imagenes()
// =====================

$("#formulario").on("submit", function (e) {
  e.preventDefault();

  if (!rutaCompleta) {
    swal(
      "Error!",
      "Debes seleccionar una imagen válida antes de registrar",
      "error",
    );
    return;
  }

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
    rutaCompleta: rutaCompleta,
  };

  $.post("comprobar_mascota_registro.php", postData, function (response) {
    const x = response.trim();

    if (x == "923") {
      swal("Error!", "No se realizó la conexión con la base de datos", "error");
    }

    if (x == "2309") {
      swal({
        title: "Mascota registrada con éxito",
        text: "¿Qué deseas hacer ahora?",
        icon: "success",
        buttons: {
          ver: {
            text: "Ver registros",
            value: "ver",
          },
          otra: {
            text: "Añadir otra mascota",
            value: "otra",
          },
        },
      }).then((value) => {
        if (value === "ver") {
          window.location = "mascotas.php";
        } else if (value === "otra") {
          window.location = "registrar_mascota.php";
        }
      });

      $("#formulario").trigger("reset");
      rutaCompleta = null;
    }
  });
});
