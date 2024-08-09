document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('myModal');
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModal = document.getElementById('closeModal');

    // Abrir el modal al hacer clic en el botón
    openModalBtn.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    // Cerrar el modal al hacer clic en la "x"
    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Cerrar el modal al hacer clic fuera del contenido del modal
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
