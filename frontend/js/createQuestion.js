// document.addEventListener('DOMContentLoaded', function() {
//     const form = document.getElementById('createQuestionForm');
//     const modal = document.getElementById('confirmationModal');
//     const closeModal = document.querySelector('#confirmationModal .close');
//     const modalMessage = document.getElementById('modalMessage');

//     // Función para cerrar el modal
//     function closeModalFunction() {
//         modal.style.display = 'none';
//     }

//     form.addEventListener('submit', function(event) {
//         event.preventDefault();
        
//         // Aquí puedes agregar la lógica para guardar la pregunta
        
//         // Mostrar el modal
//         modal.style.display = 'flex';
        
//         // Establecer el mensaje del modal
//         modalMessage.textContent = 'Pregunta creada exitosamente.';
        
//         // Cerrar el modal al hacer clic en el botón de cierre
//         closeModal.onclick = closeModalFunction;

//         // Cerrar el modal al hacer clic fuera del contenido del modal
//         window.onclick = function(event) {
//             if (event.target == modal) {
//                 closeModalFunction();
//             }
//         }
//     });

//     // Asegúrate de que el modal se cierra al hacer clic en el botón de cierre
//     if (closeModal) {
//         closeModal.addEventListener('click', closeModalFunction);
//     }
// });

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('confirmationModal');
    const closeBtn = document.querySelector('.close');

    closeBtn.onclick = function() {
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }
});