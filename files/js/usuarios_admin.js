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
      zeroRecords: "No se encontraron usuarios con tu búsqueda",
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
      [10, 25, "Todos los usuarios"],
    ],
  });
});

function generarReporte() {
  window.location.href = "generar_reporte_usuarios.php";
}

function confirmarDesactivarUsuario(idUsuario, btn) {
  Swal.fire({
    title: "Desactivar Usuario",
    text: "¿Estás seguro de que deseas desactivar este usuario?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Sí, desactivar",
    cancelButtonText: "Cancelar",
    backdrop: "static",
  }).then((result) => {
    if (result.isConfirmed) {
      actualizarEstadoUsuario(idUsuario, "Desactivar", btn);
    }
  });
}

function confirmarActivarUsuario(idUsuario, btn) {
  Swal.fire({
    title: "Activar Usuario",
    text: "¿Estás seguro de que deseas activar este usuario?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Sí, activar",
    cancelButtonText: "Cancelar",
    backdrop: "static",
  }).then((result) => {
    if (result.isConfirmed) {
      actualizarEstadoUsuario(idUsuario, "Activar", btn);
    }
  });
}

function actualizarEstadoUsuario(idUsuario, accion, btn) {
  $.ajax({
    url: "actualizar_estado_usuario.php",
    type: "POST",
    data: {
      idUsuario: idUsuario,
      accion: accion,
    },
    success: function (response) {
      Swal.fire({
        title: "Éxito",
        text: "El estado del usuario ha sido actualizado.",
        icon: "success",
      }).then(() => {
        // Actualizar DOM sin recargar
        const fila = btn.closest("tr");
        const celdaEstado = fila.cells[6];
        if (accion === "Desactivar") {
          celdaEstado.textContent = "Desactivado";
          btn.textContent = "Activar";
          btn.classList.remove("btn-danger");
          btn.classList.add("btn-success");
          btn.setAttribute(
            "onclick",
            `confirmarActivarUsuario(${idUsuario}, this)`,
          );
        } else {
          celdaEstado.textContent = "Activado";
          btn.textContent = "Desactivar";
          btn.classList.remove("btn-success");
          btn.classList.add("btn-danger");
          btn.setAttribute(
            "onclick",
            `confirmarDesactivarUsuario(${idUsuario}, this)`,
          );
        }
      });
    },
    error: function (xhr, status, error) {
      Swal.fire({
        title: "Error",
        text: "Error al actualizar el estado del usuario.",
        icon: "error",
      });
    },
  });
}

document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") cerrarModal();
});
