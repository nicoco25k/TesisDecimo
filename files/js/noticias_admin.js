// =============================================
//   noticias_admin.js
// =============================================

$(document).ready(function () {
  $("#tablax").DataTable({
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
    order: [[0, "desc"]],
  });
});

// --------------------------------------------------
//  MODAL: Ver imagen de la noticia
// --------------------------------------------------
function verImagenNoticia(rutaImg) {
  document.getElementById("modal-img-noticia").src = rutaImg;
  document.getElementById("modalImagenNoticia").style.display = "flex";
}

function cerrarModalNoticia() {
  document.getElementById("modalImagenNoticia").style.display = "none";
  document.getElementById("modal-img-noticia").src = "";
}

// --------------------------------------------------
//  CAMBIAR ESTADO → Activar noticia (id_estado = 1)
// --------------------------------------------------
function confirmarActivarNoticia(id_noticias, btn) {
  Swal.fire({
    title: "¿Activar esta noticia?",
    text: "La noticia será visible en la plataforma.",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#6c757d",
    confirmButtonText: "Sí, activar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiarEstadoNoticia(id_noticias, 1, btn, "Noticia Activada");
    }
  });
}

// --------------------------------------------------
//  CAMBIAR ESTADO → Desactivar noticia (id_estado = 2)
// --------------------------------------------------
function confirmarDesactivarNoticia(id_noticias, btn) {
  Swal.fire({
    title: "¿Desactivar esta noticia?",
    text: "La noticia dejará de ser visible en la plataforma.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#dc3545",
    cancelButtonColor: "#6c757d",
    confirmButtonText: "Sí, desactivar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiarEstadoNoticia(id_noticias, 2, btn, "Noticia Desactivada");
    }
  });
}

// --------------------------------------------------
//  AJAX: Enviar cambio de estado al servidor
// --------------------------------------------------
function cambiarEstadoNoticia(id_noticias, nuevoEstado, btn) {
  $.ajax({
    url: "cambiar_estado_noticia.php",
    type: "POST",
    data: {
      id_noticias: id_noticias,
      id_estado_noticia: nuevoEstado,
    },
    success: function (response) {
      if (response.trim() === "ok") {
        // Actualizar la celda de estado en la tabla
        const fila = $(btn).closest("tr");
        const celdaEstado = fila.find("td:eq(2)");

        if (nuevoEstado === 1) {
          celdaEstado.text("Noticia Activada");
          $(btn)
            .removeClass("btn-success")
            .addClass("btn-danger")
            .html("<i class='fa fa-toggle-off'></i> Desactivar")
            .attr(
              "onclick",
              `confirmarDesactivarNoticia(${id_noticias}, this)`,
            );
        } else {
          celdaEstado.text("Noticia Desactivada");
          $(btn)
            .removeClass("btn-danger")
            .addClass("btn-success")
            .html("<i class='fa fa-toggle-on'></i> Activar")
            .attr("onclick", `confirmarActivarNoticia(${id_noticias}, this)`);
        }

        Swal.fire({
          icon: "success",
          title: "¡Listo!",
          text: "El estado de la noticia fue actualizado.",
          timer: 1800,
          showConfirmButton: false,
        });
      } else {
        Swal.fire("Error", "No se pudo actualizar el estado.", "error");
      }
    },
    error: function () {
      Swal.fire("Error", "Ocurrió un problema con el servidor.", "error");
    },
  });
}

// Cerrar modal con tecla ESC
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") {
    cerrarModalNoticia();
  }
});
