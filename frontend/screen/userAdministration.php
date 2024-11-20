<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Usuarios - MathMaster</title>
    <link rel="stylesheet" href="../css/modules/userAdministration.css">
</head>
<body>
    <div class="container-admin-users">
        <h1>Administración de Usuarios - MathMaster</h1>
        
        <!-- Barra de búsqueda y filtros -->
        <div class="search-filters">
            <input type="text" id="search" placeholder="Buscar usuario...">
            <a href="./dashboard.html" class="btn-dashboard">Dashoard</a>
            <label for="roleFilter" class="visually-hidden">Filtrar por rol</label>
            <select id="roleFilter">
                <option value="">Todos los roles</option>
                <option value="admin">Administrador</option>
                <option value="docente">Docente</option>
                <option value="estudiante">Estudiante</option>
            </select>
        </div>
        

        <table>
            <thead>
                <tr>
                    <th>Nombre de Usuario</th>
                    <th>Correo Electrónico</th>
                    <th>Rol</th>
                    <th>Fecha de Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <!-- Esto es la filas de los usuarios que se llenarán dinámicamente con JavaScript -->
            </tbody>
        </table>
        
        <div class="pagination">
            <button id="prevPage">« Anterior</button>
            <button id="nextPage">Siguiente »</button>
        </div>
    </div>

    <!-- Modal para ver y editar usuarios -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modalTitle">Detalles del Usuario</h2>
            <form id="userForm">
                <label for="username">Nombre de Usuario</label>
                <input type="text" id="username" name="username" required>
                
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required>
                
                <label for="role">Rol</label>
                <select id="role" name="role" required>
                    <option value="admin">Administrador</option>
                    <option value="docente">Docente</option>
                    <option value="estudiante">Estudiante</option>
                </select>
                
                <button type="submit">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <script src="../js/userAdministration.js"></script>
</body>
</html>