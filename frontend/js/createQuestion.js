document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('createQuestionForm');
    const modal = document.getElementById('confirmationModal');
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
            if (data.includes('Pregunta guardada exitosamente.')) {
                modalMessage.textContent = 'Pregunta creada exitosamente.';
                modal.style.display = 'block';
                form.reset(); // Limpiar el formulario
            } else {
                modalMessage.textContent = 'Hubo un error al guardar la pregunta.';
                modal.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            modalMessage.textContent = 'Hubo un error al guardar la pregunta.';
            modal.style.display = 'block';
        });
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
