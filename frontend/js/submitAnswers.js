// Función para mostrar el modal al enviar el formulario
function showModal(event) {
    event.preventDefault();  // Prevenir el envío del formulario para mostrar el modal

    // Mostrar el modal
    document.getElementById('responseModal').style.display = "block";
}

// Función para cerrar el modal y enviar el formulario
function closeModal() {
    document.getElementById('responseModal').style.display = "none";
    // Enviar el formulario después de cerrar el modal
    document.getElementById('studentAnswersForm').submit();
}
