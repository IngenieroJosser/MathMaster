document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    // Obtener los valores del formulario
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Validar (aquí deberías agregar tu lógica de autenticación)
    if (username && password) {
        // Mostrar el modal
        const modal = document.getElementById('loginModal');
        const closeModal = document.querySelector('.modal .close');
        const modalMessage = document.getElementById('modalMessage');

        modalMessage.textContent = 'Iniciando sesión...';

        modal.style.display = 'block';

        // Cerrar el modal al hacer clic en el botón de cierre
        closeModal.onclick = function() {
            modal.style.display = 'none';
            // Redirigir a otra página, por ejemplo:
            // window.location.href = 'dashboard.html';
        }

        // Cerrar el modal al hacer clic fuera del contenido del modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    } else {
        // Mostrar un mensaje de error si falta algún campo
        const modal = document.getElementById('loginModal');
        const closeModal = document.querySelector('.modal .close');
        const modalMessage = document.getElementById('modalMessage');

        modalMessage.textContent = 'Por favor, completa todos los campos.';

        modal.style.display = 'block';

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
    }
});
