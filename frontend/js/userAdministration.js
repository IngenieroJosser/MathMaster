document.addEventListener('DOMContentLoaded', function() {
    const userTableBody = document.getElementById('userTableBody');
    const userModal = document.getElementById('userModal');
    const closeModal = document.querySelector('#userModal .close');
    const userForm = document.getElementById('userForm');

    // Función para cargar usuarios en la tabla
    function loadUsers() {
        // Aquí puedes hacer una llamada a la API para obtener los usuarios
        // Ejemplo de usuarios estáticos
        const users = [
            { username: 'jdoe', email: 'jdoe@example.com', role: 'estudiante', date: '2024-01-01' },
            { username: 'asmith', email: 'asmith@example.com', role: 'docente', date: '2024-01-05' },
            { username: 'bwilliams', email: 'bwilliams@example.com', role: 'admin', date: '2024-01-10' },
            { username: 'cjones', email: 'cjones@example.com', role: 'estudiante', date: '2024-01-12' },
            { username: 'dclark', email: 'dclark@example.com', role: 'docente', date: '2024-01-15' },
            { username: 'ejohnson', email: 'ejohnson@example.com', role: 'admin', date: '2024-01-18' },
            { username: 'fmartinez', email: 'fmartinez@example.com', role: 'estudiante', date: '2024-01-20' },
            { username: 'gthompson', email: 'gthompson@example.com', role: 'docente', date: '2024-01-22' },
            { username: 'hgarcia', email: 'hgarcia@example.com', role: 'admin', date: '2024-01-25' },
            { username: 'ijackson', email: 'ijackson@example.com', role: 'estudiante', date: '2024-01-28' },
            { username: 'jroberts', email: 'jroberts@example.com', role: 'docente', date: '2024-02-01' },
            { username: 'kwhite', email: 'kwhite@example.com', role: 'admin', date: '2024-02-05' },
            { username: 'lmoore', email: 'lmoore@example.com', role: 'estudiante', date: '2024-02-08' },
            { username: 'mking', email: 'mking@example.com', role: 'docente', date: '2024-02-10' },
            { username: 'nlee', email: 'nlee@example.com', role: 'admin', date: '2024-02-12' },
            { username: 'operez', email: 'operez@example.com', role: 'estudiante', date: '2024-02-15' },
            { username: 'pwalker', email: 'pwalker@example.com', role: 'docente', date: '2024-02-18' },
            { username: 'qadams', email: 'qadams@example.com', role: 'admin', date: '2024-02-20' },
            { username: 'rallen', email: 'rallen@example.com', role: 'estudiante', date: '2024-02-22' },
            { username: 'shernandez', email: 'shernandez@example.com', role: 'docente', date: '2024-03-01' },
            { username: 'tjackson', email: 'tjackson@example.com', role: 'admin', date: '2024-03-05' },
            { username: 'umartin', email: 'umartin@example.com', role: 'estudiante', date: '2024-03-08' },
            { username: 'vturner', email: 'vturner@example.com', role: 'docente', date: '2024-03-10' },
            { username: 'wrobinson', email: 'wrobinson@example.com', role: 'admin', date: '2024-03-12' },
            { username: 'xcarter', email: 'xcarter@example.com', role: 'estudiante', date: '2024-03-15' },
            { username: 'ycollins', email: 'ycollins@example.com', role: 'docente', date: '2024-03-18' },
            { username: 'zyoung', email: 'zyoung@example.com', role: 'admin', date: '2024-03-20' },
            { username: 'abrown', email: 'abrown@example.com', role: 'estudiante', date: '2024-04-01' },
            { username: 'bcampbell', email: 'bcampbell@example.com', role: 'docente', date: '2024-04-05' },
            { username: 'cdavis', email: 'cdavis@example.com', role: 'admin', date: '2024-04-10' },
            { username: 'devans', email: 'devans@example.com', role: 'estudiante', date: '2024-04-12' },
            { username: 'ewatson', email: 'ewatson@example.com', role: 'docente', date: '2024-04-15' },
            { username: 'fwright', email: 'fwright@example.com', role: 'admin', date: '2024-04-18' },
            { username: 'gmitchell', email: 'gmitchell@example.com', role: 'estudiante', date: '2024-04-20' },
            { username: 'hphillips', email: 'hphillips@example.com', role: 'docente', date: '2024-04-22' },
            { username: 'ijones', email: 'ijones@example.com', role: 'admin', date: '2024-04-25' },
            { username: 'jgarcia', email: 'jgarcia@example.com', role: 'estudiante', date: '2024-05-01' },
            { username: 'kmiller', email: 'kmiller@example.com', role: 'docente', date: '2024-05-05' },
            { username: 'lnelson', email: 'lnelson@example.com', role: 'admin', date: '2024-05-10' },
            { username: 'mroberts', email: 'mroberts@example.com', role: 'estudiante', date: '2024-05-12' },
            { username: 'nsmith', email: 'nsmith@example.com', role: 'docente', date: '2024-05-15' },
            { username: 'opatterson', email: 'opatterson@example.com', role: 'admin', date: '2024-05-18' },
            { username: 'pturner', email: 'pturner@example.com', role: 'estudiante', date: '2024-05-20' },
            { username: 'qbrooks', email: 'qbrooks@example.com', role: 'docente', date: '2024-05-22' },
            { username: 'rcooper', email: 'rcooper@example.com', role: 'admin', date: '2024-05-25' },
            { username: 'sscott', email: 'sscott@example.com', role: 'estudiante', date: '2024-06-01' },
            { username: 'tadams', email: 'tadams@example.com', role: 'docente', date: '2024-06-05' }
        ];
        

        userTableBody.innerHTML = ''; // Limpiar la tabla
        users.forEach(user => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${user.username}</td>
                <td>${user.email}</td>
                <td>${user.role}</td>
                <td>${user.date}</td>
                <td>
                    <button class="view-btn">Ver</button>
                    <button class="edit-btn">Editar</button>
                    <button class="delete-btn">Eliminar</button>
                </td>
            `;
            userTableBody.appendChild(row);
        });

        // Agregar eventos a los botones de acción
        document.querySelectorAll('.view-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Lógica para ver detalles del usuario
                showUserModal('Detalles del Usuario');
            });
        });

        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Lógica para editar usuario
                showUserModal('Editar Usuario');
            });
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Lógica para eliminar usuario
                if (confirm('¿Estás seguro de que deseas eliminar a este usuario?')) {
                    // Eliminar usuario
                }
            });
        });
    }

    // Función para mostrar el modal
    function showUserModal(title) {
        document.getElementById('modalTitle').textContent = title;
        userModal.style.display = 'flex';
    }

    // Cerrar el modal
    closeModal.onclick = function() {
        userModal.style.display = 'none';
    }

    // Cerrar el modal al hacer clic fuera del contenido del modal
    window.onclick = function(event) {
        if (event.target == userModal) {
            userModal.style.display = 'none';
        }
    }

    // Inicializar la carga de usuarios
    loadUsers();
});
