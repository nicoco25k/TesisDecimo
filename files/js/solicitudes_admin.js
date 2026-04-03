$(document).ready(function () {
  $("#tablax").DataTable({
    language: {
      processing: "Tratamiento en curso...",
      search: "Buscar&nbsp;:",
      lengthMenu: "Grupos: _MENU_ ",
      info: "_START_ de _END_",
      infoEmpty: "Por favor refresca la página.",
      infoFiltered: "(filtrado de _MAX_ elementos en total)",
      infoPostFix: "",
      loadingRecords: "Cargando...",
      zeroRecords: "No se encontraron solicitudes con tu búsqueda",
      emptyTable: "No hay datos disponibles en la tabla.",
      paginate: {
        first: "Primero",
        previous: "Anterior",
        next: "Siguiente",
        last: "Ultimo",
      },
      aria: {
        sortAscending: ": active para ordenar la columna en orden ascendente",
        sortDescending: ": active para ordenar la columna en orden descendente",
      },
    },
    lengthMenu: [
      [10, 25, -1],
      [10, 25, "Todas las solicitudes"],
    ],
    // Ocultar filas de datos del modal de DataTables
    rowCallback: function (row, data) {
      if (
        $(row).attr("id") &&
        $(row).attr("id").startsWith("data-solicitud-")
      ) {
        $(row).hide();
      }
    },
  });
});

function generarReporte() {
  window.location.href = "generar_reporte_solicitudes.php";
}

function generarReporte_aprobadas() {
  window.location.href = "generar_reporte_aprobados.php";
}

function generarReporte_declinadas() {
  window.location.href = "generar_reporte_declinadas.php";
}

function verSolicitud(id) {
  const dataRow = document.getElementById("data-solicitud-" + id);
  if (!dataRow) return;

  document.getElementById("modal-sol-mascota").textContent =
    dataRow.dataset.nombreMascota;
  document.getElementById("modal-sol-nombre").textContent =
    dataRow.dataset.usuarioNombre;
  document.getElementById("modal-sol-correo").textContent =
    dataRow.dataset.usuarioCorreo;
  document.getElementById("modal-sol-telefono").textContent =
    dataRow.dataset.usuarioNumero;
  document.getElementById("modal-sol-direccion").textContent =
    dataRow.dataset.usuarioDireccion;
  document.getElementById("modal-sol-viabilidad").textContent =
    dataRow.dataset.viabilidad;
  document.getElementById("modal-sol-fecha").textContent =
    dataRow.dataset.fecha;

  const preguntas = JSON.parse(dataRow.dataset.preguntas);
  let html = "";
  for (const [pregunta, respuesta] of Object.entries(preguntas)) {
    html += `<p><strong>${pregunta}:</strong> ${respuesta}</p>`;
  }
  document.getElementById("modal-sol-preguntas").innerHTML = html;

  document.getElementById("modalSolicitud").style.display = "block";
}

function cerrarModalSolicitud() {
  document.getElementById("modalSolicitud").style.display = "none";
}

document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") cerrarModalSolicitud();
});

function confirmarAdopcion(id, btn) {
  Swal.fire({
    title: "Confirmar Adopción",
    text: "¿Estás seguro de que deseas confirmar esta solicitud de adopción?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Sí, confirmar",
    cancelButtonText: "Cancelar",
    backdrop: "static",
  }).then((result) => {
    if (result.isConfirmed) {
      actualizarEstadoSolicitud(id, "3", btn);
    }
  });
}

function rechazarAdopcion(id, btn) {
  Swal.fire({
    title: "Rechazar Adopción",
    text: "¿Estás seguro de que deseas rechazar esta solicitud de adopción?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Sí, rechazar",
    cancelButtonText: "Cancelar",
    backdrop: "static",
  }).then((result) => {
    if (result.isConfirmed) {
      actualizarEstadoSolicitud(id, "2", btn);
    }
  });
}

function actualizarEstadoSolicitud(id, accion, btn) {
  $.ajax({
    url: "update_adoption_status.php",
    type: "POST",
    data: {
      idUsuario: id,
      accion: accion,
    },
    success: function (response) {
      Swal.fire({
        title: "Éxito",
        text: "Se ha completado con éxito la acción",
        icon: "success",
      }).then(() => {
        // Eliminar la fila sin recargar
        const fila = btn.closest("tr");
        fila.remove();
      });
    },
    error: function (xhr, status, error) {
      Swal.fire({
        title: "Error",
        text: "Error al actualizar el estado de la adopción.",
        icon: "error",
      });
    },
  });
}

function verSolicitud(id) {
  const dataRow = document.getElementById("data-solicitud-" + id);
  if (!dataRow) return;

  document.getElementById("modal-sol-mascota").textContent =
    dataRow.getAttribute("data-nombre-mascota");
  document.getElementById("modal-sol-nombre").textContent =
    dataRow.getAttribute("data-usuario-nombre");
  document.getElementById("modal-sol-correo").textContent =
    dataRow.getAttribute("data-usuario-correo");
  document.getElementById("modal-sol-telefono").textContent =
    dataRow.getAttribute("data-usuario-numero");
  document.getElementById("modal-sol-direccion").textContent =
    dataRow.getAttribute("data-usuario-direccion");
  document.getElementById("modal-sol-viabilidad").textContent =
    dataRow.getAttribute("data-viabilidad");
  document.getElementById("modal-sol-fecha").textContent =
    dataRow.getAttribute("data-fecha");

  const preguntas = JSON.parse(dataRow.getAttribute("data-preguntas"));
  let html = "";
  for (const [pregunta, respuesta] of Object.entries(preguntas)) {
    html += `<p><strong>${pregunta}</strong><br>${respuesta}</p>`;
  }
  document.getElementById("modal-sol-preguntas").innerHTML = html;

  document.getElementById("modalSolicitud").style.display = "block";
}
