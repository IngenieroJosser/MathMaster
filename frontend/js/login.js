document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');
    const modal = document.getElementById('loginModal');
    const closeModal = modal.querySelector('.close');
    const modalMessage = document.getElementById('modalMessage');

    form.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario
        
        const formData = new FormData(form);
        
        fetch(form.action, {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes('success')) {
                modalMessage.textContent = 'Iniciando sesión...';
                modal.style.display = 'block';

                // Redirigir después de un breve retraso
                setTimeout(() => {
                    window.location.href = "../dashboard.html";
                }, 1500);
            } else {
                modalMessage.textContent = data.includes('error') ? data : 'Hubo un error al iniciar sesión.';
                modal.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            modalMessage.textContent = 'Hubo un error al iniciar sesión.';
            modal.style.display = 'block';
        });
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Cerrar el modal si se hace clic fuera de él
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
