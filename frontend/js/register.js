document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('registerForm');
    const modal = document.getElementById('registerModal');
    const closeModal = document.querySelector('#registerModal .close');
    const modalMessage = document.getElementById('modalMessage');

    registerForm.addEventListener('submit', function(event) {
        // event.preventDefault(); // Comentado para permitir que el formulario se envíe

        // Obtener los valores del formulario
        const username = document.getElementById('username').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const role = document.getElementById('role').value;

        // Mostrar el modal
        if (username && email && password && role) {
            modalMessage.textContent = 'Registrando...';
        } else {
            modalMessage.textContent = 'Por favor, completa todos los campos.';
        }

        modal.style.display = 'flex';
    });

    // Cerrar el modal al hacer clic en el botón de cierre
    closeModal.onclick = function() {
        modal.style.display = 'none';
    }

    // Cerrar el modal al hacer clic fuera del contenido del modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
});
