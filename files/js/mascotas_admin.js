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
      zeroRecords: "No se encontraron mascotas con tu búsqueda",
      emptyTable: "No hay datos disponibles en la tabla.",
      paginate: {
        first: "Primero",
        previous: "Anterior",
        next: "Siguiente",
        last: "Último",
      },
      aria: {
        sortAscending: ": active para ordenar la columna en orden ascendente",
        sortDescending: ": active para ordenar la columna en orden descendente",
      },
    },
    scrollY: 400,
    lengthMenu: [
      [10, 25, -1],
      [10, 25, "Todas las mascotas"],
    ],
  });
});

function generarReporte() {
  window.location.href = "generar_reporte_mascotas.php";
}

function confirmarDesactivarMascota(id_mascotas, btn) {
  Swal.fire({
    title: "Poner En Adopción",
    text: "Al cambiar el estado, esta mascota sera visible de nuevo en el apartado de mascotas en adopción",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Sí, cambiar estado",
    cancelButtonText: "Cancelar",
    backdrop: "static",
  }).then((result) => {
    if (result.isConfirmed) {
      actualizarEstadoMascota(id_mascotas, "desactivar", btn);
    }
  });
}

function confirmarActivarMascota(id_mascotas, btn) {
  Swal.fire({
    title: "Cambiar de estado a 'ADOPTADO'",
    text: "Al cambiar el estado, esta mascota NO sera visible de nuevo en el apartado de mascotas en adopción",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Sí, activar",
    cancelButtonText: "Cancelar",
    backdrop: "static",
  }).then((result) => {
    if (result.isConfirmed) {
      actualizarEstadoMascota(id_mascotas, "activar", btn);
    }
  });
}

function actualizarEstadoMascota(id_mascotas, accion, btn) {
  $.ajax({
    url: "actualizar_estado_adopcion.php",
    type: "POST",
    data: {
      id_mascotas: id_mascotas,
      accion: accion,
    },
    success: function (response) {
      Swal.fire({
        title: "Éxito",
        text: "El estado de la mascota fue actualizado con éxito",
        icon: "success",
      }).then(() => {
        // Actualizar el DOM sin recargar
        const fila = btn.closest("tr");
        const celdaEstado = fila.cells[5]; // columna Estado

        if (accion === "desactivar") {
          celdaEstado.textContent = "En Adopción";
          btn.textContent = "Cambiar Estado";
          btn.classList.remove("btn-danger");
          btn.classList.add("btn-success");
          btn.setAttribute(
            "onclick",
            `confirmarActivarMascota(${id_mascotas}, this)`,
          );
        } else {
          celdaEstado.textContent = "Adoptado";
          btn.textContent = "Cambiar Estado";
          btn.classList.remove("btn-success");
          btn.classList.add("btn-danger");
          btn.setAttribute(
            "onclick",
            `confirmarDesactivarMascota(${id_mascotas}, this)`,
          );
        }
      });
    },
    error: function (xhr, status, error) {
      Swal.fire({
        title: "Error",
        text: "Error al actualizar el estado de la mascota",
        icon: "error",
      });
    },
  });
}
function verDetalles(
  nombre,
  especie,
  sexo,
  edad,
  raza,
  esterilizacion,
  desparasitacion,
  estado_adopcion,
  foto,
) {
  document.getElementById("modal-nombre").textContent = nombre;
  document.getElementById("modal-especie").textContent = especie;
  document.getElementById("modal-sexo").textContent = sexo;
  document.getElementById("modal-edad").textContent = edad;
  document.getElementById("modal-raza").textContent = raza;
  document.getElementById("modal-esterilizacion").textContent = esterilizacion;
  document.getElementById("modal-desparasitacion").textContent =
    desparasitacion;
  document.getElementById("modal-estado_adopcion").textContent =
    estado_adopcion;
  document.getElementById("modal-foto").setAttribute("src", foto);

  document.getElementById("modalDetallesMascota").style.display = "block";
}

function cerrarModal() {
  document.getElementById("modalDetallesMascota").style.display = "none";
}

document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") {
    cerrarModal();
  }
});
