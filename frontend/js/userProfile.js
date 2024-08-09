document.addEventListener('DOMContentLoaded', function() {
    const editButton = document.getElementById('editProfile');
    const saveButton = document.getElementById('saveProfile');
    const cancelButton = document.getElementById('cancelEdit');
    const profileForm = document.getElementById('profileForm');
    const usernameField = document.getElementById('username');
    const emailField = document.getElementById('email');
    const roleField = document.getElementById('role');
    const dateField = document.getElementById('date');

    // Function to toggle edit mode
    function toggleEditMode(isEditing) {
        usernameField.disabled = !isEditing;
        emailField.disabled = !isEditing;
        roleField.disabled = !isEditing;
        dateField.disabled = !isEditing;
        editButton.style.display = isEditing ? 'none' : 'inline-block';
        saveButton.style.display = isEditing ? 'inline-block' : 'none';
        cancelButton.style.display = isEditing ? 'inline-block' : 'none';
    }

    // Edit profile button click event
    editButton.addEventListener('click', function() {
        toggleEditMode(true);
    });

    // Save profile button click event
    saveButton.addEventListener('click', function() {
        // Here you would typically send the updated data to the server
        alert('Perfil actualizado con éxito');
        toggleEditMode(false);
    });

    // Cancel edit button click event
    cancelButton.addEventListener('click', function() {
        // Revert any changes made in edit mode
        toggleEditMode(false);
    });
});
