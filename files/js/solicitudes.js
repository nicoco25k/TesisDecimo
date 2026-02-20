

function handleAdoption(action, idSolicitud) {
    // Confirmar acción con el usuario
    const message = action === "accept" 
        ? "¿Estás seguro de aceptar esta solicitud de adopción?" 
        : "¿Estás seguro de rechazar esta solicitud de adopción?";

    if (!confirm(message)) {
        return; // Salir si el usuario cancela
    }

    // Realizar la solicitud al servidor
    fetch('update_adoption_status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            action: action,
            id_solicitud: idSolicitud
        }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert(data.message || "Operación realizada exitosamente");
            location.reload(); // Recargar página para reflejar cambios
        } else {
            alert(data.message || "Hubo un problema al procesar la solicitud");
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        alert("Ocurrió un error al procesar la solicitud.");
    });


	
}