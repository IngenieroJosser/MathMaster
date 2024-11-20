// Variables
const userTableBody = document.getElementById('userTableBody');
const userModal = document.getElementById('userModal');
const modalTitle = document.getElementById('modalTitle');
const userForm = document.getElementById('userForm');
const searchInput = document.getElementById('search');
const roleFilter = document.getElementById('roleFilter');

// Mostrar usuarios en la tabla
function fetchUsers(role = '') {
    fetch(`../../backend/userAdministration.php?role=${role}`)
        .then(response => response.json())
        .then(data => {
            userTableBody.innerHTML = '';
            data.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${user.username}</td>
                    <td>${user.email}</td>
                    <td>${user.role}</td>
                    <td>${user.created_at}</td>
                    <td>
                        <button onclick="editUser(${user.id})">Editar</button>
                        <button onclick="deleteUser(${user.id})">Eliminar</button>
                    </td>
                `;
                userTableBody.appendChild(row);
            });
        });
}

// Crear o actualizar usuario
userForm.addEventListener('submit', function(event) {
    event.preventDefault();
    
    const id = userForm.querySelector('#userId') ? userForm.querySelector('#userId').value : '';
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const role = document.getElementById('role').value;
    
    const formData = new FormData();
    formData.append('username', username);
    formData.append('email', email);
    formData.append('role', role);
    if (id) formData.append('id', id);

    fetch('../../backend/userAdministration.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert(data.message);
            userModal.style.display = 'none';
            fetchUsers(roleFilter.value);  // Actualizar la tabla
        } else {
            alert(data.error);
        }
    });
});

// Editar usuario
function editUser(id) {
    fetch(`../../backend/userAdministration.php?role=&id=${id}`)
        .then(response => response.json())
        .then(user => {
            document.getElementById('username').value = user.username;
            document.getElementById('email').value = user.email;
            document.getElementById('role').value = user.role;
            modalTitle.textContent = 'Editar Usuario';
            userModal.style.display = 'block';
            const userIdInput = document.createElement('input');
            userIdInput.type = 'hidden';
            userIdInput.id = 'userId';
            userIdInput.value = user.id;
            userForm.appendChild(userIdInput);
        });
}

// Eliminar usuario
function deleteUser(id) {
    if (confirm('¿Estás seguro de eliminar este usuario?')) {
        fetch(`../../backend/userAdministration.php?id=${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            fetchUsers(roleFilter.value);  // Actualizar la tabla
        });
    }
}

// Filtros de búsqueda y rol
searchInput.addEventListener('input', function() {
    const searchTerm = searchInput.value.toLowerCase();
    const rows = userTableBody.querySelectorAll('tr');
    rows.forEach(row => {
        const username = row.querySelector('td').textContent.toLowerCase();
        row.style.display = username.includes(searchTerm) ? '' : 'none';
    });
});

roleFilter.addEventListener('change', function() {
    fetchUsers(roleFilter.value);
});

// Inicialización
fetchUsers();  // Cargar usuarios al inicio

// Cerrar modal
document.querySelector('.close').addEventListener('click', function() {
    userModal.style.display = 'none';
});
